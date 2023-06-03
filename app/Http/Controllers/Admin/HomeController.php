<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function home()
    {

        $adminUser = Auth::user();
        if ($adminUser) {
            $adminUserId = $adminUser->id;
        } else {
            $adminUserId = [];
        }
        $unreadNotifications = Notification::where('user_id', $adminUserId)
            ->unread()
            ->orderBy('created_at', 'desc')
            ->get();

        $readNotifications = Notification::where('user_id', $adminUserId)
            ->read()
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.index', [
            'unreadNotifications' => $unreadNotifications,
            'readNotifications' => $readNotifications,
        ]);
    }

    public function markAllNotificationsAsRead()
    {
        if (Auth::check()) {
            Auth::user()->unreadNotifications->markAsRead();

            return redirect()->back()->with('success', 'All notifications have been marked as read.');
        }

        return redirect()->back()->with('error', 'User authentication failed.');
    }


    public function markNotificationAsRead($notificationId)
    {
        $notification = Notification::findOrFail($notificationId);
        $notification->update(['is_read' => true]);

        // Redirect back or to the desired page
        return redirect()->back();
    }

    public function profile()
    {
        $admin = Admin::where('id', 1)->first();
        $adminUser = Auth::user();
        if ($adminUser) {
            $adminUserId = $adminUser->id;
        } else {
            $adminUserId = [];
        }
        $unreadNotifications = Notification::where('user_id', $adminUserId)
            ->unread()
            ->orderBy('created_at', 'desc')
            ->get();

        $readNotifications = Notification::where('user_id', $adminUserId)
            ->read()
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.profile', [
            'admin'=>$admin,
            'unreadNotifications' => $unreadNotifications,
            'readNotifications' => $readNotifications,
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            // $admin = Admin::where('id', $id)->first();
            $admin = Admin::findOrFail($id);
            $admin->update([
                // 'image'=>$image_file ?? $users->image,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);
            // dd($admin);
            return back()->with('Success', 'Updated Successfull');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return back()->with('Error', 'Something went Wrong');
        }
    }

    public function validatepassword(Request  $request)
    {
        $this->validate($request, [
            'current_password' => ['required', 'string'],
            'new_password' => ['required', 'string'],
        ]);
        # check for current password match
        $adminpassword = Admin::where('id', 1)->first();
        if (password_verify($request->current_password, $adminpassword->password)) {
            # if true
            if ($request->new_password == $request->Confirm_password) {
                # send otp to user email and the password in datebase
                session(['new_password' => $request->new_password]);
                $adminpassword->update([
                    'password' => Hash::make(session('new_password'))
                ]);
                // dd($adminpassword);
                return redirect(route('admin.profile-page'))->with('success', 'Password Change Successful');
            } else {
                return back()->with('error', 'Error! Password Mismatch');
            }
        } else {
            return back()->with('error',  'Error! The password does not match the current password?');
        }
    }
}
