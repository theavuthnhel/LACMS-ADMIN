<?php

namespace App\Filament\Admin\Clusters\Settings\Resources\Permissions\Pages;

use App\Filament\Admin\Clusters\Settings\Resources\Permissions\PermissionResource;
use App\Models\User;
use Filament\Schemas\Schema;
use Illuminate\Support\HtmlString;
use TheavuthNhel\ActivityTimeline\Pages\ActivityTimelinePage;

class ViewPermissionActivities extends ActivityTimelinePage
{
    protected static string $resource = PermissionResource::class;
}
