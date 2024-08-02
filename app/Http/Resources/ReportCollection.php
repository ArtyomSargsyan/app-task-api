<?php
// App\Http\Resources\WebsiteCollection.php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ReportCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function ($report) {
                return [
                    'date' => $report->date,
                    'revenue' => $report->revenue,
                    'impressions' => $report->impressions,
                    'cpm' => $report->cpm,
                ];
            }),
        ];
    }
}
