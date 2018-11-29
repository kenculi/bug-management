<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Invite;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'full_name', 'email', 'password', 'type', 'nation', 'avatar', 'created_at', 'updated_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function getUserInfo($userId = 0)
    {
        $result = self::select()
            ->where("id", (int)$userId)
            ->first();
        return $result;
    }

    public static function getUserNotBeInvited($projectId = 0)
    {
        $builder = self::select(DB::raw("users.id, email"))
            ->whereNotIn('users.id',function($query) use ($projectId) {
               $query->select('user_receive_id')->from('invite')->where("proj_id", (int)$projectId);
            })
            ->whereNotIn('users.id',function($query) use ($projectId) {
               $query->select('user_send_id')->from('invite')->where("proj_id", (int)$projectId);
            });

        return $builder->get();
    }
}
