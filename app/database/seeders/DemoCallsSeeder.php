<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DemoCallsSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 20; $i++) {
            $answered = $i % 4 !== 0;

            DB::table('calls')->updateOrInsert(
                ['source_call_id' => 'demo-' . $i],
                [
                    'caller_number' => '0912000' . str_pad((string) $i, 4, '0', STR_PAD_LEFT),
                    'extension' => (string) (101 + ($i % 3)),
                    'direction' => $i % 5 === 0 ? 'OUTBOUND' : 'INBOUND',
                    'status' => $answered ? 'ANSWERED' : 'NO ANSWER',
                    'duration' => $answered ? $i * 13 : 0,
                    'started_at' => now()->subMinutes($i * 17),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
