<?php

namespace App\Helpers\Menu;

class CivilianMenuHelper
{
    public static function links(): array
    {
        return [
            [
                'label' => 'Dashboard',
                'route' => 'portal.dashboard',
                'icon' => 'heroicon-o-home',
                'permission' => null,
            ],
            [
                'label' => 'Civilian',
                'route' => 'civilian.index',
                'icon' => 'heroicon-o-user',
                'permission' => null,
            ],

        ];
    }

    public static function bottomLinks(): array
    {
        return [
            [
                'label' => 'Admin',
                'route' => 'home',
                'icon' => 'heroicon-o-cog-6-tooth',
                'permission' => null,
            ],
            [
                'label' => 'Settings',
                'route' => 'home',
                'icon' => 'heroicon-o-cog-6-tooth',
                'permission' => null,
            ],
        ];
    }
}
