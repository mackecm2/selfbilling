<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\UploadRequest;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Debugbar;
use Illuminate\Support\Facades\DB;
use App\Userdoc;

class UserdocController extends Controller
{

    function index()
    {
        $userdocs = \App\Userdoc::all();
        echo '<pre>';
        print_r($userdocs);
        echo '</pre>';
    }
    
    public function showprint(Request $request)
    {
        $request->input('id'); 
      $file = $request->file('image');
   
        //Display File Name
        echo 'File Name: '.$file->getClientOriginalName();
        echo '<br>';

        //Display File Extension
        echo 'File Extension: '.$file->getClientOriginalExtension();
        echo '<br>';

        //Display File Real Path
        echo 'File Real Path: '.$file->getRealPath();
        echo '<br>';

        //Display File Size
        echo 'File Size: '.$file->getSize();
        echo '<br>';

        //Display File Mime Type
        echo 'File Mime Type: '.$file->getMimeType();

        //Move Uploaded File
        $destinationPath = 'uploads';
        $file->move($destinationPath,$file->getClientOriginalName());
    }
    
    public function uploadForm()
    {
        return view('upload_form');
    }
 
    public function uploadSubmit(Request $request)
    {
        Debugbar::addMessage('processing the upload file', 'upload');
        if($request->input('confirm_agree') == 1)
        {
            dd($request);
            
        }
        $this->validate($request, [
            'doc_name' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
dd($request);
        $startdate = \Auth::user()->expirydate;
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
#Debugbar::addMessage('processing the upload file', 'upload');
#dd($request);
        if ($request->hasFile('doc_name')) {
            $image = $request->file('doc_name');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $this->save();
#Debugbar::addMessage('Saved the upload file', 'upload');
  #          return back()->with('success','Image Upload successfully');
            activity()->log(\Auth::user()->name.' uploaded '.$name);
            return view('home',
            [ 'confirm_agree' => 1, 
                'doc_name' => $image,
                'startdate' => $startdate,
                'expirydate' => $expirydate,
                'message' => "Thank you for submitting your documents. We will now proceed with the verification process, and a copy of this agreement will be e-mailed to you.",
                'uploaded' => true
            ]);
        } else {
            
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