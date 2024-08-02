<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\WebsiteRequest;
use App\Http\Resources\ReportResource;
use App\Services\ReportService;

use Illuminate\Routing\Controller;

class ReportController extends Controller
{

    protected ReportService $reportService;

    /**
     * @param ReportService $reportService
     */
    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    /**
     * @return ReportResource
     */
    public function index(): ReportResource
    {
        $data = $this->reportService->getFormattedReportByDate();

       return new ReportResource($data);
    }

}
