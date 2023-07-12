<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Debugbar;
use Request;
#use Illuminate\Http\Request;
use App\Http\Requests\HomeRequest;
use Illuminate\Foundation\Http\FormRequest;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(HomeRequest $request = NULL)
    {
        $startdate = \Auth::user()->expirydate;
        $today = date('Y-m-d');
        if ($request) {
            activity()->log(\Auth::user()->name.' clicked submit with errors '.$errors);
        } else {
            activity()->log(\Auth::user()->name.' logged in, current expiry date is '.$startdate);
        }
        
        if ($today > $startdate) {
            $startdate = $today; # current time is greater than expiry date  and thus in the past
        }
        $month = Carbon::createFromFormat('Y-m-d', $startdate)->month;
        $year = Carbon::createFromFormat('Y-m-d', $startdate)->year + 2;
        $day = Carbon::createFromFormat('Y-m-d', $startdate)->day;
        if ($month < 7) {
            $ultimo_jan_str = $year . "-02-00"; 
            $ultimo_jan_date = date_create($ultimo_jan_str);
            $expirydate = date_format($ultimo_jan_date, "Y-m-d");
        } else {
            $ultimo_jun_str = $year . "-07-00"; 
            $ultimo_jun_date = date_create($ultimo_jun_str);
            $expirydate = date_format($ultimo_jun_date, "Y-m-d");
        }
        if ($request) {
            $vat_number = $request->input('vatnumber');
            $doc_name = $request->input('doc_name');
            $confirm_agree = $request->input('confirm_agree');
        } else {
			$vat_number = Request::old('vatnumber');
            $doc_name = Request::old('doc_name');
            $confirm_agree = Request::old('confirm_agree');
        }
		return view('home',
            [ 'expirydate' => $expirydate,
              'startdate' => $startdate,
			  'vatnumber' => $vat_number,
			  'doc_name' => $doc_name,
			  'confirm_agree' => $confirm_agree,
              'uploaded' => FALSE,
              'message' => ""
            ]);
			
    }
        /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        Debugbar::addMessage('validating', 'HomeController');
        return [
            'doc_name' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }
}
