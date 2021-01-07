<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Models\Menu;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class EmployeeActionController extends Controller
{
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
    	$month =  Carbon::parse($month);
    	$dates = $month->daysInMonth;
    	$menus = Menu::where('show',1)->get();

        return view('Employee.create_order',compact('dates','month','menus'));
    }
    public function store_order(Request $request)
    {    	
		//Validation Request
		$this->validate($request, [
            'dates' => ['required'],
            'menu' => ['required']
        ]);

        //create code number for menu
		$last_id = Order::all()->count();
		$len = strlen(++$last_id);
		for($i=$len; $i< 4; ++$i) {
	        $last_id = '0'.$last_id;
	    }
	    $code_number = 'ORD'.$last_id;

        //declare
        $cek = 1;
        $user = auth()->user();
        $menu = Menu::where('menu_code',$request->menu)->first();

        foreach($request->dates as $date){
        	//inser into database
			DB::beginTransaction();
			try {
				$order = Order::updateOrCreate([
					'employee_id' => $user->id,
					'menu_id' => $menu->id,
					'order_number' => $code_number,
					'order_date' => Carbon::parse($date)->format('Y-m-d')
				],['menu_id' => $menu->id]);
				if($order != null){
					DB::commit();
					$cek++;
				}
			} catch (\Exception $e) {
			    DB::rollback();
	        	return redirect()->back()->withErrors(['message' => 'Error Accuired.']);
			}
        }
        return dd($cek);
		return redirect()->route('employee.choose.order')->with(['message' => 'Order '.$cek.' submited successfully.']);
    }
}
