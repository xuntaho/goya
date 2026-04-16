<?php

namespace App\Models\clients;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class User extends Model
{
    protected $table = 'users';
    public function getUserId ($username){
        $user = DB::table($this->table)
        ->select('userID')
        ->where('username', $username)->first();
        return $user ? $user->userID : null;
    }
     public function getUser ($id){
        return DB::table($this->table)
        ->where('userID', $id)->first();
        
    }
    public function updateUser ($id, $data) {
        $update = DB::table($this->table)
            ->where('userID', $id)
            ->update($data);

        return $update;
    }
    
}
