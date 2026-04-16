<?php

namespace App\Models\clients;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Login extends Model
{
    protected $table = 'users';

    
    public function dangky($data) {
        return DB::table($this->table)->insert($data);
    }

    // Hàm kiểm tra sự tồn tại của tài khoản hoặc email
    public function checkUser($username, $email) {
        
        $check = DB::table($this->table)
            ->where('username', $username)
            ->orWhere('email', $email)
            ->first(); 
            
        return $check;
    }

    //kiem tar nguoi dung ton tai theo token kich hoat
    public function getUserToken($token){
        return DB::table($this->table)->where('token', $token)->first();
    }
    public function activeUserAccount($token){
        return DB::table($this->table)->where('token', $token)
        ->update(['token'  => null, 'isActive' => 1]);
    }
   public function login($username) {
    return DB::table($this->table)
        ->where('username', $username)
        ->first();
}
}