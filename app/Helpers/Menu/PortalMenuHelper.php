<?php

namespace App\Helpers\Menu;

class PortalMenuHelper
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
                'route' => 'home',
                'icon' => 'heroicon-o-user',
                'permission' => null,
            ],
            [
                'label' => 'Courthouse',
                'route' => 'home',
                'icon' => 'heroicon-o-building-library',
                'permission' => null,
            ],
            [
                'label' => 'CAD/MDT',
                'route' => 'home',
                'icon' => 'heroicon-o-device-tablet',
                'permission' => null,
            ],
            [
                'label' => 'Workbench',
                'route' => 'home',
                'icon' => 'heroicon-o-computer-desktop',
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
