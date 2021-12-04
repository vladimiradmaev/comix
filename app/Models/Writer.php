<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

/**
 * Class Writer
 *
 * Сценарист
 *
 * @property string $name
 * @property string $last_name
 * @property ?string $second_name
 * @property string $slug
 * @property string $description
 * @property ?Carbon $date_birth
 * @property ?Carbon $date_death
 * @property ?int $file_id
 *
 * @property-read Collection|Issue[]
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Writer findSimilarSlugs(string $attribute, array $config, string $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|Writer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Writer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Writer query()
 * @method static \Illuminate\Database\Eloquent\Builder|Writer withUniqueSlugConstraints(\Illuminate\Database\Eloquent\Model $model, string $attribute, array $config, string $slug)
 * @mixin \Eloquent
 */
class Writer extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'name',
        'last_name',
        'second_name',
        'slug',
        'description',
        'date_birth',
        'date_death',
        'file_id'
    ];

    protected $dates = [
        'date_birth',
        'date_death'
    ];

    public function issues(): BelongsToMany
    {
        return $this->belongsToMany(Issue::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['last_name', 'name', 'second_name']
            ]
        ];
    }
}
