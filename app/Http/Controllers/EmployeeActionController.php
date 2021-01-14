<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Models\Menu;
use App\Models\OffDate;
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
        $reviews = Order::orderBy('reviewed_at','desc')->limit(10)->get();
        $off_date = OffDate::where('year',$now->year)->where('month',$now->month)->first();
        if($off_date == null){
            $off_date = ['0'];
        }
        else{
            $off_date = explode(',', $off_date->date_list);
        }

        $now = Carbon::now();
        return view('Employee.dashboard',compact('menu_today','menu_tomorrow','now','user','off_date','reviews'));
    }
    public function get_date(Request $request)
    {
        //declare variable
        $user = auth()->user();
        $now = Carbon::parse($request->month);
        $dates = new Collection;
        $month = $now->format('F Y');
        $total = $now->daysInMonth;
        $off_date = OffDate::where('year',$now->year)->where('month',$now->month)->first();
        if($off_date == null){
            $off_date = ['0'];
        }
        else{
            $off_date = explode(',', $off_date->date_list);
        }
        for ($i=1; $i <= $total; $i++,$now->addDay()) { 
            $order = Order::where('employee_id',$user->id)->where('order_date',$now->format('Y-m-d'))->first();
            if(in_array($now->day, $off_date)){
                $input = "<label class='label flex-auto  duration-1000'>
                    <input class='label__checkbox  duration-1000' type='checkbox' disabled value='".$now->format('Y-m-d')."' name='dates[]'>
                    <span class='label__text '>
                            <span class='label__check rounded-lg text-white  duration-1000 text-justify' style='background: linear-gradient(to right, #ff416c, #ff4b2b);'>
                              <i class='fa icon font-bold absolute text-xl m-auto text-center flex flex-col transform hover:scale-125 duration-1000 p-10' style='font-family: Poppins, sans-serif;'>
                           
                                <div class='font-semibold text-4xl mb-2 '>".$now->format('d')."</div>
                                <div class='text-xs font-base'>".$now->format('l')."</div>
                                
                                </i>
                            </span>
                        </span>
                </label>";
            }
            elseif ($now < Carbon::now() && $order != null) {
                $input = "<label class='label flex-auto  duration-1000'>
                    <input class='label__checkbox  duration-1000' type='checkbox' checked disabled value='".$now->format('Y-m-d')."' name='dates[]'>
                    <span class='label__text font-base'>
                         <span class='label__check rounded-lg text-white  duration-1000 text-justify' style='background-image: linear-gradient( 135deg, #FCCF31 10%, #F55555 100%);'>
                              <i class='fa icon font-bold absolute text-xl m-auto text-center flex flex-col ' style='font-family: Poppins, sans-serif;'>
                           
                                <div class='font-semibold text-4xl'>".$now->format('d')."</div>
                                <div class='text-xs font-base'>".$now->format('l')."</div>
                                
                                </i>
                            </span>
                    </span>
                </label>";
            }
            elseif($order != null){
                $input = "<label class='label flex-auto  duration-1000'>
                    <input class='label__checkbox  duration-1000' type='checkbox' value='".$now->format('Y-m-d')."' name='dates[]'>
                    <span class='label__text font-base'>
                        <span class='label__check rounded-lg text-white  duration-1000 text-justify' style='background-image: linear-gradient( 135deg, #FCCF31 10%, #F55555 100%);'>
                              <i class='fa icon font-bold absolute text-xl m-auto text-center flex flex-col ' style='font-family: Poppins, sans-serif;'>
                           
                                <div class='font-semibold text-4xl'>".$now->format('d')."</div>
                                <div class='text-xs font-base'>".$now->format('l')."</div>
                                
                                </i>
                            </span>
                    </span>
                </label>";
            }
            elseif($now < Carbon::now()){
                $input = "<label class='label flex-auto  duration-1000'>
                    <input class='label__checkbox  duration-1000' type='checkbox' disabled value='".$now->format('Y-m-d')."' name='dates[]'>
                      <span class='label__text '>
                          <span class='label__check rounded-lg text-white  duration-1000 text-justify' style='background-image: linear-gradient(160deg, #bdbdbe 0%, #032a32 100%);'>
                              <i class='fa icon font-bold absolute text-xl m-auto text-center flex flex-col ' style='font-family: Poppins, sans-serif;'>
                           
                                <div class='font-semibold text-4xl'>".$now->format('d')."</div>
                                <div class='text-xs font-base'>".$now->format('l')."</div>
                                
                                </i>
                            </span>
                        </span>
                </label>";
            }
            else{
                $input = "<label class='label flex-auto  duration-1000'>
                    <input class='label__checkbox  duration-1000' type='checkbox' value='".$now->format('Y-m-d')."' name='dates[]'>
                     <span class='label__text '>
                            <span class='label__check rounded-lg text-white  duration-1000 text-justify' style='background-image: linear-gradient(160deg, #0093E9 0%, #80D0C7 100%);'>
                              <i class='fa icon font-bold absolute text-xl m-auto text-center flex flex-col transform hover:scale-125 duration-1000 p-10' style='font-family: Poppins, sans-serif;'>
                           
                                <div class='font-semibold text-4xl'>".$now->format('d')."</div>
                                <div class='text-xs font-base'>".$now->format('l')."</div>
                                
                                </i>
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
        $menus = Menu::where('show',1)->get();
    	foreach (CarbonPeriod::create(Carbon::parse('01-01-2020'), '1 month', Carbon::today()) as $month) {

            $months[$month->format('m-Y')] = $month;
        }
        return view('Employee.choose_order',compact('months','menus'));
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
        $cek = 0;
        $now = Carbon::now();
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
                $order = Order::where('employee_id',$user->id)->where('order_date',$date)->first();
                if($order == null){
                    $order = Order::create([
                        'employee_id' => $user->id,
                        'order_number' => $code_number,
                        'menu_id' => $menu->id,
                        'order_date' => Carbon::parse($date)->format('Y-m-d'),
                    ]);
                }
                else{
                    if ($date < $now->format('Y-m-d')) {
                        continue;
                    }
                    $order->menu_id = $menu->id;
                    $order->save();
                }
				if($order != null){
					DB::commit();
					$cek++;
				}
			} catch (\Exception $e) {
			    DB::rollback();
	        	return redirect()->back()->withErrors(['message' => $e->message]);
			}
        }
		return redirect()->route('employee.choose.order')->with(['message' => $cek.' Order submited successfully.']);
    }
    public function store_review(Request $request, $code)
    {
        //Validation Request
        $this->validate($request, [
            'review' => ['required', 'min:5'],
            'stars' => ['required', 'numeric']
        ]);
        //declare variable
        $now = Carbon::now();
        $order = Order::where('order_number',$code)->first();
        //check if order founded
        if($order == null){
            return redirect()->back()->withErrors(['message' => 'Order not found.']);
        }

        //add review and stars rating to order
        DB::beginTransaction();
        try {
            $order->update([
                'review' => $request->review,
                'stars' => $request->stars,
                'reviewed_at' => $now
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['message' => $e->message]);
        }
        DB::commit();
        return redirect()->back()->with(['message' => 'Review submited successfully.']);
    }
}
