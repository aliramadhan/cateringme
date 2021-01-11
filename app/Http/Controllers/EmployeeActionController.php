<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Models\Menu;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;

class EmployeeActionController extends Controller
{
    public function dashboard()
    {
        //declare variable
        $now = Carbon::now();
        $user = auth()->user();
        $menu_today = $user->orders()->where('order_date',$now->format('Y-m-d'))->first();
        $menu_tomorrow = $user->orders()->where('order_date',$now->addDay()->format('Y-m-d'))->first();
        $now = Carbon::now();

        return view('Employee.dashboard',compact('menu_today','menu_tomorrow','now','user'));
    }
    public function get_date(Request $request)
    {
        //declare variable
        $user = auth()->user();
        $now = Carbon::parse($request->month);
        $dates = new Collection;
        $month = $now->format('F');
        $total = $now->daysInMonth;
        for ($i=1; $i <= $total; $i++,$now->addDay()) { 
            $order = Order::where('employee_id',$user->id)->where('order_date',$now->format('Y-m-d'))->first();
            if ($now < Carbon::now() && $order != null) {
                $input = "<label class='label flex-auto  duration-1000'>
                    <input class='label__checkbox  duration-1000' type='checkbox' checked disabled value='".$now->format('d')."' name='dates[]'>
                    <span class='label__text font-base'>
                        <span class='label__check p-4  bg-orange-400 rounded-lg text-white  hover:bg-orange-600 duration-1000 text-justify'>
                          <i class='fa icon text-base font-bold absolute text-xl m-auto'>".$now->format('d')."</i>
                        </span>
                    </span>
                </label>";
            }
            elseif($order != null){
                $input = "<label class='label flex-auto  duration-1000'>
                    <input class='label__checkbox  duration-1000' type='checkbox' checked value='".$now->format('d')."' name='dates[]'>
                    <span class='label__text font-base'>
                        <span class='label__check p-4  bg-orange-400 rounded-lg text-white  hover:bg-orange-600 duration-1000 text-justify'>
                          <i class='fa icon text-base font-bold absolute text-xl m-auto'>".$now->format('d')."</i>
                        </span>
                    </span>
                </label>";
            }
            elseif($now < Carbon::now()){
                $input = "<label class='label flex-auto  duration-1000'>
                    <input class='label__checkbox  duration-1000' type='checkbox' disabled value='".$now->format('d')."' name='dates[]'>
                    <span class='label__text font-base'>
                        <span class='label__check p-4  bg-gray-400 rounded-lg text-white  hover:bg-orange-600 duration-1000 text-justify'>
                          <i class='fa icon text-base font-bold absolute text-xl m-auto'>".$now->format('d')."</i>
                        </span>
                    </span>
                </label>";
            }
            else{
                $input = "<label class='label flex-auto  duration-1000'>
                    <input class='label__checkbox  duration-1000' type='checkbox' value='".$now->format('d')."' name='dates[]'>
                    <span class='label__text font-base'>
                        <span class='label__check p-4  bg-blue-400 rounded-lg text-white  hover:bg-orange-600 duration-1000 text-justify'>
                          <i class='fa icon text-base font-bold absolute text-xl m-auto'>".$now->format('d')."</i>
                        </span>
                    </span>
                </label>";
            }
            $dates->push($input);
        }
        $data = ['month' => $month, 'dates' => $dates];
        return $data;
    }
    public function choose_order()
    {
    	foreach (CarbonPeriod::create(Carbon::parse('01-01-2020'), '1 month', Carbon::today()) as $month) {

            $months[$month->format('m-Y')] = $month;
        }
        return view('Employee.choose_order',compact('months'));
    }
    public function create_order($month)
    {
    	//declare variable
        $now = Carbon::now();
    	$month =  Carbon::parse($month);
    	$dates = $month->daysInMonth;
    	$menus = Menu::where('show',1)->get();

        return view('Employee.create_order',compact('dates','month','menus','now'));
    }
    public function store_order(Request $request)
    {    	
		//Validation Request
		$this->validate($request, [
            'dates' => ['required'],
            'menu' => ['required']
        ]);

        //declare
        $cek = 1;
        $user = auth()->user();
        $menu = Menu::where('menu_code',$request->menu)->first();

        foreach($request->dates as $date){
            //create code number for order
            $last_id = Order::all()->count();
            $len = strlen(++$last_id);
            for($i=$len; $i< 4; ++$i) {
                $last_id = '0'.$last_id;
            }
            $code_number = 'ORD'.$last_id;
        	//inser into database
			DB::beginTransaction();
			try {
				$order = Order::updateOrCreate([
					'employee_id' => $user->id,
					'order_date' => Carbon::parse($date)->format('Y-m-d')
				],[
                    'order_number' => $code_number,
                    'menu_id' => $menu->id
                ]);
				if($order != null){
					DB::commit();
					$cek++;
				}
			} catch (\Exception $e) {
			    DB::rollback();
	        	return redirect()->back()->withErrors(['message' => 'Error Accuired.']);
			}
        }
		return redirect()->route('employee.choose.order')->with(['message' => 'Order '.$cek.' submited successfully.']);
    }
}
