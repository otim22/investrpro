<?php

namespace App\Models;

use Carbon\Carbon;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Investment extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        'investment_type',
        'date_of_investment',
        'duration',
        'interest_rate',
        'amount_invested',
        'date_of_maturity',
        'expected_tax',
        'expected_return_after_tax',
        'interest_recieved',
        'company_id',
    ];

    protected $casts = [
        "date_of_investment" => "datetime:d/m/Y",
        "date_of_maturity" => "datetime:d/m/Y",
    ];
    
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('investment_type')
            ->saveSlugsTo('slug')
            ->slugsShouldBeNoLongerThan(50);
    }

    public function formatDate($date) 
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->isoFormat('MMM Do YYYY');
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
