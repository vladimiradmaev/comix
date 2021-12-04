<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

/**
 * Class Event
 *
 * Событие (напр. DC Rebirth). Своеобразная замена категорий
 *
 * @property string $title
 * @property string $description
 * @property string $slug
 * @property ?int $logo
 * @property bool $active
 * @property Carbon $date_start
 * @property ?Carbon $date_end
 * @property int $publisher_id
 *
 * @property-read Collection|Character[] $characters
 * @property-read Publisher $publisher
 * @property-read Collection|Issue[] $issues
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Event findSimilarSlugs(string $attribute, array $config, string $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|Event newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Event newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Event query()
 * @method static \Illuminate\Database\Eloquent\Builder|Event withUniqueSlugConstraints(\Illuminate\Database\Eloquent\Model $model, string $attribute, array $config, string $slug)
 * @mixin \Eloquent
 */
class Event extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'title',
        'description',
        'slug',
        'logo',
        'active',
        'date_start',
        'date_end',
        'publisher_id'
    ];

    protected $dates = [
        'date_start',
        'date_end'
    ];

    public function characters(): BelongsToMany
    {
        return $this->belongsToMany(Character::class);
    }

    public function publisher(): BelongsTo
    {
        return $this->belongsTo(Publisher::class);
    }

    public function issues(): BelongsToMany
    {
        return $this->belongsToMany(Issue::class);
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
