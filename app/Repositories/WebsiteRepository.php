<?php

namespace App\Repositories;


use App\Models\Report;
use App\Models\Website;
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
     * @return Collection|array
     */
    public function getAll(): Collection|array
    {
        return Website::with('reports')->get();
    }

    public function getWebsiteDataById(int $websiteId)
    {
        return Website::findOrFail($websiteId);
    }

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

    public function store($url)
    {
        $website = new $this->website;

        $website->url = $url;

        $website->save();
        return $website;

    }

    public function show($id)
    {
        return $this->website->find($id);
    }

    public function update($url, $id)
    {

        $website = $this->website->find($id);


        if ($website) {
            $website->update(['url' => $url]);
        } else {
            throw new \Exception("Website not found.");
        }

        return $website;
    }

    public function delete($id)
    {
        $website = $this->website->find($id);
        if ($website) {
            $website->delete();
        }
        return $website;
    }


}
