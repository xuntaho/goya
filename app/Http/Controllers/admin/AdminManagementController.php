<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\AdminModel;
use Illuminate\Http\Request;

class AdminManagementController extends Controller
{
    private $admin;

    public function __construct()
    {
        $this->admin = new AdminModel();
    }

        public function index()
    {
        if (!session()->has('admin')) {
            return redirect()->route('admin.login');
        }

        $title = 'Quản lý Admin';

        $username = session('admin');

        $admin = $this->admin->getAdminByUsername($username);

        if (!$admin) {
            session()->forget('admin');
            return redirect()->route('admin.login');
        }

        return view('admin.profile-admin', compact('title', 'admin'));
    }

   
    public function updateAdmin(Request $request)
    {
        if (!session()->has('admin')) {
            return response()->json([
                'error' => true,
                'message' => 'Phiên đăng nhập hết hạn'
            ]);
        }

        $usernameSession = session('admin');

        $admin = $this->admin->getAdminByUsername($usernameSession);

        if (!$admin) {
            return response()->json([
                'error' => true,
                'message' => 'Admin không tồn tại'
            ]);
        }

        $password = $request->password;

        if (!empty($password)) {
            $password = md5($password);
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
        session(['admin' => $request->username]);

        return response()->json([
            'success' => true
        ]);
    } 
    public function updateAvatar(Request $req)
    {
        if (!session()->has('admin')) {
            return response()->json(['error' => true, 'message' => 'Hết hạn']);
        }

        if ($req->hasFile('avatarAdmin')) {
            $avatar = $req->file('avatarAdmin');
            $username = session('admin');

            // 1. Tạo tên file duy nhất
            $filename = time() . '_' . $avatar->getClientOriginalName();

            // 2. Di chuyển vào thư mục public
            $avatar->move(public_path('admin/assets/images/user-profile'), $filename);

            // 3. Cập nhật vào DB
            $this->admin->updateAdminByUsername($username, [
                'hinh' => $filename
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Cập nhật ảnh thành công!',
                'new_url' => asset('admin/assets/images/user-profile/' . $filename) // Trả về URL mới
            ]);
        }

        return response()->json(['error' => true, 'message' => 'Không tìm thấy file']);
    }
}