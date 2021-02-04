<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\User;
use \App\Models\Order;
use \App\Models\Menu;
use \App\Models\ScheduleMenu;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterSuccessfully;
use Illuminate\Support\Facades\Hash;
use DB;
use Telegram\Bot\Laravel\Facades\Telegram;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

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
		$reviews = Order::orderBy('reviewed_at','desc')->get();
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
		return view('Admin.index_account',compact('users'));
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
            'role' => ['required', 'string'],
            'number_phone' => ['numeric','unique:users','digits_between:10,15'],
            'address' => ['string'],
        ]);
		//Create Random char
		$password = bin2hex(random_bytes(4));

		//Create Employee/Catering Code
		if($request->role == 'Catering'){	
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
				'email' => $request->email,
				'password' => Hash::make($password),
				'role' => $request->role,
				'number_phone' => $request->number_phone,
				'code_number' => $code_number,
				'address' => $request->address,
			]);
		    DB::commit();
			$send_mail = Mail::to($request->email)->send(new RegisterSuccessfully($data));
		    // all good
		} catch (\Exception $e) {
		    DB::rollback();
        	return redirect()->back()->withInputs()->withErrors(['message' => $e->getMessage()]);
		}
        return redirect()->route('admin.index.account')->with(['message' => 'new '.$request->role.' added succesfully.']);
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
		$user = User::where('code_number',$code)->first();
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
			$not_taken = 0;
			$employee->total_order = $employee->orders->count();
			if ($request->from != null && $request->to != null) {
				$from = Carbon::parse($request->from);
				$to = Carbon::parse($request->to);
				$start = Carbon::parse($request->from);
				$stop = Carbon::parse($request->to);
				$total_days = $start->diffInDays($stop);
				$employee->total_order = $employee->orders->whereBetween('order_date',[$start->format('Y-m-d'),$stop->format('Y-m-d')])->count();
			}
			for ($i=0; $i <= $total_days; $i++,$start->addDay()) { 
				$order = $employee->orders()->where('order_date',$start->format('Y-m-d'))->first();
				$schedule = ScheduleMenu::where('date',$start->format('Y-m-d'))->first();
				if ($order == null && $schedule != null) {
					$employee->total_not_order = $not_taken++;
				}
			}
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
}
