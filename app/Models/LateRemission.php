<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LateRemission extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        'asset_type',
        'financial_year',
        'charge_paid_for',
        'charge_amount',
        'month_paid_for',
        'date_of_payment',
        'comment',
        'member_id',
        'company_id',
    ];

    protected $casts = [
        "date_of_payment" => "datetime:d/m/Y",
    ];
    
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['charge_paid_for', 'month_paid_for'])
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

    public function shortenSentence($value)
    {
        return Str::limit($value, 35);
    }

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }
}
