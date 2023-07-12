<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

use App\User;
use App\Mail\AgreementApproved;
use App\Mail\AgreementRejected;
use App\Mail\SubmissionThankYou;
use Illuminate\Http\Request;
use App\Http\Requests\UploadRequest;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Debugbar;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    // SELECT xtrf_id , legalname , email, expirydate, uploaded, approved FROM `users` LEFT JOIN `userdocs` ON users.id = userdocs.userid 
    function showall()
    {
        $today = date('Y-m-d', strtotime('+6 months'));
        $alluserdocs = User::sortable()->whereNull('approved')
            ->where('expirydate', '>', '2018-11-01')
            ->where('expirydate', '<', $today)
            ->whereNotNull('xtrf_id')
            ->whereNotNull('expirydate')
            ->whereNotNull('emailed_at')
            ->orderBy('uploaded', 'desc')
            ->get();

        return view('showall',
            [ 'alluserdocs' => $alluserdocs
        ]);
    }
    
    function showapproved()
    {
        $today = date('Y-m-d', strtotime('+6 months'));
        $alluserdocs = User::sortable()->whereNotNull('approved')
            ->get();

        return view('showapproved',
            [ 'alluserdocs' => $alluserdocs
        ]);
    }
      
    protected function approve(Request $user)
    {
        $thisuser = \App\User::find($user->input('id'));
        if($user->input('id')) {
            $thisuser->approved = $user->input('approved');
        }
        if($thisuser) {
            $thisuser->save();
            activity()->log(\Auth::user()->name.' approved user '.$thisuser->name);
            \Mail::to($thisuser)->send(new AgreementApproved($thisuser)); 
            return $user->input('id');
        }
    }
    
    protected function reject(Request $user)
    {
        $thisuser = \App\User::find($user->input('id'));
        if($user->input('id')) {
            $thisuser->rejected = $user->input('rejected');
        }
        if($thisuser) {
            $thisuser->save();
            activity()->log(\Auth::user()->name.' rejected user '.$thisuser->name);
            \Mail::to($thisuser)->send(new AgreementRejected($thisuser)); 
        }
    }
    
    public function showprint(Request $user)
    {
        $thisuser = \App\User::find($user->input('id'));
        activity()->log(\Auth::user()->name.' viewing agreement for '.$thisuser->name);
        if (\Auth::user()->admin == 1) {
            return view('print',
            [ 'name' => $thisuser->name, 
                'vatnumber' => $thisuser->vatnumber,
                'startdate' => $thisuser->newstartdate,
                'expirydate' => $thisuser->newexpirydate,
                'legalname' => $thisuser->legalname
            ]);
        } else {
            return false;
        }
    }
    
    public function store(Request $request)
    {
        activity()->log(\Auth::user()->name.' validating upload '.request()->file('doc_name'));
        $this->validate($request, [
            'doc_name' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        activity()->log(\Auth::user()->name.' validation successful');
        $thisuser = \App\User::find(\Auth::user()->id);
        $thisuser->vatnumber = $request->input('vatnumber0');
        $thisuser->newstartdate = $request->input('newstartdate');
        $thisuser->newexpirydate = $request->input('newexpirydate');
        $thisuser->uploaded = Carbon::now()->toDateTimeString();
        $file = request()->file('doc_name')->store('public/userdocs');
        $thisuser->doc_name = $file;
        $thisuser->save();
        activity()->log(\Auth::user()->name.' renewed their agreement as '.$thisuser->name);
        \Mail::to($thisuser)->send(new SubmissionThankYou($thisuser)); 
        return view('thankyou',
            [ 'confirm_agree' => 1, 
                'vatnumber' => $thisuser->vatnumber,
                'startdate' => $thisuser->newstartdate,
                'expirydate' => $thisuser->newexpirydate,
                'message' => "Thank you for submitting your documents. We will now proceed with the verification process, and a copy of this agreement will be e-mailed to you.",
                'uploaded' => true
            ]);
    }
}