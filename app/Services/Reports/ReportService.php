<?php

namespace App\Services\Reports;

use App\Repositories\Reports\ReportRepositoryInterface;
use Illuminate\Support\Collection;

class ReportService
{
    public function __construct(
        protected ReportRepositoryInterface $repository
    ) {}

    public function lowStock(): Collection
    {
        return $this->repository->lowStock();
    }
}
