<?php

namespace App\Filament\Admin\Resources\Permissions\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns;

class PermissionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Columns\TextColumn::make("name")
                    ->label("Name"),

                Columns\TextColumn::make("module")
                    ->label("Module"),

                Columns\TextColumn::make("created_at")
                    ->label("Created At")
                    ->date(),

                Columns\TextColumn::make("updated_at")
                    ->label("Updated At")
                    ->date(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
