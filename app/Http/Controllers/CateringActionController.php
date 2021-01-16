<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use \App\Models\Menu;
use \App\Models\Order;
use \App\Models\PhotoMenu;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CateringActionController extends Controller
{
	public function dashboard()
	{
		//declare variable
		$user = auth()->user();
		$now = Carbon::now();
		$prev_month = Carbon::parse($now->format('Y-m'))->subMonth(1);
		$menus = $user->menus;
		$menu_today = Menu::where('show',1)->get();
		$total_review = 0;
		$stars = 0;
		$prev_stars = 0;
		foreach ($menu_today as $item) {
			$item->total_order = $item->orders->where('order_date',$now->format('Y-m-d'))->count();
		}
		foreach ($menus as $menu) {
			$menu_id [] = $menu->id;
			$total_review += $menu->orders->where('reviewed_at','!=',null)->count();
			$stars += $menu->orders->whereBetween('reviewed_at',[$now->startOfMonth()->format('Y-m-d'),$now->endOfMonth()->format('Y-m-d')])->sum('stars');
			$prev_stars += $menu->orders->whereBetween('reviewed_at',[$prev_month->startOfMonth()->format('Y-m-d'),$prev_month->endOfMonth()->format('Y-m-d')])->sum('stars');
		}
		//calculation		
		$stars = $stars/$menus->count();
		$prev_stars = $prev_stars/$menus->count();
		if($prev_stars == 0){
			$persen_stars = 100;
		}
		else{
			$persen_stars = ($stars / $prev_stars) * 100;
		}
		$reviews = Order::whereIn('menu_id',$menu_id)->where('review','!=',null)->orderBy('reviewed_at')->get();

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
		return view('Catering.index_report',compact('user','now'));
	}
}
