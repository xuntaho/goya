<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminModel extends Model
{
    use HasFactory;
    protected $table = 'users';
    protected $primaryKey = 'userID';
    public $timestamps = false;

    // lấy admin
    public function getAdminByUsername($username)
    {
        return $this->where('username', $username)->first();
    }
    public function updateAdminByUsername($username, $data)
    {
        return $this->where('username', $username)->update($data);
    }
}