<?php

namespace App\Filament\Widgets;

use App\Models\Call;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class CallStatsOverview extends BaseWidget
{
    protected ?string $pollingInterval = null;

    protected function getStats(): array
    {
        $total = Call::count();

        $answered = Call::where('status', 'ANSWERED')->count();

        $missed = Call::where('status', 'NO ANSWER')->count();

        $needsReview = Call::where('direction', 'INBOUND')
            ->where('status', 'NO ANSWER')
            ->count();

        return [
            Stat::make('کل تماس‌ها', $total)
                ->color('info'),

            Stat::make('پاسخ داده شده', $answered)
                ->color('success'),

            Stat::make('بدون پاسخ', $missed)
                ->color('warning'),

            Stat::make('ورودی بی‌پاسخ (نیازمند بررسی)', $needsReview)
                ->color('danger'),
        ];
    }
}
