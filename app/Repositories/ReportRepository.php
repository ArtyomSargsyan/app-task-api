<?php

namespace App\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ReportRepository
{
    /**
     * @return Collection
     */
    public function getAggregatedReportByDate(): Collection
    {
        return DB::table('reports')
            ->select('date',
                DB::raw('SUM(revenue) as total_revenue'),
                DB::raw('SUM(impressions) as total_impressions'),
                DB::raw('SUM(clicks) as total_clicks'),
                DB::raw('SUM(revenue) * 1000 / NULLIF(SUM(impressions), 0) as cpm')
            )
            ->groupBy('date')
            ->get();
    }


    public function getTotalReport()
    {
        return DB::table('reports')
            ->select(DB::raw('SUM(revenue) as total_revenue'),
                DB::raw('SUM(impressions) as total_impressions'),
                DB::raw('SUM(clicks) as total_clicks'),
                DB::raw('SUM(revenue) * 1000 / NULLIF(SUM(impressions), 0) as cpm')
            )
            ->first();
    }
}

