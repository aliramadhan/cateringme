<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use \App\Models\Menu;
use \App\Models\PhotoMenu;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CateringActionController extends Controller
{
	public function dashboard()
	{
		//declare variable
		$now = Carbon::now();
		$menu_today = Menu::where('show',1)->get();
		foreach ($menu_today as $menu) {
			$menu->total_order = $menu->orders->where('order_date',$now->format('Y-m-d'))->count();
		}
		return view('Catering.dashboard',compact('menu_today'));
	}
	public function index_menu()
	{
		$menus = auth()->user()->menus;

		return view('Catering.index_Menu',compact('menus'));
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
	public function index_report()
	{
		$user = auth()->user();

		return view('Catering.index_report',compact('user'));
	}
}
