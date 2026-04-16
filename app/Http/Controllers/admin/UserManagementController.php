<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\UserModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserManagementController extends Controller
{

    private $users;

    public function __construct()
    {
        $this->users = new UserModel();
    }
    public function index(Request $request)
    {
        $title = 'Quản lý người dùng';
        $query = DB::table('users');
        if ($request->keyword) {
            $query->where(function ($q) use ($request) {
                $q->where('fullname', 'like', '%' . $request->keyword . '%')
                ->orWhere('username', 'like', '%' . $request->keyword . '%')
                ->orWhere('sdt', 'like', '%' . $request->keyword . '%');
            });
        }

        $users = $query->get();
        foreach ($users as $user) {
            if (!$user->fullname) {
                $user->fullname = "Unnamed";
            }
            if (!$user->hinh) {
                $user->hinh = 'unnamed.png';
            }
            if ($user->isActive == 1)
                $user->isActive = 'Đã kích hoạt';
            else
                $user->isActive = 'Chưa kích hoạt';
        }
        return view('admin.users', compact('title', 'users'));
    }

    public function activeUser(Request $request)
    {
        $userId = $request->userId;

        $updateActive = $this->users->updateActive($userId);

        if ($updateActive) {
            return response()->json([
                'success' => true,
                'message' => 'Người dùng đã được kích hoạt thành công!'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi kích hoạt người dùng!'
            ], 500); // Trả về mã lỗi HTTP 500 nếu có lỗi
        }
    }

    public function changeStatus(Request $request)
    {
        $userId = $request->userId;
        $status = $request->status;
        $dataUpdate = [
            'status' => $status
        ];
        $changeStatus = $this->users->changeStatus($userId, $dataUpdate);
        $statusText = $this->statusUser($status);
        if ($changeStatus) {
            return response()->json([
                'success' => true,
                'status' => $statusText,
                'message' => "Trạng thái người dùng đã được cập nhật thành công!"
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => "Có lỗi xảy ra khi cập nhật trạng thái người dùng!"
            ], 500); 
        }
    }

    public function statusUser(Request $request)
    {
        $user = User::find($request->userId);
        if (!$user) {
            return response()->json(['message' => 'Không tìm thấy user']);
        }
        if ($request->status == 'b') {
            $user->trangthai = 'banned';
        } elseif ($request->status == 'd') {
            $user->trangthai = 'deleted';
        } else {
            $user->trangthai = ''; 
        }
        $user->save();
        return response()->json([
            'message' => 'Cập nhật trạng thái thành công!'
        ]);
    }

}