<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Models\clients\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;


class LoginController extends Controller
{
    private $login;
    


    public function __construct()
    {
        $this->login = new Login();
       
    }

    // Trang login
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

        // kiểm tra tồn tại
        if ($this->login->checkUser($username, $email)) {
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
                'isActive' => 0
            ]);

            $this->sendEmail($email, $token);

            return response()->json([
                'success' => true,
                'message' => 'Đăng ký thành công! Kiểm tra email để kích hoạt tài khoản'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi server: ' . $e->getMessage()
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

            return redirect('/login')->with('message', 'Tài khoản đã kích hoạt');
        } else {
            return redirect('/login')->with('error', 'Token không hợp lệ!');
        }
    }

    public function login(Request $request)
    {
        $username = $request->username;
        $password = $request->password;

        $user = $this->login->login($username);

        if ($user && Hash::check($password, $user->password)) {

            if ($user->isActive == 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tài khoản chưa kích hoạt!'
                ]);
            }

        
            $request->session()->put('login_user_id', $user->userID);

            // giữ nguyên của bạn
            $request->session()->put('username', $username);
            $request->session()->put('hinh', $user->hinh);

            return response()->json([
                'success' => true,
                'message' => 'Đăng nhập thành công!'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Tài khoản hoặc mật khẩu không đúng!'
        ]);
    }
    public function logout (Request $request){
        $request->session()->forget('username');
        $request->session()->forget('hinh');
        $request->session()->forget('login_user_id');
        return redirect()->route('home');

    }
}