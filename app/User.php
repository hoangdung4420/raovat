<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username','email','phone','password','facebook','address','picture','role','active','created_at','updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getRememberToken()
     {
       return null; // not supported
     }

     public function setRememberToken($value)
     {
       // not supported
     }

     public function getRememberTokenName()
     {
       return null; // not supported
     }

     public function checkUsername($username,$id){
        $checkUsername = User::where('username',$username)->where('id','!=',$id)->get();
        if(count($checkUsername) > 0){
            return false;//đã tồn tại  trả về false
        }else{
            return true;
        }
     }
    public  function checkEmail($email,$id){
        $checkEmail = User::where('email',$email)->where('id','!=', $id)->get(); 
        if(count($checkEmail) > 0){
            return false;
        }else{
            return true;
        }
    }
    public function checkExistEmail($email){
        $checkEmail = User::where('email',$email)->get(); 
        if(count($checkEmail) > 0){
            return false;//đã tồn tại  trả về false
        }else{
            return true;
        }
    }

     function checkPhone($phone,$id){
        $checkPhone = User::where('phone',$phone)->where('id','!=', $id)->get(); 
        if(count($checkPhone) > 0){
            return false;
        }else{
            return true;
        }
    }
}
