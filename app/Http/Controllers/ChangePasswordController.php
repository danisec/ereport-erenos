<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function index()
    {
        return view('pages.change-password.index',[
            'title' => 'Change Password'
        ]);
    }

    public function update(Request $request)
    {
        $credentials = $request->validate([
            'old_password' => 'required|min:8|max:255',
            'new_password' => 'required|min:8|max:255',
            'confirm_password' => 'required|min:8|max:255',
        ]);

        if (Hash::check($credentials['old_password'], auth()->user()->password)) {
            if ($credentials['new_password'] === $credentials['confirm_password']) {
                auth()->user()->update([
                    'password' => Hash::make($credentials['new_password'])
                ]);

                $notif = notify()->success('Change password success');
                return redirect()->back()->with('notif', $notif);
            } else {
                $notif = notify()->error( 'New password and confirm password does not match', 'Change password failed');
                return redirect()->back()->with('notif', $notif);
            }
        } else {
            $notif = notify()->error('Old password does not match', 'Change password failed');
            return redirect()->back()->with('notif', $notif);
        }
    }
}
