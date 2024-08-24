<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderItemResource\Pages;
use App\Filament\Resources\OrderItemResource\RelationManagers;
use App\Models\OrderItem;
use App\Models\User;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use RalphJSmit\Filament\Activitylog\Forms\Components\Timeline;

class OrderItemResource extends Resource
{
    protected static ?string $model = OrderItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(10)
                    ->schema([
                        Grid::make()
                            ->columnSpan(7)
                            ->columns(1)
                            ->schema([
                                Section::make()
                                    ->columns(1)
                                    ->schema([
                                        TextInput::make('title')
                                            ->disabled(),
                                        SpatieMediaLibraryFileUpload::make('portraits')
                                            ->collection('portraits')
                                            ->disk('portraitFiles')
                                            ->customProperties(['added_manually' => true])
                                            ->downloadable()
                                            ->multiple(),
                                    ]),
                            ]),
                        Grid::make()
                            ->columnSpan(3)
                            ->columns(1)
                            ->schema([
                                Section::make()
                                    ->columnSpan(1)
                                    ->columns(1)
                                    ->schema([
                                        TextInput::make('status')
                                            ->disabled(),
                                        TextInput::make('created_at')
                                            ->disabled(),
                                    ]),
                                Section::make()
                                    ->columnSpan(1)
                                    ->columns(1)
                                    ->schema([
                                        SpatieMediaLibraryFileUpload::make('designs')
                                            ->collection('designs')
                                            ->disk('designFiles')
                                            ->downloadable()
                                            ->multiple(),
                                    ]),
                            ])
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID'),
                Tables\Columns\TextColumn::make('order_number')
                    ->label('Order number')
                    ->getStateUsing(fn ($record) => $record->order->order_number),
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('status')
                    ->badge(),
                SpatieMediaLibraryImageColumn::make('Image(s)')
                    ->collection('portraits'),
            ])
            ->filters([
                //
            ])
            ->actions([
                //
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //
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
            'index' => Pages\ListOrderItems::route('/'),
            'edit' => Pages\EditOrderItem::route('/{record}/edit'),
        ];
    }
}
