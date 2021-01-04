<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use \App\Models\Menu;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CateringActionController extends Controller
{
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
            'photo' => ['required', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'desc' => ['required', 'string']
        ]);

        //create code number for menu
		$last_id = Menu::all()->count();
		$len = strlen(++$last_id);
		for($i=$len; $i< 4; ++$i) {
	        $last_id = '0'.$last_id;
	    }
	    $code_number = 'MNU'.$last_id;
	    //create name and store photo
		$imageName = Str::slug($request->name).'.'.$request->photo->extension();

		//inser into database
		DB::beginTransaction();
		try {
			$menu = Menu::create([
		        'name' => $request->name,
        		'catering_id' => auth()->user()->id,
		        'menu_code' => $code_number,
		        'photo' => $imageName,
		        'desc' => $request->desc,
			]);
			if($menu != null){
		    	DB::commit();
		    	//save image to directory
				$request->photo->move(public_path('images/photo-menu/'.$code_number), $imageName);
        		return redirect()->route('catering.index.menu')->with(['message' => 'new Menu added successfully.']);
			}
		    // all good
		} catch (\Exception $e) {
		    DB::rollback();
        	return redirect()->back()->withErrors(['message' => 'Error accuired.']);
		}
	}
}
