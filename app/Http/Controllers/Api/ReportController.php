<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Reports\ReportService;

class ReportController extends Controller
{
    public function __construct(
        protected ReportService $service
    ) {}

    public function lowStock()
    {
        $lowStock = $this->service->lowStock();

        return response()->json([
            'count' => $lowStock->count(),
            'low_stock_items' => $lowStock
        ]);
    }
}
