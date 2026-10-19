<?php

namespace App\Filament\Resources\Calls;

use App\Models\Call;
use App\Filament\Resources\Calls\Pages;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;

class CallResource extends Resource
{
    protected static ?string $model = Call::class;

    protected static ?string $navigationLabel = 'تاریخچه تماس‌ها';

    protected static ?string $modelLabel = 'تماس';

    protected static ?string $pluralModelLabel = 'تماس‌ها';

    public static function form(Schema $schema): Schema
    {
        return $schema;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('started_at', 'desc')
            ->columns([
                TextColumn::make('caller_number')
                    ->label('شماره تماس')
                    ->searchable(),

                TextColumn::make('extension')
                    ->label('داخلی')
                    ->searchable(),

                TextColumn::make('direction')
                    ->label('جهت تماس')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string =>
                        $state === 'INBOUND' ? 'ورودی' : 'خروجی'
                    ),

                TextColumn::make('status')
                    ->label('وضعیت')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string =>
                        $state === 'ANSWERED' ? 'پاسخ داده شده' : 'بدون پاسخ'
                    )
                    ->color(fn (string $state): string =>
                        $state === 'ANSWERED' ? 'success' : 'warning'
                    ),

                TextColumn::make('duration')
                    ->label('مدت')
                    ->suffix(' ثانیه'),

                TextColumn::make('started_at')
                    ->label('تاریخ تماس')
                    ->dateTime('Y/m/d H:i')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('وضعیت')
                    ->options([
                        'ANSWERED' => 'پاسخ داده شده',
                        'NO ANSWER' => 'بدون پاسخ',
                    ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCalls::route('/'),
        ];
    }
}
