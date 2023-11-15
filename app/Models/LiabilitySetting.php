<?php

namespace App\Models;

use Illuminate\Support\Str;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LiabilitySetting extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        'liability_type',
        'description',
        'company_id',
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('liability_type')
            ->saveSlugsTo('slug')
            ->slugsShouldBeNoLongerThan(50);
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
        return Str::limit($value, 30);
    }
}
