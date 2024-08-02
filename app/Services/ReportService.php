<?php
namespace App\Services;

use App\Repositories\ReportRepository;

class ReportService
{
    /**
     * @var ReportRepository
     */
    protected ReportRepository $reportRepository;

    /**
     * @param ReportRepository $reportRepository
     */
    public function __construct(ReportRepository $reportRepository)
    {
        $this->reportRepository = $reportRepository;
    }

    /**
     * @return array
     */
    public function getFormattedReportByDate(): array
    {
        $reports = $this->reportRepository->getAggregatedReportByDate();
        $totalReport = $this->reportRepository->getTotalReport();

        $data = [];

        foreach ($reports as $report) {
            $data[$report->date] = [
                'revenue' => $report->total_revenue,
                'impressions' => $report->total_impressions,
                'cpm' => $report->cpm,
            ];
        }

        $data['total'] = [
            'sum' => $totalReport->total_revenue,
            'impressions' => $totalReport->total_impressions,
            'cpm' => $totalReport->cpm,
        ];

        return $data;
    }
}
