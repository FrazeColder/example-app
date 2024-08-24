<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use App\Models\User;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\Column;
use Filament\Tables\Table;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationBadge(): ?string
    {
        $count = static::getModel()::whereIn('status', Order::ordersToBeDone())->get()->count();

        if ($count > 0) {
            return $count;
        }

        return null;
    }

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

                                    ]),
                                Section::make()
                                    ->columns(1)
                                    ->hidden(fn () => !User::isAdmin())
                                    ->schema([
                                        Timeline::make()
                                            ->label('History')
                                    ]),
                            ]),
                        Section::make()
                            ->columnSpan(3)
                            ->columns(1)
                            ->schema([
                                TextInput::make('status')
                                    ->disabled(),
                                TextInput::make('created_at')
                                    ->disabled(),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order_number')
                    ->sortable()
                    ->label('Order Number'),
                Tables\Columns\TextColumn::make('status')
                    ->badge(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Order placed')
                    ->sortable()
                    ->since()
                    ->getStateUsing(fn ($record) => in_array($record->status, Order::ordersToBeDone()) ? $record->created_at : null),
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
