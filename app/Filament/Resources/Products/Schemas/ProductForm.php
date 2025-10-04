<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')->required()->maxLength(255),
                Grid::make(2)->schema([
                    TextInput::make('price')->numeric()->required()->maxLength(255),

                    ToggleButtons::make('status')
                        ->label('Availability Status')
                        ->boolean()
                        ->grouped()
                        ->required(),
                ]),

                Grid::make(2)->schema([
                    ColorPicker::make('card_background_color_one')->required(),
                    ColorPicker::make('card_background_color_two')->required(),
                ]),

                DatePicker::make('expiry_date')->required()->afterOrEqual('tomorrow'),

                FileUpload::make('attachment')->disk('public')->directory('attachments')->maxSize(1024)->image(),
                Textarea::make('description')
                    ->autosize(),
            ]);
    }
}
