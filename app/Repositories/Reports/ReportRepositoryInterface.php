<?php

namespace App\Repositories\Reports;

use Illuminate\Support\Collection;

interface ReportRepositoryInterface
{
    public function lowStock(): Collection;
}
