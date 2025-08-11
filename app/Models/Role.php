<?php

namespace App\Models;

use App\Services\DiscordService;
use OwenIt\Auditing\Auditable as AuditingAuditable;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole implements Auditable
{
    use AuditingAuditable;

    public function getDiscordRoleNameAttribute()
    {
        if (get_setting('feature_use_discord_roles')) {
            $discord_roles = [];
            $discord_roles = (new DiscordService)->get_server_roles();

            foreach ($discord_roles as $role) {
                if ($role->id == $this->discord_role_id) {
                    return '@'.$role->name;
                }
            }
        }

        return '';
    }
}
