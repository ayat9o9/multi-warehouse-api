<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class ClearAppCache extends Command
{
    protected $signature = 'cache:clear-app';
    protected $description = 'Clear all application-specific cache keys';

    public function handle(): void
    {
        $keys = [
            'products:all',
            'countries:all',
            'inventory:global',
        ];

        foreach ($keys as $key) {
            Cache::forget($key);
            $this->info("Cleared cache: {$key}");
        }

        $this->info('✅ All application cache cleared.');
    }
}
