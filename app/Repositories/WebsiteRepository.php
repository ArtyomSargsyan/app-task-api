<?php

namespace App\Repositories;


use App\Models\Report;
use App\Models\Website;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;


class WebsiteRepository  implements  WebsiteRepositoryInterface
{
    /**
     * @var Website
     */
    protected Website $comment;

    public function __construct(Website $website)
    {
        $this->website = $website;
    }

    /**
     * @return Collection|Builder[]
     */
    public function getAll(): array|Collection
    {
        return Website::with('reports')->get();
    }

    /**
     * @param int $websiteId
     * @return mixed
     */
    public function getWebsiteDataById(int $websiteId)
    {
        return Website::findOrFail($websiteId);
    }

    /**
     * @param int $websiteId
     * @return mixed
     */
    public function getReportsDataById(int $websiteId)
    {

        return Report::select(
            'date',
            DB::raw('SUM(revenue) as total_revenue'),
            DB::raw('SUM(impressions) as total_impressions'),
            DB::raw('SUM(clicks) as total_clicks')
        )
            ->where('website_id', $websiteId)
            ->groupBy('date')
            ->get();
    }

    /**
     * @param $url
     * @return mixed
     */
    public function store($url)
    {
        $website = new $this->website;

        $website->url = $url;
        $website->save();

        return $website;

    }

    /**
     * @param int $id
     * @return mixed
     */
    public function show( int $id): mixed
    {
        return $this->website->find($id);
    }


    /**
     * @param string $url
     * @param int $id
     * @return mixed
     * @throws \Exception
     */
    public function update(string $url, int $id)
    {
        $website = $this->website->find($id);

        if ($website) {
            $website->update(['url' => $url]);
        } else {
            throw new \Exception("Website not found.");
        }

        return $website;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function delete(int $id)
    {
        $website = $this->website->find($id);

        if ($website) {
            $website->delete();
        }
        return $website;
    }


}
