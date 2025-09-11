<?php

namespace App\Filament\Admin\Clusters\Settings\Resources\Roles;

use App\Filament\Admin\Clusters\Settings\Resources\Roles\Pages\ViewRoleActivities;
use BackedEnum;
use BezhanSalleh\FilamentShield\Resources\RoleResource as ResourcesRoleResource;
use BezhanSalleh\FilamentShield\Resources\RoleResource\Pages\CreateRole;
use BezhanSalleh\FilamentShield\Resources\RoleResource\Pages\EditRole;
use BezhanSalleh\FilamentShield\Resources\RoleResource\Pages\ListRoles;
use BezhanSalleh\FilamentShield\Resources\RoleResource\Pages\ViewRole;
use Filament\Support\Icons\Heroicon;

class RoleResource extends ResourcesRoleResource
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function getNavigationGroup(): ?string
    {
        return trans("navigation.group.setting");
    }

    public static function getNavigationLabel(): string
    {
        return trans("navigation.item.role");
    }

    public static function getPages(): array
    {
        return [
            'index' => ListRoles::route('/'),
            'create' => CreateRole::route('/create'),
            'view' => ViewRole::route('/{record}'),
            'edit' => EditRole::route('/{record}/edit'),
            'activities' => ViewRoleActivities::route('/{record}/activities')
        ];
    }
}
