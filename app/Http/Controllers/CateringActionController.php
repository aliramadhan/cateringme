<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use \App\Models\Menu;
use \App\Models\Order;
use \App\Models\PhotoMenu;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Telegram\Bot\Laravel\Facades\Telegram;

class CateringActionController extends Controller
{
	public function dashboard()
	{
		//declare variable
		$user = auth()->user();
		$now = Carbon::now();
		$prev_month = Carbon::parse($now->format('Y-m'))->subMonth(1);
		$menus = $user->menus->take(10);
		$menu_today = Menu::all();
		$total_review = 0;
		$stars = 0;
		$prev_stars = 0;
		$menu_id = [];
		foreach ($menu_today as $item) {
			$item->total_order = $item->orders->where('order_date',$now->format('Y-m-d'))->count();
		}
		foreach ($menus as $menu) {
			if ($menu->orders->count() == 0) {
				continue;
			}
			$menu_id [] = $menu->id;
			$total_review += $menu->orders->where('reviewed_at','!=',null)->count();
			$stars += ( (1*$menu->orders->where('stars',1)->count()) + (2 * $menu->orders->where('stars',2)->count()) + (3 * $menu->orders->where('stars',3)->count()) + (4 * $menu->orders->where('stars', 4)->count()) + (5 * $menu->orders->where('stars',5)->count()) ) / ($menu->orders->count()); 
			$prev_stars += $menu->orders->whereBetween('reviewed_at',[$prev_month->startOfMonth()->format('Y-m-d'),$prev_month->endOfMonth()->format('Y-m-d')])->sum('stars');
		}
		//calculation		
		$stars = round($stars/$menus->count());
		$prev_stars = $prev_stars/$menus->count();
		if($prev_stars == 0){
			$persen_stars = 100;
		}
		else{
			$persen_stars = ($stars / $prev_stars) * 100;
		}
		$reviews = Order::whereIn('menu_id',$menu_id)->where('review','!=',null)->orderBy('reviewed_at','desc')->get();

		return view('Catering.dashboard',compact('menu_today','user','menus','total_review','stars','prev_stars','persen_stars','reviews'));
	}
	public function index_menu()
	{
		$now = Carbon::now();
		$menus = auth()->user()->menus;
		foreach ($menus as $menu) {
			$rate = $menu->orders()->where('order_date','<=',$now->format('Y-m-d'))->avg('stars');
			$menu->rate = $rate;
			if($rate == null){
				$menu->rate = 0;
			}
		}

		return view('Catering.index_Menu',compact('menus','now'));
	}
	public function create_menu()
	{
		return view('Catering.create_Menu');
	}
	public function store_menu(Request $request)
	{
		//Validation Request
		$this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'photo' => ['required'],
            'photo.*' => ['mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'desc' => ['required', 'string']
        ]);

        //create code number for menu
		$last_id = Menu::all()->count();
		$len = strlen(++$last_id);
		for($i=$len; $i< 4; ++$i) {
	        $last_id = '0'.$last_id;
	    }
	    $code_number = 'MNU'.$last_id;

		//inser into database
		DB::beginTransaction();
		try {
			$menu = Menu::create([
		        'name' => $request->name,
        		'catering_id' => auth()->user()->id,
		        'menu_code' => $code_number,
		        'desc' => $request->desc,
			]);
			if($request->hasfile('photo')){
				//save image to directory
				$no = 1;
				foreach ($request->file('photo') as $image) {
				    //create name and store photo
					$imageName = Str::slug($request->name).'_'.$no.'.'.$image->extension();
					$image->move(public_path('images/photo-menu/'.$code_number), $imageName);
					$fileName = 'images/photo-menu/'.$code_number.'/'.$imageName;

					$menu->photos()->create(['file' => $fileName]);
					$no++;
				}
			}


			if($menu != null){
		    	DB::commit();
        		return redirect()->route('catering.index.menu')->with(['message' => 'new Menu added successfully.']);
			}
		    // all good
		} catch (\Exception $e) {
		    DB::rollback();
        	return redirect()->back()->withErrors(['message' => 'Error Accuired.']);
		}
	}
	public function edit_menu($menu_code)
	{
		$menu = Menu::where('menu_code',$menu_code)->first();

		return view('Catering.edit_menu',compact('menu'));
	}
	public function update_menu(Request $request, $menu_code)
	{
		//declare variable
		$now = Carbon::now();
		$menu = Menu::where('menu_code',$menu_code)->first();
		$menu->update([
			'name' => $request->name,
			'desc' => $request->desc
		]);
		foreach ($menu->photos as $photo) {
			$file = $request->file($photo->id);
			if ($file == null) {
				continue;
			}

			if(\File::exists(public_path($photo->file))){
			    \File::delete(public_path($photo->file));
			}

		    //create name and store photo
			$imageName = Str::slug($menu->name).'_'.$now->format('Ymdhsi').'.'.$file->extension();
			$file->move(public_path('images/photo-menu/'.$menu->menu_code), $imageName);
			$fileName = 'images/photo-menu/'.$menu->menu_code.'/'.$imageName;
			$photo->update([
				'file' => $fileName
			]);
		}
		foreach ($request->addPhoto as $new_image) {
		    //create name and store photo
			$imageName = Str::slug($menu->name).'_'.$now->format('Ymdhsi').'.'.$new_image->extension();
			$new_image->move(public_path('images/photo-menu/'.$menu->menu_code), $imageName);
			$fileName = 'images/photo-menu/'.$menu->menu_code.'/'.$imageName;
			$photoMenu = PhotoMenu::create([
				'menu_id' => $menu->id,
				'file' => $fileName
			]);
		}

		return redirect()->back()->with(['message' => 'Menu '.$menu->name.' updated successfully.']);
	}
	public function delete_photo($id)
	{
		$photo = PhotoMenu::find($id);
		$check = \File::exists(public_path($photo->file));
		return dd($check);
		if($check){
			$delete = \File::exists(public_path($photo->file));
		}
	}
	public function index_catering()
	{
		//declare variable
		$now = Carbon::now();
		$orders = Order::where('order_date',$now->format('Y-m-d'))->get();

		return view('Catering.index_catering',compact('now','orders'));
	}
	public function index_report(Request $request)
	{
		//declare variable
		$user = auth()->user();
		$now = Carbon::now();
        $from = null;
        $to = null;
        
        foreach ($user->menus as $menu) {
        	if ($request->from != null && $request->to != null) {
			    $from = Carbon::parse($request->from);
		        $to = Carbon::parse($request->to);
		        if($to < $from){
		        	return redirect()->back()->withErrors(['message' => "Error Date picker."]);
		        }
        		$order = $menu->orders->whereBetween('order_date',[$from->format('Y-m-d'),$to->format('Y-m-d')]);
			}
			else{
	    		$order = $menu->orders->where('order_date','<=',$now->format('Y-m-d'));
    		}
        	$menu->total_order = $order->count();
        	$menu->total_served = $order->where('status',1)->count();
        	$menu->stars = $order->avg('stars');
        }
        
		return view('Catering.index_report',compact('user','now'));
	}
	public function index_review(Request $request)
	{
		//declare variable
		$user = auth()->user();
		$now = Carbon::now();
		$menu_id = $user->menus->pluck('id');
		$from = null;
		$to = null;

		//get review data
		$reviews = Order::whereIn('menu_id',$menu_id)->where('reviewed_at','<=',$now->format('Y-m-d'))->orderBy('reviewed_at','desc')->get();
		if ($request->form != null && $request->to != null) {
			$from = Carbon::parse($request->from);
			$to = Carbon::parse($request->to);
	        if($to < $from){
	        	return redirect()->back()->withErrors(['message' => "Error Date picker."]);
	        }
			$reviews = Order::whereIn('menu_id',$menu_id)->whereBetween('reviewed_at',[$from->format('Y-m-d'),$to->format('Y-m-d')])->orderBy('reviewed_at','desc')->get();

		}

		return view('Catering.index_review',compact('user','now','reviews'));
	}
	public function served_menu(Request $request)
	{
		//Validation Request
		$this->validate($request, [
            'orders' => ['required']
        ]);
        DB::beginTransaction();
        try {
        	foreach ($request->orders as $item) {
        		$order = Order::findOrFail($item);
        		$order->update(['status' => 1]);
        	}
            
		} catch (\Exception $e) {
		    DB::rollback();
        	return redirect()->back()->withErrors(['message' => $e->message]);
		}
    	DB::commit();
		return redirect()->back()->with(['message' => 'Orders Menu updated status successfully.']);
	}
	public function send_message()
	{
		$now = Carbon::now();
		$orders = Order::where('order_date',$now->format('Y-m-d'))->get();
		$menus = Order::where('order_date',$now->format('Y-m-d'))->groupBy('menu_id')->get();
		$data = new Collection;
		$i = 1;
		$text = "Notification Catering Today \n".$now->format('d, M Y')."\n \n";
		foreach ($menus as $order) {
			$menu = Menu::findOrFail($order->menu_id);
			$data->push((object)[
				'Menu' => $menu->name,
				'total_order' => $orders->where('menu_id',$menu->id)->count()
			]);
			$text .= $i.". ".$menu->name." => ".$orders->where('menu_id',$menu->id)->count()."\n";
			$i++;
		}
		$text .= "\n ============================\n \n Total order = ".$orders->count(). " \n Total fee = ".number_format($orders->sum('fee'));
	    Telegram::sendMessage([
	        'chat_id' => env('TELEGRAM_CHANNEL_ID',''),
	        'parse_mode' => 'HTML',
	        'text' => $text
	    ]);
		return dd($text);
	}
}
