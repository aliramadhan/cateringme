<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Models\Menu;
use App\Models\ScheduleMenu;
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
        $start = Carbon::parse($now->format('Y-m-1'));
        $stop = Carbon::now()->endOfMonth();
        $total_days = $now->diffInDays($stop);
        $user = auth()->user();
        $menu_today = $user->orders()->where('order_date',$now->format('Y-m-d'))->first();
        $menu_tomorrow = $user->orders()->where('order_date',$now->addDay()->format('Y-m-d'))->first();
        $reviews = Order::orderBy('reviewed_at','desc')->limit(10)->get();
        //data for statistik
        $total_review = Order::where('reviewed_at','!=',null)->count();
        $total_catering = Order::whereBetween('order_date',[$now->format('Y-m-1'),$stop->format('Y-m-d')])->count();
        $total_dayoff = 0;
        $total_empty_order = 0;
        for ($i=1; $i <= $now->daysInMonth; $i++, $start->addDay()) { 
            $schedule = ScheduleMenu::where('date',$start->format('Y-m-d'))->first();
            $order = Order::where('order_date',$start->format('Y-m-d'))->first();
            if ($schedule == null) {
                $total_dayoff++;
            }
            else{
                if($order == null) {
                    $total_empty_order++;
                }
            }
        }

        $now = Carbon::now();
        return view('Employee.dashboard',compact('menu_today','menu_tomorrow','now','user','reviews','stop','total_days','total_review','total_catering','total_dayoff','total_empty_order'));
    }
    public function history_order(Request $request)
    {
        //declare variables
        $now = Carbon::now();
        $start = Carbon::now()->startOfMonth();
        $stop = Carbon::now()->endOfMonth();
        if ($request->month != null) {
            $start = Carbon::parse($request->month)->startOfMonth();
            $stop = Carbon::parse($request->month)->endOfMonth();
        }

        return view('Employee.index_history_order',compact('now','start','stop'));     
    }
    public function history_review(Request $request)
    {
        //declare variables
        $now = Carbon::now();
        $start = Carbon::now()->startOfMonth();
        $stop = Carbon::now()->endOfMonth();
        if ($request->month != null) {
            $start = Carbon::parse($request->month)->startOfMonth();
            $stop = Carbon::parse($request->month)->endOfMonth();
        }

        return view('Employee.index_history_review',compact('now','start','stop'));   
    }
    public function get_photos(Request $request)
    {
        //declare variable
        $menu = Menu::findOrFail($request->menu_id);
        $photos = [];
        $data_photo = new Collection;
        $i = 1;
        //Set item photos
        if($menu->photos->count() < 1){
            $data = "<div class='carousel-item h-100 active'>
                      <img class='d-block w-100 h-96 bg-cover' src='".url('public/images/no-image.png')."' alt='First slide'>
                    </div>";
            $data_photo->push($input);
        }
        else{
            foreach ($menu->photos as $photo) {
                if ($i == 1) {
                    $data = "<div class='carousel-item h-100 active'>
                              <img class='d-block w-100 h-96 bg-cover' src='".url('public/'.$photo->file)."' alt='First slide'>
                            </div>";
                }
                else{
                    $data = "<div class='carousel-item h-100'>
                          <img class='d-block w-100 h-96 bg-cover' src='".url('public/'.$photo->file)."' alt='".$menu->name.'-'.$i."'>
                        </div>";
                }
                $data_photo->push($data);
                $i++;
            }

        }
        $photos = ['menu' => $menu, 'data' => $data_photo];
        return $photos;
    }
    /*public function get_date(Request $request)
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
                        <span class='label__check rounded-lg text-white  duration-1000 text-justify' style='background-image: radial-gradient( circle 422px at -10.3% 110.7%, rgba(219,76,180,1) 9.5%, rgba(231,119,209,1) 50.8%, rgba(255,180,241,1) 88.5% );'>
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
        $now = Carbon::now();
        $start = Carbon::now()->startOfMonth();
        $stop = Carbon::now()->endOfMonth();
        return view('Employee.create_order',compact('now','start','stop'));
        //declare variable
        $user = auth()->user();
        $now = Carbon::now();
        $start = $now->startofMonth();
        $total_date = $now->daysInMonth;
        $menus = Menu::where('show',1)->get();
        //declare off date
        $off_date = OffDate::where('year',$now->year)->where('month',$now->month)->first();
        if($off_date == null){
            $off_date = ['0'];
        }
        else{
            $off_date = explode(',', $off_date->date_list);
        }
        foreach ($menus as $menu) {
            $rate = $menu->orders()->where('order_date','<=',$now->format('Y-m-d'))->avg('stars');
            $menu->rate = $rate;
            if($rate == null){
                $menu->rate = 0;
            }
        }
    	foreach (CarbonPeriod::create(Carbon::parse('01-01-2021'), '1 month', Carbon::today()) as $month) {

            $months[$month->format('m-Y')] = $month;
        }
        return view('Employee.choose_order',compact('months','menus','start','total_date','now','user','off_date'));
    }*/
    public function create_order()
    {
        //declare variable
        $now = Carbon::now();
        $next_month = Carbon::parse($now->format('Y-m'))->addMonth()->startOfMonth();
        $start = Carbon::now()->startOfMonth();
        $stop = Carbon::now()->endOfMonth();
        return view('Employee.create_order',compact('now','start','stop','next_month'));
    }
    public function store_order(Request $request)
    {   
        //Validation Request
        $this->validate($request, [
            'dates' => ['required'],
        ]);
        //declare
        $now = Carbon::now();
        $user = auth()->user();
        //cek if employee can order
        if($user->can_order == 0){
            return redirect()->back()->withErrors(['message' => "Cant submit order, please call admin to activated feature order catering."]);
        }
        foreach ($request->dates as $date) {
            $date = Carbon::parse($date);
            $code_number = 'ORD'.$date->format('ymd').$user->id;
            $menu = Menu::find($request->input('menu'.$date->day));
            //inser into database
            DB::beginTransaction();
            try {
                $order = Order::where('employee_id',$user->id)->where('order_date',$date->format('Y-m-d'))->first();
                //check if sambal added
                if ($request->input('sambal'.$date->day) == null) {
                    $sambal = 0;
                }
                else{
                    $sambal = 1;
                }
                if($order == null){
                    $order = Order::create([
                        'employee_id' => $user->id,
                        'order_number' => $code_number,
                        'menu_id' => $menu->id,
                        'order_date' => Carbon::parse($date)->format('Y-m-d'),
                        'serving' => $request->input('porsi'.$date->day),
                        'is_sauce' => $sambal,
                        'shift' => $request->input('shift'.$date->day),
                        'fee' => $menu->price
                    ]);
                }
                else{
                    if ($date < $now->format('Y-m-d')) {
                        continue;
                    }
                    $order->update([
                        'menu_id' => $menu->id,
                        'serving' => $request->input('porsi'.$date->day),
                        'is_sauce' => $sambal,
                        'shift' => $request->input('shift'.$date->day),
                        'fee' => $menu->price
                    ]);
                    $order->menu_id = $request->input($date->day);
                    $order->save();
                }
                if($order != null){
                    DB::commit();
                }
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->withErrors(['message' => $e->getMessage()]);
            }
        }
		return redirect()->route('employee.create.order')->with(['message' => ' Order submited successfully.']);
    }
    public function delete_order($id)
    {
        $order = Order::findOrFail($id);
        $date = Carbon::parse($order->order_date);
        $message = "Your order on date ". $date->format('d, M Y'). ' has been canceled successfully.';
        $order->delete();

        return redirect()->back()->with(['message' => $message]);
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
                'note' => $request->note,
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
