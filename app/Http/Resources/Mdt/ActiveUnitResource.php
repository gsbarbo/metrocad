<?php

namespace App\Http\Resources\Mdt;

use App\Enum\ActiveUnitStatus;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ActiveUnitResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'user_department_id' => $this->user_department_id,
            'officer_id' => $this->officer_id,
            'department_type_id' => $this->department_type_id,
            'is_panic' => $this->is_panic,
            'description' => $this->description,
            'location' => $this->location,
            'status' => [
                'value' => $this->status,
                'code' => $this->status,
                'label' => ActiveUnitStatus::from($this->status->value)->label(),
                'color-text' => ActiveUnitStatus::from($this->status->value)->color('text'),
            ],
            'alpr' => $this->alpr,
            'time' => $this->time,
            'subdivision' => $this->subdivision,
            'on_duty_at' => $this->on_duty_at,
            'off_duty_at' => $this->off_duty_at,
            'off_duty_type_id' => $this->off_duty_type_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,

            // Nested resources, assuming relationships are loaded
            'officer' => $this->whenLoaded('officer') ? [
                'id' => $this->officer->id,
                'first_name' => $this->officer->first_name,
                'last_name' => $this->officer->last_name,
                'badge_number' => $this->officer->badge_number,
                'rank' => $this->officer->rank,
                'name' => $this->officer->name,
                'formatted_name' => $this->officer->formatted_name,
                'picture' => $this->officer->picture ?? '',
                'created_at' => $this->officer->created_at,
                'updated_at' => $this->officer->updated_at,
                'deleted_at' => $this->officer->deleted_at,
            ] : null,

            'user_department' => $this->whenLoaded('user_department') ? [
                'id' => $this->user_department->id,
                'user_id' => $this->user_department->user_id,
                'department_id' => $this->user_department->department_id,
                'created_at' => $this->user_department->created_at,
                'updated_at' => $this->user_department->updated_at,
                'department' => [
                    'id' => $this->user_department->department->id,
                    'name' => $this->user_department->department->name,
                    'type' => $this->user_department->department->type,
                    'initials' => $this->user_department->department->initials,
                    'slug' => $this->user_department->department->slug,
                    'logo' => $this->user_department->department->logo,
                    'discord_role_id' => $this->user_department->department->discord_role_id,
                    'created_at' => $this->user_department->department->created_at,
                    'updated_at' => $this->user_department->department->updated_at,

                ],
            ] : null,

            'user' => $this->whenLoaded('user') ? [
                'id' => $this->user->id,
                'discord_name' => $this->user->discord_name,
                'discord_username' => $this->user->discord_username,
                'discord_discriminator' => $this->user->discord_discriminator,
                'avatar' => $this->user->avatar,
                'steam_id' => $this->user->steam_id,
                'steam_name' => $this->user->steam_name,
                'steam_hex' => $this->user->steam_hex,
                'status' => $this->user->status,
                'display_name' => $this->user->display_name,
                'last_login_at' => $this->user->last_login_at,
                'is_protected_user' => $this->user->is_protected_user,
                'is_super_user' => $this->user->is_super_user,
                'is_owner' => $this->user->is_owner,
                'became_member_at' => $this->user->became_member_at,
                'community_rank' => $this->user->community_rank,
                'email' => $this->user->email,
                'created_at' => $this->user->created_at,
                'updated_at' => $this->user->updated_at,
            ] : null,
        ];
    }
}
