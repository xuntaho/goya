<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Models\clients\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
class LoginController extends Controller
{
    private $user;
    public function index()
    {
        
        $title = 'Đăng nhập';
        return view('clients.login', compact('title'));
    }
    public function showRegister()
    {
        $title = 'Đăng ký';
        return view('clients.dangky', compact('title'));
    }
    public function dangky(Request $request)
    {
        $username = $request->useregister;
        $email = $request->email;
        $password = $request->password;

        // check tồn tại
        $exist = DB::table('users')
            ->where('username', $username)
            ->orWhere('email', $email)
            ->first();

        if ($exist) {
            return response()->json([
                'success' => false,
                'message' => 'Tên hoặc email đã tồn tại'
            ]);
        }

        try {
            $token = Str::random(60);

            DB::table('users')->insert([
                'username' => $username,
                'email' => $email,
                'password' => bcrypt($password),
                'token' => $token,
                'isActive' => 0,
                'role' => 'user'
            ]);

            $this->sendEmail($email, $token);

            return response()->json([
                'success' => true,
                'message' => 'Đăng ký thành công! Kiểm tra email để kích hoạt'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi server'
            ]);
        }
    }
    public function sendEmail($email, $token)
    {
        $link = route('activate.account', ['token' => $token]);

        Mail::send('clients.mail.mail_active', [
            'link' => $link
        ], function ($message) use ($email) {
            $message->to($email);
            $message->subject('Kích hoạt tài khoản');
        });
    }
    public function activateAccount($token)
    {
        $user = DB::table('users')->where('token', $token)->first();

        if ($user) {
            DB::table('users')
                ->where('token', $token)
                ->update([
                    'token' => null,
                    'isActive' => 1
                ]);

            return redirect('/login')->with('message', 'Đã kích hoạt tài khoản!');
        }

        return redirect('/login')->with('error', 'Token không hợp lệ!');
    }
    public function login(Request $request)
    {
        $username = trim($request->username);
        $password = trim($request->password);

        $this->user = new User();
        $user = $this->user->getUserByUsername($username);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Tài khoản không tồn tại!'
            ]);
        }

        if (!Hash::check($password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Tài khoản hoặc mật khẩu không đúng!'
            ]);
        }

        if ($user->isActive == 0) {
            return response()->json([
                'success' => false,
                'message' => 'Tài khoản chưa kích hoạt!'
            ]);
        }
        $request->session()->put('userID', $user->userID);
        $request->session()->put('username', $user->username); 
        $request->session()->put('role', $user->role);
        $request->session()->put('avatar', $user->hinh ?? 'unnamed.png');


        return response()->json([
            'success' => true,
            'redirect' => ($user->role == 'admin')
                ? route('admin.dashboard')
                : route('home')
        ]);
    }
    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/');
    }
}