<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('price')->money('usd', true),
                TextColumn::make('expiry_date')->date(),
                ImageColumn::make('attachment')->label('Image')->disk('public'),
                ToggleColumn::make('status')->label('Availability')->onColor('success')->offColor('danger'),
            ])
            ->filters([
                Filter::make('status')->label('Available Products')
                    ->query(fn(Builder $query): Builder => $query->where('status', true)),

                Filter::make('price')
                    ->schema([
                        TextInput::make('price less than than')->numeric()->prefix('$')->placeholder('Enter amount'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['price'] ?? null,
                                fn(Builder $query, $money): Builder => $query->where('price', '<=', $money),
                            );
                    }),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->label('Are you sure?'),
                ])->label('Delete Selected'),
            ]);
    }
}
