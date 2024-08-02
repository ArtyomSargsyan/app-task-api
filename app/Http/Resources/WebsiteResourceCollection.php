<?php

// app/Http/Resources/ReportCollection.php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class WebsiteResourceCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection,
            'totals' => $this->additional['totals'] ?? null,
        ];
    }
}
