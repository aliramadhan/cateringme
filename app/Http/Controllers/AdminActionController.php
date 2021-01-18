<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\User;
use \App\Models\Order;
use \App\Models\Menu;
use \App\Models\OffDate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterSuccessfully;
use Illuminate\Support\Facades\Hash;
use DB;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class AdminActionController extends Controller
{
	public function dashboard()
	{
		//describe variable
		$now = Carbon::now();
		$employees = User::where('role','Employee')->get();
		$yesterday = Carbon::now()->subDay();
		$menus = Menu::where('show',1)->get();
		$reviews = Order::orderBy('order_date','desc')->get();
		$orders = Order::where('order_date',$now->format('Y-m-d'))->get();

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

		return view('Admin.dashboard',compact('menus','catering_taken','subcatering_taken', 'persen_catering_taken', 'not_taken', 'subnot_taken', 'persen_not_taken','reviews','orders','now'));
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
			$last_id = User::where('role','Catering')->get()->count();
		}
		else{
			$code_initial = 'EMP';
			$last_id = User::where('role','Employee')->get()->count();
		}
		$len = strlen(++$last_id);
		for($i=$len; $i< 4; ++$i) {
	        $last_id = '0'.$last_id;
	    }
	    $code_number = $code_initial.$last_id;

		//Fill detail for email
		$data = [
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
        	return redirect()->back()->withInputs()->withErrors(['message' => 'new Account added.']);
		}
        return redirect()->route('admin.index.account')->with(['message' => 'new Account added.']);
	}
	public function index_menu()
	{
		$menus = Menu::all();

		return view('Admin.index_menu',compact('menus'));
	}
	public function scheduled_menu(Request $request)
	{
		//Validation Request
		$this->validate($request, [
            'show' => ['required'],
        ]);

		//reset show menu
		$reset = DB::table('menus')->update(array('show' => 0));

        //insert into database
		DB::beginTransaction();
		try {
			if($request->show == null){
				//do something if null
			}
			else{
				foreach ($request->show as $show) {
					$menu = Menu::where('menu_code',$show)->first();
					$menu->show = 1;
					$menu->save();
				}
			}
		} catch (\Exception $e) {
		    DB::rollback();
        	return redirect()->back()->withInputs()->withErrors(['message' => 'Error accuired.']);
		}
	    // all good
	    DB::commit();
        return redirect()->back()->with(['message' => 'Menu has been scheduled.']);
	}
	public function index_schedule()
	{
		$now = Carbon::now();
		$start = $now->startOfMonth();
		$months = new Collection;
		for ($i=0; $i < 6; $i++, $start->addMonth()) { 
			$months->push(Carbon::parse($start->format('Y-m')));
		}
		return view('Admin.index_schedule',compact('months'));
	}
	public function get_month_schedule(Request $request)
	{
		//declare variable
		$date = Carbon::parse($request->month);
		$start = $date->startOfMonth();
		$off_date = OffDate::where('year',$start->year)->where('month',$start->month)->first();
		$total_days = $date->daysInMonth;
		$days = new Collection;
		for ($i=1; $i <= $total_days ; $i++, $start->addDay()) { 
			$input = "
			<label class='label flex-auto  duration-1000'>
	                    <input class='label__checkbox  duration-1000' type='checkbox' value='".$start->format('Y-m-d')."' name='dates[]' >
	                    <span class='label__text '>
	                        <span class='label__check rounded-lg text-white  duration-1000 text-justify' style='background-image: linear-gradient(160deg, #0093E9 0%, #80D0C7 100%);'>
	                          <i class='fa icon font-bold absolute text-xl m-auto text-center flex flex-col transform hover:scale-125 p-10 duration-1000' style='font-family: Poppins, sans-serif;'>
	                       
	                          	<div class='font-semibold text-4xl mb-2 '>".$start->format('d')."</div>
	                          	<div class='text-xs font-base'>".$start->format('l')."</div>
	                          	
	                          	</i>
	                        </span>
	                    </span>
	                </label>";
			if ($off_date != null) {
				if (in_array($start->day, explode(',', $off_date->date_list))) {
					$input = "<label class='label flex-auto  duration-1000'>
			                    <input class='label__checkbox  duration-1000' type='checkbox' checked value='".$start->format('Y-m-d')."' name='dates[]'>
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
        ]);

        //declare variable
        $date_list = [];
        foreach ($request->dates as $date) {
        	$date_list [] = Carbon::parse($date)->day;
        }
        $now = Carbon::parse($request->month);

        //insert into database
        $off_date = OffDate::where('year', $now->year)->where('month', $now->month)->first();
		DB::beginTransaction();
		try {
			if($off_date == null){
				$off_date = OffDate::create([
					'year' => $now->year,
					'month' => $now->month,
					'date_list' => implode(',',$date_list)
				]);
			}
			else{
				$off_date->update([
					'date_list' => implode(',',$date_list)
				]);
			}
		} catch (\Exception $e) {
		    DB::rollback();
        	return redirect()->back()->withInputs()->withErrors(['message' => 'Error accuired.']);
		}
	    // all good
	    DB::commit();
        return redirect()->back()->with(['message' => 'Order has been scheduled.']);
	}
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
