<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Models\Menu;
use App\Models\ScheduleMenu;
use App\Models\Order;
use App\Models\User;
use App\Models\Slideshow;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use Telegram\Bot\Laravel\Facades\Telegram;

class EmployeeActionController extends Controller
{
    public function dashboard()
    {
        //declare variable
        $slideshows = Slideshow::orderBy('id','desc')->get();
        $now = Carbon::now();
        $start = Carbon::parse($now->format('Y-m-1'));
        $stop = Carbon::now()->endOfMonth();
        $total_days = $now->diffInDays($stop);
        $user = auth()->user();
        $menu_today = $user->orders()->where('order_date',$now->format('Y-m-d'))->first();
        $menu_tomorrow = $user->orders()->where('order_date',$now->addDay()->format('Y-m-d'))->first();
        $reviews = Order::where('employee_id',$user->id)->where('reviewed_at','!=',null)->orderBy('reviewed_at','desc')->limit(10)->get();
        //data for statistik
        $total_review = Order::where('employee_id',$user->id)->where('reviewed_at','!=',null)->count();
        $total_catering = Order::where('employee_id',$user->id)->whereBetween('order_date',[$now->format('Y-m-1'),$stop->format('Y-m-d')])->count();
        $total_dayoff = 0;
        $total_empty_order = 0;
        for ($i=1; $i <= $now->daysInMonth; $i++, $start->addDay()) { 
            $schedule = ScheduleMenu::where('date',$start->format('Y-m-d'))->first();
            $order = Order::where('employee_id',$user->id)->where('order_date',$start->format('Y-m-d'))->first();
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
        return view('Employee.dashboard',compact('menu_today','menu_tomorrow','now','user','reviews','stop','total_days','total_review','total_catering','total_dayoff','total_empty_order','slideshows'));
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
        $total_days = $start->daysInMonth;

        return view('Employee.index_history_order',compact('now','start','stop','total_days'));     
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
    public function index_request()
    {
        //declare variables
        $user = auth()->user();
        $requests = DB::table('requests')->where('employee_id',$user->id)->where('type', 'Activation Order')->get();

        return view('Employee.index_request',compact('requests','user'));   
    }
    public function create_request(Request $request)
    {
        //Validation Request
        $this->validate($request, [
            'desc' => ['required'],
        ]);
        $now = Carbon::now();
        $user = auth()->user();
        DB::table('requests')->insert([
            'employee_id' => $user->id,
            'employee_name' => $user->name,
            'date' => $now,
            'type' => 'Activation Order',
            'desc' => $request->desc,
            'is_cancel_order' => 0,
            'status' => 'Waiting',
            'created_at' => $now,
            'updated_at' => $now
        ]);
        $user->update([
            'can_order_directly' => 1
        ]);
        $message = 'Request submit successfully.';
        return redirect()->back()->with(['message' => $message]);
    }
    public function destroy_request(Request $request, $id)
    {
        $setRequest = DB::table('requests')->where('id',$id)->first();
        if ($setRequest != null) {
            DB::table('requests')->where('id',$id)->delete();
            $message = 'Request deleted successfully.';
        }
        else{
            $message = 'Request not found or already deleted.';
        }

        return redirect()->back()->with(['message' => $message]);
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
    public function get_schedule(Request $request)
    {
        //declare variable
        $data = [];
        $user = auth()->user();
        $date = Carbon::parse($request->date);
        $schedule = ScheduleMenu::where('date',$date->format('Y-m-d'))->first();
        $order = Order::where('employee_id',$user->id)->where('order_date',$date->format('Y-m-d'))->first();
        if ($order != null) {
            $schedule->id_ordered = $order->id;
        }
        else{
            $schedule->id_ordered = null;
        }
        $i = 1;
        foreach (explode(",",$schedule->menu_list) as $menu_id) {
            $menu = Menu::find($menu_id);
            if ($menu->photos->count() < 1) {
                $photo = url('public/images/no-image.png');
            }
            else{
                $photo = url('public/'.$menu->photos->first()->file);
            }
            $star1 = Order::where('menu_id',$menu->id)->where('stars',1)->count();
            $star2 = Order::where('menu_id',$menu->id)->where('stars',2)->count();
            $star3 = Order::where('menu_id',$menu->id)->where('stars',3)->count();
            $star4 = Order::where('menu_id',$menu->id)->where('stars',4)->count();
            $star5 = Order::where('menu_id',$menu->id)->where('stars',5)->count();
            if(($star1+$star2+$star3+$star4+$star5) == 0){
                $stars = 0;
            }
            else{
                $stars = ( ($star1 * 1) + ($star2 * 2) + ($star3 * 3) + ($star4 * 4) + ($star5 * 5) )/($star1 + $star2 + $star3 + $star4 +$star5);
            }
            if($i == 1){
                $schedule->menu1 = $menu;
                $schedule->menu1->photo = $photo;
                $schedule->menu1->stars = $stars;
            }
            else{
                $schedule->menu2 = $menu;
                $schedule->menu2->photo = $photo;
                $schedule->menu2->stars = $stars;
            }
            $i++;
        }
        //cek if order is exist
        if ($order != null) {
           $schedule->order = $order;
        }
        else{
            $schedule->order = null;
        }
        $schedule->date = $date->format('d M Y');
        return $schedule;
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
        $total_dadakan = Order::where('order_date',$now->format('Y-m-d'))->whereDate('created_at', $now)->count();
        
        return view('Employee.create_order',compact('now','start','stop','next_month','total_dadakan'));
    }
    public function store_order(Request $request)
    {   
        //Validation Request
        $this->validate($request, [
            'date' => ['required'],
            'menu' => ['required'],
            'porsi' => ['required'],
            'shift' => ['required'],
        ]);
        //declare
        $now = Carbon::now();
        $user = auth()->user();
        $total_dadakan = Order::where('order_date',$now->format('Y-m-d'))->whereDate('created_at', $now)->count();
        //cek if employee can order
        if($user->can_order == 0){
            $message = 'Cant submit order, please call admin to activated feature order catering.';
        }
        //input to database
        $date = Carbon::parse($request->date);
        $code_number = 'ORD'.$date->format('ymd').$user->id;
        $menu = Menu::find($request->menu);
        //inser into database
        DB::beginTransaction();
        try {
            $order = Order::where('employee_id',$user->id)->where('order_date',$date->format('Y-m-d'))->first();
            //check if sambal added
            if ($request->sambal == null) {
                $sambal = 0;
            }
            else{
                $sambal = 1;
            }
            if($order == null){
                if($total_dadakan > 5){
                    $message = 'Cant submit order, Order closed.';
                    return $message;
                }
                elseif($date->format('Y-m-d') == $now->format('Y-m-d') && $now->hour >= 9){
                    $message = 'Cant submit order, Order closed.';
                    return $message;
                }
                $order = Order::create([
                    'employee_id' => $user->id,
                    'employee_name' => $user->name,
                    'order_number' => $code_number,
                    'menu_id' => $menu->id,
                    'menu_name' => $menu->name,
                    'order_date' => $date->format('Y-m-d'),
                    'serving' => $request->porsi,
                    'is_sauce' => $sambal,
                    'shift' => $request->shift,
                    'fee' => $menu->price
                ]);
            }
            else{

                if($date->format('Y-m-d') == $now->format('Y-m-d') && $now->hour >= 9){
                    $message = 'Cant Update order, Order closed.';
                    return $message;
                }
                $order->update([
                    'menu_id' => $menu->id,
                    'menu_name' => $menu->name,
                    'serving' => $request->porsi,
                    'is_sauce' => $sambal,
                    'shift' => $request->shift,
                    'fee' => $menu->price
                ]);
            }
            if($order != null){
                DB::commit();
            }
        } catch (\Exception $e) {
            DB::rollback();
            $message = $e->getMessage();
            return $message;
        }
        if($order->order_date == $now->format('Y-m-d')) {
            $sudden_orders = Order::where('order_date',$now->format('Y-m-d'))->whereDate('created_at', $now)->get();
            $text = "Additional Catering today \n".$now->format('d, M Y l')."\n \n";
            //order dadakan
            $text .= "============================== \n";
            $i = 1;
            foreach ($sudden_orders as $sudden_order) {
                $cekCreated_at = Carbon::parse($order->created_at);
                $cekUpdated_at = Carbon::parse($order->updated_at);
                $text .= $i.". ".$sudden_order->employee_name." - ".$sudden_order->menu_name.' porsi '.$sudden_order->serving." ";
                if($sudden_order->is_sauce == 1){
                    $text .= "(sambal)";
                }
                if ($cekUpdated_at != $cekCreated_at) {
                    $text .= " |edited";
                }
                $text .= "\n";
                $i++;
            }
            $text .= "\n ===========================\n";
            $text .= "Total Fee = Rp. ". number_format($sudden_orders->sum('fee'));
            Telegram::sendMessage([
                'chat_id' => env('TELEGRAM_CHANNEL_ID',''),
                'parse_mode' => 'HTML',
                'text' => $text
            ]);

        }

        $message = 'Order submited successfully.';
        return $message;
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
        //declare variable
        $now = Carbon::now();
        $order = Order::where('order_number',$code)->first();
        //check if order founded
        if($order == null){
            return redirect()->back()->withErrors(['message' => 'Order not found.']);
        }
        
        if($request->submit == 'storeNote'){
            //Validation Request
            $this->validate($request, [
                'note' => ['required']
            ]);
            //add review and stars rating to order
            DB::beginTransaction();
            try {
                $order->update([
                    'note' => $request->note,
                ]);
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->withErrors(['message' => $e->message]);
            }
            DB::commit();
            return redirect()->back()->with(['message' => 'Note submited successfully.']);
        }
        //Validation Request
        $this->validate($request, [
            'review' => ['required', 'min:5'],
            'stars' => ['required', 'numeric']
        ]);
        
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
