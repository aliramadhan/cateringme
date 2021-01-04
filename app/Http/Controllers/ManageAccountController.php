<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterSuccessfully;
use Illuminate\Support\Facades\Hash;
use DB;

class ManageAccountController extends Controller
{
    public function __construct()
	{
        $this->middleware('auth');
	}
	public function index_account()
	{
		$users = User::where('role','!=','Admin')->get();
		return view('ManageAccount.index_Account',compact('users'));
	}
	public function create_account()
	{
		return view('ManageAccount.create_Account');
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
}
