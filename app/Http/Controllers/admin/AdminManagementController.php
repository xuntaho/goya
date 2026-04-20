<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\AdminModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Thêm dòng này để dùng mã hóa

class AdminManagementController extends Controller
{
    private $admin;

    public function __construct()
    {
        $this->admin = new AdminModel();
    }

    public function index()
    {
    $title = 'Thông tin admin';
    if (!session()->has('userID') || session('role') != 'admin') {
        return redirect()->route('login');
    }

    $username = session('username');
    $admin = $this->admin->getAdminByUsername($username);

    $admin = $this->admin->getAdminByUsername($username);
    if (!$admin) {
        session()->forget('username');
        return redirect()->route('login');
        }
        return view('admin.profile-admin', compact('title', 'admin'));
    }
    public function updateAdmin(Request $request)
    {
        if (!session()->has('userID') || session('role') != 'admin') {
            return response()->json([
                'error' => true,
                'message' => 'Không có quyền'
            ]);
        }
        $usernameSession = session('username');
        $admin = $this->admin->getAdminByUsername($usernameSession);

        if (!$admin) {
            return response()->json([
                'error' => true,
                'message' => 'Admin không tồn tại'
            ]);
        }
        $password = $request->password;

        if (!empty($password)) {
            $password = bcrypt($password);
        } else {
            $password = $admin->password;
        }
        $dataUpdate = [
            'username' => $request->username,
            'password' => $password,
            'email' => $request->email,
            'diachi' => $request->diachi
        ];

        $this->admin->updateAdminByUsername($usernameSession, $dataUpdate);
        session(['username' => $request->username]);

        return response()->json([
            'success' => true
        ]);
    } 
    public function updateAvatar(Request $req)
    {
        if (!session()->has('userID') || session('role') != 'admin') {
        return response()->json([
            'error' => true,
            'message' => 'Không có quyền'
        ]);
    }

        if ($req->hasFile('avatarAdmin')) {
            $avatar = $req->file('avatarAdmin');
            $username = session('username');

            $filename = time() . '_' . $avatar->getClientOriginalName();
            $avatar->move(public_path('admin/assets/images/user-profile'), $filename);

            $this->admin->updateAdminByUsername($username, [
                'hinh' => $filename
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Cập nhật ảnh thành công!',
                'new_url' => asset('admin/assets/images/user-profile/' . $filename)
            ]);
        }
        return response()->json(['error' => true, 'message' => 'Không tìm thấy file']);
    }
}