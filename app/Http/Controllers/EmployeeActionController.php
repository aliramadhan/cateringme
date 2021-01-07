<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class EmployeeActionController extends Controller
{
    public function create_order()
    {
    	foreach (CarbonPeriod::create(Carbon::parse('01-01-2020'), '1 month', Carbon::today()) as $month) {
            $months[$month->format('m-Y')] = $month->format('F Y');
        }
        return $months;
    }
}
