<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    public function name()
    {
        return $this->last_name . " ". $this->first_name;
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id', 'status_id'];
    // protected $fillable = [
    //     'email', 'password', 
    //     'last_name', 'first_name', 
    //     'middle_name', 'matric_no',
    //     'staff_id','faculty','department','course_of_study' ,
    //     'contact_no', 'role_id', 'status_id',
    //     'gender',
    // ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
