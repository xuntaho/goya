<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Models\clients\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class InformationController extends Controller
{
    private $user;

    public function __construct(){
        $this->user = new User();
    }

    // ================== VIEW ==================
    public function index(){
        $title = 'Thông tin cá nhân';

        $userID = session('userID');

        if (!$userID) {
            return redirect('/login');
        }

        $user = $this->user->getUser($userID);

        return view('clients.infor', compact('title', 'user'));
    }

    // ================== UPDATE INFO ==================
    public function update(Request $request) {

        $userID = session('userID');

        $dataUpdate = [
            'fullname' => $request->fullname,
            'diachi'   => $request->diachi,
            'email'    => $request->email,
            'sdt'      => $request->sdt,
        ];

        $update = $this->user->updateUser($userID, $dataUpdate);

        if (!$update) {
            return response()->json([
                'success' => false,
                'message' => 'Bạn chưa thay đổi thông tin!'
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Cập nhật thành công!'
        ]);
    }

    // ================== PASSWORD ==================
    public function updatePassword(Request $request) {

        $userID = session('userID');
        $user = $this->user->getUser($userID);

        if (!Hash::check($request->old_password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Mật khẩu hiện tại không đúng!'
            ]);
        }

        $this->user->updateUser($userID, [
            'password' => Hash::make($request->new_password)
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Đổi mật khẩu thành công!'
        ]);
    }

    // ================== AVATAR ==================
    public function updateAvatar(Request $request) {

        if ($request->hasFile('avatar')) {

            $userID = session('userID');
            $user = $this->user->getUser($userID);

            // xóa ảnh cũ
            if ($user->hinh && File::exists(public_path('clients/assets/images/users/' . $user->hinh))) {
                File::delete(public_path('clients/assets/images/users/' . $user->hinh));
            }

            // upload ảnh
            $file = $request->file('avatar');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('clients/assets/images/users/'), $fileName);

            // update DB
            $this->user->updateUser($userID, ['hinh' => $fileName]);

            return response()->json([
                'success' => true,
                'message' => 'Cập nhật ảnh thành công!',
                'image_url' => asset('clients/assets/images/users/' . $fileName)
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Không tìm thấy file!'
        ]);
    }
}