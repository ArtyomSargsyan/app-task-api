<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    protected $fillable = [
        'website_id',
        'revenue',
        'impressions',
        'clicks',
        'date',
    ];

    public function website()
    {
        return $this->belongsTo(Website::class);
    }
}
