<?php

namespace App\Models;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * Class IssueCollection
 *
 * Сборник выпусков (омнибуки, например)
 *
 * @property string $title
 * @property Carbon $date_published
 * @property ?int $file_id
 * @property string $description
 *
 * @property-read Collection|Issue[] $issues
 *
 */
class IssueCollection extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'title',
        'date_published',
        'file_id',
        'description',
    ];

    protected $dates = [
        'date_published'
    ];

    public function issues(): HasMany
    {
        return $this->hasMany(Issue::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
