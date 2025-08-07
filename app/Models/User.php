<?php

namespace App\Models;

use App\Enum\User\UserStatuses;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles, Notifiable;

    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public static function dec2hex($number)
    {
        $hexvalues = [
            '0', '1', '2', '3', '4', '5', '6', '7',
            '8', '9', 'A', 'B', 'C', 'D', 'E', 'F',
        ];
        $hexval = '';
        while ($number != '0') {
            $hexval = $hexvalues[bcmod($number, '16', 0)].$hexval;
            $number = bcdiv($number, '16', 0);
        }

        return $hexval;
    }

    public function getNameAttribute()
    {
        // if ($this->display_name) {
        //     return $this->display_name;
        // }

        return $this->getDiscordAttribute();
    }

    public function getDiscordAttribute()
    {
        if ($this->discord_discriminator == 0) {
            return $this->discord_name;
        }

        return $this->discord_name.'#'.$this->discord_discriminator;
    }

    public function getLastActivityAttribute()
    {
        $time = DB::table('sessions')->where('user_id', $this->id)->latest('last_activity')->first();

        if (! $time) {
            return 'No recent activity';
        }

        return $timestamp = Carbon::createFromTimestamp($time->last_activity,
            config('app.timezone'))->format('M d, Y H:i');
    }

    // public function getStatusNameAttribute()
    // {
    //     return UserStatuses::USER_STATUSES[$this->status];
    // }

    public function getHistoryAttribute()
    {
        return History::where('subject_type', 'user')->where('subject_id', $this->id)->latest()->get();
    }

    public function userDepartments()
    {
        return $this->hasMany(UserDepartment::class)->with('department');
    }

    public function active_unit()
    {
        return $this->hasOne(ActiveUnit::class);
    }

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'last_login_at' => 'datetime',
            'became_member_at' => 'datetime:Y-m-d',
            'password' => 'hashed',
            'status' => UserStatuses::class,
        ];
    }
}
