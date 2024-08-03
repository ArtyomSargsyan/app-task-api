<?php

namespace App\Services;


use App\Repositories\WebsiteRepository;



class WebsiteService
{
    /**
     * @var WebsiteRepository
     */
    public WebsiteRepository $websiteRepository;

    /**
     * @param WebsiteRepository $websiteRepository
     */
    public function __construct(WebsiteRepository $websiteRepository)
    {
        $this->websiteRepository = $websiteRepository;
    }

    /**
     * @param $websiteId
     * @return array
     */
    public function getAllDataById($websiteId)
    {

        $websiteData = $this->websiteRepository->getWebsiteDataById($websiteId);
        $reports = $this->websiteRepository->getReportsDataById($websiteId);

        $totalRevenue = $reports->sum('total_revenue');
        $totalImpressions = $reports->sum('total_impressions');
        $totalClicks = $reports->sum('total_clicks');
        $cpm = $totalImpressions ? ($totalRevenue * 1000) / $totalImpressions : 0;

        return [
            'website' => $websiteData,
            'reports' => [
                'data' => $reports,
                'totals' => [
                    'total_revenue' => number_format($totalRevenue, 2),
                    'total_impressions' => $totalImpressions,
                    'total_clicks' => $totalClicks,
                    'cpm' => number_format($cpm, 2),
                ],
            ],
        ];
    }

    /**
     * @return array
     */
    public function getAllWebsitesAndReports(): array
    {
        $websites = $this->websiteRepository->getAll();

        $result = [];

        foreach ($websites as $website) {

            $reports = $website->reports;

            $totalRevenue = $reports->sum('revenue');
            $totalImpressions = $reports->sum('impressions');
            $totalClicks = $reports->sum('clicks');
            $cpm = $totalImpressions ? ($totalRevenue * 1000) / $totalImpressions : 0;

            $result[] = [
                'website' => [
                    'id' => $website->id,
                    'url' => $website->url,
                ],
                'reports' => [
                    'data' => $reports,
                    'totals' => [
                        'total_revenue' => number_format($totalRevenue, 2),
                        'total_impressions' => $totalImpressions,
                        'total_clicks' => $totalClicks,
                        'cpm' => number_format($cpm, 2),
                    ],
                ],
            ];
        }

        return $result;
    }


    /**
     * @param string $url
     * @return mixed
     */
    public function storeWebsite(string $url): mixed
    {
      return  $this->websiteRepository->store($url);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public  function getById(int $id): mixed
    {
        return $this->websiteRepository->show($id);
    }

    /**
     * @param string $url
     * @param int $id
     * @return mixed
     * @throws \Exception
     */
    public function updateWebsite(string $url ,int $id): mixed
    {

        return $this->websiteRepository->update($url, $id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteWebsite($id): mixed
    {
        return $this->websiteRepository->delete($id);
    }
}
