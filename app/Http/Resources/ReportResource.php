<?php

namespace App\Http\Resources;namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReportResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'data' => $this->resource,
        ];
    }
}

