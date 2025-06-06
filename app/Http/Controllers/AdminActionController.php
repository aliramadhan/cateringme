<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\User;
use \App\Models\Order;
use \App\Models\Menu;
use \App\Models\ScheduleMenu;
use \App\Models\Slideshow;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterSuccessfully;
use App\Mail\ResetPasswordUser;
use Illuminate\Support\Facades\Hash;
use DB;
use Telegram\Bot\Laravel\Facades\Telegram;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;
use Exception;

class AdminActionController extends Controller
{
	public function cek_pesan()
	{
        $now = Carbon::now();
        $orders = Order::where('order_date',$now->format('Y-m-d'))->get();
        $shifts = $orders->sortBy('shift')->groupBy('shift');
        $servings = $orders->sortBy('menu_id')->groupBy(['menu_id','serving']);
        $text = "Notification Catering Today \n".$now->format('d, M Y l')."\n \n";
        //shift
        foreach ($shifts as $shift) {
        	$i = 1;
    		$text .= "Shift ".$shift->first()->shift." ========================\n \n";
        	foreach ($shift as $data) {
        		//cek sambal
    			$sambal = "";
        		if ($data->is_sauce == 1) {
    				$sambal = " ( tambah sambal )";
        		}
        		$text .= $i.". ".$data->employee->name." - ".$data->menu->name." porsi ".$data->serving.$sambal."\n";
        		$i++;
        	}
        	$text .= "\n";
        }
        $text .= "================================\n \n";
        //summary
        $i = 1;
        foreach ($servings as $serving) {
        	foreach ($serving as $item) {
        		$menu = $item->first()->menu;
        		$text .= $i. " ".$menu->name. " - porsi ".$item->first()->serving. " => ".$item->count()."\n";
        		$i++;
        	}
        }
        $text .= "\n ============================\n \n Total order = ".$orders->count(). " Menu\n Total fee = Rp. ".number_format($orders->sum('fee'));
        Telegram::sendMessage([
            'chat_id' => env('TELEGRAM_CHANNEL_ID',''),
            'parse_mode' => 'HTML',
            'text' => $text
        ]);
        return $text;
	}
	public function dashboard()
	{
		//describe variable
		$now = Carbon::now();
		$employees = User::where('role','Employee')->get();
		$yesterday = Carbon::now()->subDay();
		$menus = Menu::get();
		$reviews = Order::where('reviewed_at','!=',null)->orderBy('reviewed_at','desc')->get();
		$orders = Order::where('order_date',$now->format('Y-m-d'))->get();
		$price = Menu::pluck('price')->first();
		if($price == null){
			$price = 0;
		}

		//statistik for catering takenss
		$catering_taken = Order::where('order_date',$now->format('Y-m-d'))->count();
		$subcatering_taken = Order::where('order_date',$yesterday->format('Y-m-d'))->count();
		if($subcatering_taken == 0){
			$persen_catering_taken = 100;
		}
		else{
			$persen_catering_taken = ($catering_taken / $subcatering_taken) * 100;
		}
		//statistik for catering not taken
		$not_taken = $employees->count() - $catering_taken;
		$subnot_taken = $employees->count() - $subcatering_taken;
		if($subnot_taken == 0){
			$persen_not_taken = 0;
		}
		else{
			$persen_not_taken = ($not_taken / $subnot_taken) * 100;
		}
		//menu for Catering menu slider
		foreach ($menus as $menu) {
			$stars = $menu->orders()->avg('stars');
			if($stars == null){
				$stars = 0;
			}
			$menu->stars = $stars;
		}
		$menus = $menus->sortByDesc('stars')->take(5);
        
		return view('Admin.dashboard',compact('menus','catering_taken','subcatering_taken', 'persen_catering_taken', 'not_taken', 'subnot_taken', 'persen_not_taken','reviews','orders','now','price'));
	}
	public function index_account()
	{
		$users = User::where('role','!=','Admin')->orderBy('role','desc')->get();
		$divisions = DB::table('divisions')->get();
		return view('Admin.index_account',compact('users','divisions'));
	}
	public function create_account()
	{
		return view('Admin.create_account');
	}
	public function store_account(Request $request)
	{
		//Validation Request
		$this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'division' => ['required', 'string'],
            'position' => ['required', 'string'],
            'roles' => ['required', 'string'],
            'number_phone' => ['numeric','unique:users','digits_between:10,15'],
            'address' => ['string'],
            'joined_at' => ['date'],
        ]);
        if ($request->roles == 'Employee' || $request->roles == 'Manager') {
        	$role = 'Employee';
        }
        else{
        	$role = 'Catering';
        }
		//Create Random char
		$password = bin2hex(random_bytes(4));

		//Create Employee/Catering Code
		if($role == 'Catering'){	
			$code_initial = 'CTR';
			$last_id = User::where('role','Catering')->orderBy('id','desc')->pluck('id')->first();
		}
		else{
			$code_initial = 'EMP';
			$last_id = User::where('role','Employee')->orderBy('id','desc')->pluck('id')->first();
		}
		$len = strlen(++$last_id);
		for($i=$len; $i< 4; ++$i) {
	        $last_id = '0'.$last_id;
	    }
	    $code_number = $code_initial.$last_id;

		//Fill detail for email
		$data = [
			'name' => $request->name,
			'email' => $request->email,
			'password' => $password
		];

		//insert into database
		DB::beginTransaction();
		try {
			$create_Account = User::create([
				'name' => $request->name,
				'username' => $request->username,
				'email' => $request->email,
				'password' => Hash::make($password),
				'role' => $role,
				'division' => $request->division,
				'position' => $request->position,
				'roles' => $request->roles,
				'number_phone' => $request->number_phone,
				'code_number' => $code_number,
				'address' => $request->address,
				'joined_at' => $request->joined_at,
			]);
		    // all good
		} catch (Exception $e) {
		    DB::rollback();
        	return redirect()->back()->withInput()->withErrors(['message' => $e->getMessage()]);
		}
		
	    DB::commit();
		$send_mail = Mail::to($request->email)->send(new RegisterSuccessfully($data));
        return redirect()->route('admin.index.account')->with(['message' => 'new '.$role.' added succesfully.']);
	}
	public function update_account(Request $request)
	{
		//Validation Request
		$this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'division' => ['required', 'string'],
            'roles' => ['required', 'string'],
            'position' => ['string'],
            'number_phone' => ['numeric','digits_between:10,15'],
            'address' => ['string'],
            'joined_at' => ['date'],
        ]);
		$user = User::where('email',$request->prev_email)->first();
		if($user == null){
			return redirect()->back()->withErrors(['errors' => 'User not found.']);
		}

		if ($request->email != $request->prev_email) {
			$this->validate($request,[
            	'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
			]);
			$user->update([
				'email' => $request->email
			]);
		}

		$user->update([
			'name' => $request->name,
			'username' => $request->username,
			'division' => $request->division,
			'roles' => $request->roles,
			'number_phone' => $request->number_phone,
			'address' => $request->address,
			'position' => $request->position,
			'joined_at' => $request->joined_at,
		]);

		return redirect()->back()->with(['message' => $user->role.' '.$user->name.' updated succesfully.']);
	}
	public function delete_account($email)
	{
		$user = User::where('email',$email)->first();
		if ($user->role == 'Employee') {
			foreach ($user->orders as $order) {
				$order->delete();
			}
		}
		elseif($user->role == 'Catering'){
			foreach ($user->menus as $menu) {
				foreach ($menu->photos as $photo) {
					if (\File::exists(public_path($photo->file))) {
					    $delete = \File::delete(public_path($photo->file));
					}
					$photo->delete();
				}
				$menu->delete();
			}
		}
		$message = $user->name.' account deleted succesfully.';
		$user->delete();

		return redirect()->back()->with(['message' => $message]);	
	}
	public function index_menu()
	{
		$menus = Menu::all();

		return view('Admin.index_menu',compact('menus'));
	}
	public function update_menu_price(Request $request)
	{
		//Validation Request
		$this->validate($request, [
            'price' => ['required','numeric'],
        ]);
        $affected = DB::table('menus')->update(['price' => $request->price]);
        return redirect()->back()->with(['message' => 'Menu price updated succesfully.']);
	}
	/*
	public function index_schedule()
	{
		//declare variable
		$now = Carbon::now();
		$menus = Menu::all();
		$months = new Collection;
		
		//get month
		$start = Carbon::parse($now->format('Y-m-1'));
		for ($i=0; $i < 6; $i++, $start->addMonth()) { 
			$months->push(Carbon::parse($start->format('Y-m')));
		}

		$start_date = Carbon::now()->startOfMonth();
		return view('Admin.index_schedule',compact('months','menus','start_date'));
	}
	public function get_month_schedule(Request $request)
	{
		//declare variable
		$date = Carbon::parse($request->month);
		$start = $date->startOfMonth();
		$total_days = $date->daysInMonth;
		$days = new Collection;
		for ($i=1; $i <= $total_days ; $i++, $start->addDay()) { 
			$schedule = ScheduleMenu::where('date',$start->format('Y-m-d'))->first();
			if($schedule == null){
				$input = "<label class='label flex-auto contents duration-1000'>
		                <input class='label__checkbox duration-1000' type='checkbox' value='".$start->format('Y-m-d')."' name='dates[]' >
		                <span class='label__text '>
		                    <span class='label__check rounded-lg text-white  duration-1000 text-justify' style='background-image: linear-gradient(160deg, #0093E9 0%, #80D0C7 100%);'>
		                      <i class='fa icon font-bold absolute text-xl m-auto text-center flex flex-col transform hover:scale-125 p-10 duration-1000' style='font-family: Poppins, sans-serif;'>
		                   
		                      	<div class='font-semibold text-4xl mb-2 '>".$start->format('d')."</div>
		                      	<div class='text-xs font-base'>".$start->format('l')."</div>
		                      	
		                      	</i>
		                    </span>
		                </span>
		            </label>";
			}
			else{
				$input = "<label class='label flex-auto contents duration-1000'>
		                <input class='label__checkbox duration-1000' type='checkbox' value='".$start->format('Y-m-d')."' name='dates[]' >
		                <span class='label__text '>
		                    <span class='label__check rounded-lg text-white  duration-1000 text-justify' style='background-image: linear-gradient(135deg, #FCCF31 10%, #F55555 100%);'>
		                      <i class='fa icon font-bold absolute text-xl m-auto text-center flex flex-col transform hover:scale-125 p-10 duration-1000' style='font-family: Poppins, sans-serif;'>
		                   
		                      	<div class='font-semibold text-4xl mb-2 '>".$start->format('d')."</div>
		                      	<div class='text-xs font-base'>".$start->format('l')."</div>
		                      	
		                      	</i>
		                    </span>
		                </span>
		            </label>";
			}
			$days->push($input);
		}
		return $days;
	}
	public function store_schedule(Request $request)
	{
		//Validation Request
		$this->validate($request, [
            'month' => ['required'],
            'dates' => ['required'],
            'menus' => ['required'],
        ]);
        //declare variable
        $menu_list = [];
        foreach ($request->menus as $menu) {
        	$menu_list [] = $menu;
        }
        $now = Carbon::parse($request->month);

        //insert into database
		DB::beginTransaction();
		try {
			foreach ($request->dates as $date) {
				$date = Carbon::parse($date);
				$schedule = ScheduleMenu::where('date',$date->format('Y-m-d'))->first();
				if($schedule == null){
					$input_schedule = ScheduleMenu::create([
						'date' => $date->format('Y-m-d'),
						'menu_list' => implode(',', $menu_list)
					]);
				}
				else{
					$schedule->update([
						'menu_list' => implode(',', $menu_list)
					]);
				}
			}
		} catch (\Exception $e) {
		    DB::rollback();
        	return redirect()->back()->withInputs()->withErrors(['message' => $e->message]);
		}
	    // all good
	    DB::commit();
        return redirect()->back()->with(['message' => 'Order has been scheduled.']);
	}*/
	public function can_order($code)
	{
		//declare variable
		$user = User::where('id',$code)->first();
		//check if user founded
		if($user == null){
			return redirect()->back()->withErrors(['message' => 'User not found.']);
		}
		//toggle for employee who can order catering
		if($user->can_order == 1){
			$user->can_order = 0;
			$message = "Feature can order catering has been disabled for ".$user->name;
		}
		else{
			$user->can_order = 1;
			$message = "Feature can order catering has been enabled for ".$user->name;
		}
		$user->save();

		return redirect()->back()->with(['message' => $message]);
	}
	public function index_review(Request $request)
	{
		//declare variable
		$from = null;
		$to = null;

		if ($request->from != null && $request->to != null) {
			$from = Carbon::parse($request->from);
			$to = Carbon::parse($request->to);
			$reviews = Order::where('review','!=',null)->where('stars','!=',null)->whereBetween('reviewed_at',[$from->format('Y-m-d 00:00:00'), $to->format('Y-m-d 23:59:59')])->orderBy('order_date','desc')->get();
		}
		else{
			$reviews = Order::where('review','!=',null)->where('stars','!=',null)->orderBy('order_date','desc')->get();
		}

		return view('Admin.index_review',compact('reviews','from','to'));
	}
	public function index_order_catering(Request $request)
	{	
		//declare variable
		$now = Carbon::now();
		$start_date = Carbon::parse('2021-01-01');
		$total_days = $start_date->diffInDays($now);
		$from = null;
		$to = null;
		$employees = User::where('role','Employee')->get();

		//get total order & total order not taken
		foreach ($employees as $employee) {
			$start = Carbon::parse('2021-01-01');
			$not_taken = 0; $total_dayoff = 0;
			$employee->total_order = $employee->orders->count();
			$from = Carbon::parse($request->from);
				$to = Carbon::parse($request->to);
				$start = Carbon::parse($request->from);
				$stop = Carbon::parse($request->to);
				$total_days = $start->diffInDays($stop);
			
				$employee->total_order = $employee->orders->whereBetween('order_date',[$start->format('Y-m-d'),$stop->format('Y-m-d')])->count();

				for ($i=0; $i <= $total_days; $i++,$start->addDay()) { 
					$schedule = ScheduleMenu::where('date',$start->format('Y-m-d'))->first();
					if ($schedule == null) {
						$total_dayoff++;
					}
				}
				
				$employee->total_not_order = ($total_days+1)-$employee->total_order-$total_dayoff;
			
			
		}

		return view('Admin.index_order_catering',compact('employees','now','from','to'));
	}
	public function index_order(Request $request)
	{
		//declare variable
		$now = Carbon::now();
		$orders = Order::where('order_date',$now->format('Y-m-d'))->get();
		$from = null;
		$to = null;

		if ($request->from != null && $request->to != null) {
			$from = Carbon::parse($request->from);
			$to = Carbon::parse($request->to);
			$orders = Order::whereBetween('order_date',[$from->format('Y-m-d'),$to->format('Y-m-d')])->orderBy('order_date','desc')->get();
		}

		return view('Admin.index_order',compact('orders','now','from','to'));
	}
	public function index_order_not_taken(Request $request)
	{
		//declare variable
		$now = Carbon::now();
		$data = User::where('role','Employee')->get();
		$employees = new Collection;
		$from = null;
		$to = null;


		foreach ($data as $item) {
			if($request->from != null && $request->to != null){
				$from = Carbon::parse($request->from);
				$to = Carbon::parse($request->to);
				$total_day = $from->diffInDays($to);
				for ($i=0; $i <= $total_day; $i++,$from->addDay()) { 
					$order = $item->orders()->where('order_date',$from->format('Y-m-d'))->first();
					if ($order == null) {
						$employees->push(['date' => $from->format('Y-m-d'), 'employee' => $item]);
					}
				}
				//redeclare variable
				$from = Carbon::parse($request->from);
				$to = Carbon::parse($request->to);
			}
			else{
				$order = $item->orders()->where('order_date',$now->format('Y-m-d'))->first();
				if ($order == null) {
					$employees->push(['date' => $now->format('Y-m-d'), 'employee' => $item]);
				}
			}
		}
		//Sort
		$employees->sortBy('date');

		return view('Admin.index_order_not_taken',compact('employees','now','from','to'));
	}
	public function index_slideshow()
	{
		$slides = Slideshow::all();
		return view('Admin.index_slideshow',compact('slides'));
	}
	public function store_slideshow(Request $request)
	{
        $this->validate($request, [
            'inputFile.*' => ['mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ]);
        if($request->file('inputFile') != null){
			for ($i=0; $i < count($request->file('inputFile')); $i++) { 
		        if($request->name[$i] == null){
		        	return redirect()->back()->withErrors(['errors' => 'name field for new image empty.']);
		        }
		        $sum = Slideshow::all()->sum('id');
				//create name and store photo
				$image = $request->file('inputFile')[$i];
		        $imageName = Str::slug($request->name[$i]).'_'.date('Ymdhsi').'_'.$sum.'.'.$image->extension();
		        $image->move(public_path('images/slideshow/'), $imageName);
		        $fileName = 'images/slideshow/'.$imageName;

		        $slideshow = Slideshow::create([
		        	'name' => $request->name[$i],
		        	'file' => $fileName
		        ]);
    			$message = 'Slideshow pict added succesfully.';
			}
		}
		//Update image
    	$slides = Slideshow::all();
    	foreach ($slides as $slide) {
    		if($request->input('name'.$slide->id) != null){
    			$slide->name = $request->input('name'.$slide->id);
    		}
    		else{
				continue;
    		}
    		if ($request->file('file'.$slide->id) != null) {
		        $this->validate($request, [
		            'file'.$slide->id => ['required','mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
		        ]);
    			$photo = $request->file('file'.$slide->id);
    			if(\File::exists(public_path($slide->file))){
                    \File::delete(public_path($slide->file));
                }
                //create name and store photo
                $photoName = Str::slug($slide->name).'_'.date('Ymdhsi').'.'.$photo->extension();
                $photo->move(public_path('images/slideshow/'), $photoName);
                $slide->file = $fileName = 'images/slideshow/'.$photoName;
    		}
    		$slide->save();
    		$message = 'Slideshow pict updated succesfully.';
    	}
		return redirect()->back()->with(['message' => $message]);
	}
	public function delete_slideshow($id)
	{
		$slide = Slideshow::find($id);

		if ($slide == null) {
			return redirect()->back()->withErrors(['errors' => 'Data not Found!']);
		}
		//cek if file founded, then deleted.
		if(\File::exists(public_path($slide->file))){
            \File::delete(public_path($slide->file));
        }
        $slide->delete();
        $message = 'Slide '. $slide->name.' deleted succesfully.';
		return redirect()->back()->with(['message' => $message]);
	}
	public function reset_password($email)
	{
		$user = User::where('email',$email)->first();
		if($user == null){
			return redirect()->back()->withErrors(['message' => 'User not found.']);
		}

		//Create Random char
		$password = bin2hex(random_bytes(4));

		$user->update([
			'password' => Hash::make($password),
		]);

		//Fill detail for email
		$data = [
			'name' => $user->name,
			'email' => $user->email,
			'password' => $password
		];
		$send_mail = Mail::to($email)->send(new ResetPasswordUser($data));

		return redirect()->back()->with(['message' => 'Reset Password for '.$user->name.' succesfully.']);
	}
	//manage Request
	public function index_request(Request $request)
	{
		//declare variable
		$from = null;
		$to = null;

		if ($request->from != null && $request->to != null) {
			$from = Carbon::parse($request->from);
			$to = Carbon::parse($request->to);
			$requests = DB::table('requests')->where('type', 'Activation Order')->whereBetween('date',[$from->format('Y-m-d'), $to->format('Y-m-d')])->orderBy('date','desc')->get();
		}
		else{
			$requests = DB::table('requests')->where('type', 'Activation Order')->get();
		}

		return view('Admin.index_request',compact('requests','from','to'));
	}
	public function deactivated_user_order(Request $request, $id)
	{
        $setRequest = DB::table('requests')->where('id',$id)->first();
		$user = User::find($setRequest->employee_id);
		$user->update([
			'can_order_directly' => 0
		]);
		DB::table('requests')->where('id',$id)->update(['status' => "Accept"]);

		return redirect()->back()->with(['message' => 'Deactivated feature direct order '.$user->name.' succesfully.']);
	}
}
