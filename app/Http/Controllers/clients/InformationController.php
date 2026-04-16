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

    public function index(){
    $title = 'Thông tin cá nhân';
    $username = session()->get('username');
    $userID = $this->user->getUserId($username);
    $user = $this->user->getUser($userID);
    //dd($user);
    return view('clients.infor', compact('title', 'user'));
    }
    public function update (Request $request) {
        $username = session()->get('username');
        $userID = $this->user->getUserId($username);
        $fullname= $request->fullname;
        $diachi= $request->diachi;
        $email= $request->email;
        $sdt= $request->sdt;
        $dataUpdate = [
            'fullname' => $fullname,
            'diachi' => $diachi,
            'email' => $email,
            'sdt' => $sdt,
        ];
        $update = $this->user->updateUser($userID, $dataUpdate);
        //dd($update);
        if (!$update) {
            return response()->json(['error' => true, 'message' => 'Bạn chưa thay đổi thông tin nào, vui lòng kiểm tra lại!']);
        }
        return response()->json(['success' => true, 'message' => 'Cập nhật thông tin thành công!']);
    
    }
    public function updatePassword(Request $request) {
    $username = session()->get('username');
    $userID = $this->user->getUserId($username);
    $user = $this->user->getUser($userID);

    // Kiểm tra mật khẩu cũ
    if (!Hash::check($request->old_password, $user->password)) {
        return response()->json(['success' => false, 'message' => 'Mật khẩu hiện tại không chính xác!']);
    }

    // Cập nhật mật khẩu mới (đã mã hóa)
    $this->user->updateUser($userID, [
        'password' => Hash::make($request->new_password)
    ]);

    return response()->json(['success' => true, 'message' => 'Đổi mật khẩu thành công!']);
    }


    public function updateAvatar(Request $request) {
        if ($request->hasFile('avatar')) {
            $username = session()->get('username');
            $userID = $this->user->getUserId($username);
            $user = $this->user->getUser($userID);
            if ($user->hinh && File::exists(public_path('clients/assets/images/users/' . $user->hinh))) {
                File::delete(public_path('clients/assets/images/users/' . $user->hinh));
            }
            $file = $request->file('avatar');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('clients/assets/images/users/'), $fileName);

            $this->user->updateUser($userID, ['hinh' => $fileName]);

            return response()->json([
                'success' => true,
                'message' => 'Cập nhật ảnh đại diện thành công!',
                'image_url' => asset('clients/assets/images/users/' . $fileName) 
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Lỗi: Không tìm thấy file ảnh!']);
    }
}