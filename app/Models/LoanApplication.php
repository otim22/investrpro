<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LoanApplication extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        'ref_code',
        'credit_type',
        'credit_purpose',
        'amount_requested',
        'repayment_plan',
        'signature',
        'financial_year',
        'approved_by_one',
        'date_one_signed',
        'approved_by_two',
        'date_two_signed',
        'is_approved',
        'is_rejected',
        'comment',
        'member_id',
        'company_id',
    ];

    protected $casts = [
        "date_one_signed" => "datetime:d/m/Y",
        "date_two_signed" => "datetime:d/m/Y"
    ];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('ref_code')
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
}
