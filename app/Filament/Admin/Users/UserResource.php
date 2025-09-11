<?php

namespace App\Filament\Admin\Resources\Users;

use App\Filament\Admin\AdministratorCluster;
use App\Filament\Admin\Resources\Users\Pages\CreateUser;
use App\Filament\Admin\Resources\Users\Pages\EditUser;
use App\Filament\Admin\Resources\Users\Pages\ListUsers;
use App\Filament\Admin\Resources\Users\Schemas\UserForm;
use App\Filament\Admin\Resources\Users\Tables\UsersTable;
use App\Models\User;
use BackedEnum;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUser;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?int $navigationSort = 100;

    protected static bool $shouldRegisterNavigation = true;

    // public static function getPermissionPrefixes(): array
    // {
    //     return [
    //         "language",
    //         "decline",
    //         "verify_worker",
    //         "stock",
    //         "View User",
    //         "import_decline",
    //         "import_admin",
    //         "verify",
    //         "void",
    //         "verify_company",
    //         "admin",
    //         "import_verify",
    //         "update_company",
    //         "download_export_excel",
    //     ];
    // }

    public static function getNavigationGroup(): string | UnitEnum | null
    {
        return trans("navigation.group.registered_users");
    }

    public static function getNavigationLabel(): string
    {
        return trans("navigation.item.users");
    }

    public static function form(Schema $schema): Schema
    {
        return UserForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UsersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListUsers::route('/'),
            'create' => CreateUser::route('/create'),
            'edit' => EditUser::route('/{record}/edit'),
        ];
    }
}
