<?php

namespace App\Filament\Admin\Clusters\Settings\Resources\Permissions;

use App\Filament\Admin\Clusters\Settings\Resources\Permissions\Pages\ManagePermissions;
use App\Filament\Admin\Clusters\Settings\Resources\Permissions\Pages\ViewPermissionActivities;
use App\Filament\Admin\Clusters\Settings\Resources\Roles\RoleResource;
use App\Filament\Admin\Clusters\Settings\SettingsCluster;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Spatie\Permission\Models\Permission;
use UnitEnum;

class PermissionResource extends Resource
{
    protected static ?string $model = Permission::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedTag;

    // protected static ?string $cluster = SettingsCluster::class;

    protected static ?int $navigationSort = 80;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getNavigationGroup(): string | UnitEnum | null
    {
        return trans("navigation.group.setting");
    }

    public static function getNavigationLabel(): string
    {
        return trans("navigation.item.permission");
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
                Action::make("view_activity")
                    ->label('Activities')
                    ->icon('heroicon-m-bolt')
                    ->color('purple')
                    ->url(fn ($record) => PermissionResource::getUrl('activities', ['record' => $record])),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManagePermissions::route('/'),
            'activities' => ViewPermissionActivities::route('/{record}/activities')
        ];
    }
}
