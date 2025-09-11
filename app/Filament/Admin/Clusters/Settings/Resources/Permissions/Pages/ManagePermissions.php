<?php

namespace App\Filament\Admin\Clusters\Settings\Resources\Permissions\Pages;

use App\Filament\Admin\Clusters\Settings\Resources\Permissions\PermissionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManagePermissions extends ManageRecords
{
    protected static string $resource = PermissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
