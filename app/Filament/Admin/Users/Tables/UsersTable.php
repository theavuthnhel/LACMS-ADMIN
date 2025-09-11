<?php

namespace App\Filament\Admin\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Columns\TextColumn::make("id")
                    ->label(trans("user.id"))
                    ->sortable(),

                Columns\TextColumn::make("id_card_no")
                    ->label(trans("user.biz_id"))
                    ->sortable(),

                Columns\TextColumn::make("name")
                    ->label(trans("user.khmer_name"))
                    ->sortable(),

                Columns\TextColumn::make("email")
                    ->label(trans("user.khmer_name"))
                    ->sortable(),
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
