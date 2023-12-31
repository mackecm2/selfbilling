<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordExpiredRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
 
class ExpiredPasswordController extends Controller
{
 
    public function postExpired(PasswordExpiredRequest $request)
    {
        // Checking current password
        if (!Hash::check($request->current_password, $request->user()->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Current password is not correct']);
        }
 
        $request->user()->update([
            'password' => bcrypt($request->password),
            'password_changed_at' => Carbon::now()->toDateTimeString()
        ]);
       # return view('home')->with(['status' => 'Password changed successfully']);
        return redirect()->action('HomeController@index');
    }
    
    public function expired()
    {
        return view('auth.passwords.expired');
    }
    
}

