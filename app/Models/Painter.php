<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * Class Painter
 *
 * Художник
 *
 * @property string $name
 * @property string $last_name
 * @property ?string $second_name
 * @property string $slug
 * @property string $description
 * @property ?Carbon $date_birth
 * @property ?Carbon $date_death
 * @property ?int $file_id
 * @method static \Illuminate\Database\Eloquent\Builder|Painter findSimilarSlugs(string $attribute, array $config, string $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|Painter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Painter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Painter query()
 * @method static \Illuminate\Database\Eloquent\Builder|Painter withUniqueSlugConstraints(\Illuminate\Database\Eloquent\Model $model, string $attribute, array $config, string $slug)
 * @mixin \Eloquent
 */
class Painter extends Model
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

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['last_name', 'name', 'second_name']
            ]
        ];
    }
}
