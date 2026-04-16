<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\LoginModel;
use Illuminate\Http\Request;

class LoginAdminController extends Controller
{
    private $login;

    public function __construct()
    {
        $this->login = new LoginModel();
    }

    public function index()
    {
        $title = 'Đăng nhập';
        return view('admin.login', compact('title'));
    }

    public function loginAdmin(Request $request)
    {
        $username = $request->username;
        $password = md5($request->password);

        $login = $this->login->login($username, $password);

        if ($login) {     
            $request->session()->put('admin', $login->username);

            return redirect()->route('admin.dashboard')
                ->with('success', 'Đăng nhập thành công!');
        }
        return redirect()->back()
            ->withInput()
            ->with('error', 'Thông tin đăng nhập không chính xác!');
    }
    public function logout(Request $request)
    {
        $request->session()->flush();

    $request->session()->regenerate();

    return redirect()->route('admin.login')
        ->with('success', 'Đăng xuất thành công');
    }
}