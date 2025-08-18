<?php

namespace App\Models;

use App\Services\DiscordService;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditingAuditable;
use OwenIt\Auditing\Contracts\Auditable;

class Department extends Model implements Auditable
{
    use AuditingAuditable, CascadeSoftDeletes, SoftDeletes;

    protected $cascadeDeletes = ['announcements']; // userDepartments,

    protected $auditExclude = [];

    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function announcements()
    {
        return $this->hasMany(Announcement::class);
    }

    public function getDiscordRoleNameAttribute()
    {
        if (get_setting('discord.useRoles')) {
            $serverRoles = [];
            $serverRoles = DiscordService::getServerRoles();

            foreach ($serverRoles as $role) {
                if ($role->id == $this->discord_role_id) {
                    return '@'.$role->name;
                }
            }
        }

        return '';
    }
}
