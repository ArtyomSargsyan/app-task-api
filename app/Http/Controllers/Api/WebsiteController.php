<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\WebsiteRequest;
use App\Http\Resources\ReportCollection;
use App\Http\Resources\WebsiteResource;
use App\Http\Resources\WebsiteResourceCollection;
use App\Models\Website;
use App\Services\WebsiteService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Routing\Controller;

class WebsiteController extends Controller
{

    protected WebsiteService $websiteService;

    /**
     * @param WebsiteService $websiteService
     */
    public function __construct(WebsiteService $websiteService)
    {
        $this->websiteService = $websiteService;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $data = $this->websiteService->getAllWebsitesAndReports();

        return response()->json($data);
    }

    /**
     * @param WebsiteRequest $request
     * @return WebsiteResource
     */
    public function store(WebsiteRequest $request): WebsiteResource
    {
       $website =  $this->websiteService->storeWebsite($request->url);

       return new WebsiteResource($website);
    }

    /**
     * @param Website $website
     * @return WebsiteResource
     */
    public function show(Website $website): WebsiteResource
    {
        $website = $this->websiteService->getById($website->id);

        return new WebsiteResource($website);
    }

    /**
     * @param Website $website
     * @param $id
     * @return JsonResponse
     */
    public function websiteReportById(Website $website, $id): JsonResponse
    {
        $data = $this->websiteService->getAllDataById($id);

        return response()->json([
            'website' => [
                'id' => $data['website']->id,
                'url' => $data['website']->url,
            ],
            'reports' => new ReportCollection($data['reports']['data']),
            'totals' => $data['reports']['totals'],
        ]);
    }

    /**
     * @param Website $website
     * @return WebsiteResource
     * @throws \Exception
     */
    public function update(Website $website): WebsiteResource
    {
        $updatedWebsite = $this->websiteService->updateWebsite($website->url, $website->id);

        return new WebsiteResource($updatedWebsite);

    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $this->websiteService->deleteWebsite($id);

        return response()->json(['message' => 'Website deleted successfully']);
    }
}
