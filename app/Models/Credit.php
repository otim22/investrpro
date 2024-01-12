<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Credit extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        'amount_taken',
        'amount_paid',
        'date_paid',
        'comment',
        'is_active',
        'member_id',
        'company_id',
        'loan_application_id',
    ];

    protected $casts = [
        "date_paid" => "datetime:d/m/Y",
    ];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['credit_taken', 'member_id'])
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
        return Str::limit($value, 30);
    }

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }
    
    public function loanApplication(): BelongsTo
    {
        return $this->belongsTo(LoanAdvance::class);
    }
}
