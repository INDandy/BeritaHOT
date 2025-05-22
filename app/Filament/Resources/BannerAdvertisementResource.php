<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BannerAdvertisementResource\Pages;
use App\Filament\Resources\BannerAdvertisementResource\RelationManagers;
use App\Models\BannerAdvertisement;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BannerAdvertisementResource extends Resource
{
    protected static ?string $model = BannerAdvertisement::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\TextInput::make('link')
                    ->url()
                    ->required()
                    ->maxLength(255),

                    Forms\Components\FileUpload::make('thumbnail')
                    ->image()
                    ->required(),

                    Forms\Components\Select::make('is_active')
                    ->options([
                        'draft' => 'gray',
                        'reviewing' => 'warning',
                        'active' => 'Active',
                        'not_active' => 'Not Active',
                    ])
                    ->required(),

                    Forms\Components\Select::make('type')
                    ->options([
                        
                        'banner' => 'Banner',
                        'square' => 'Square',
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('link')
                    ->searchable()
                    ->sortable()
                    ->limit(50),
                    Tables\Columns\TextColumn::make('is_active')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'draft' => 'gray',
                        'reviewing' => 'warning',
                        'active' => 'success',
                        'not_active' => 'danger',
                    }),
                    Tables\Columns\ImageColumn::make('thumbnail')
                    ->label('Thumbnail')
                    ->url(fn (BannerAdvertisement $record): string => $record->thumbnail)
                    ->openUrlInNewTab()
                    ->limit(50),
                    // Tables\Columns\TextColumn::make('position')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListBannerAdvertisements::route('/'),
            'create' => Pages\CreateBannerAdvertisement::route('/create'),
            'edit' => Pages\EditBannerAdvertisement::route('/{record}/edit'),
        ];
    }
}
