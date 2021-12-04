<?php

namespace App\Models;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;

/**
 * Class Issue
 *
 * Выпуск комикса
 *
 * @property string $number
 * @property string $title
 * @property string $slug
 * @property Carbon $date_published
 * @property ?int $file_id
 * @property ?int $collection_id
 * @property int $publisher_id
 *
 * @property-read IssueCollection $issueCollection
 * @property-read Collection|Writer[] $writers
 * @property-read Collection|Painter[] $painters
 * @property-read Publisher $publisher
 * @property-read Collection|Character[] $characters
 * @property-read Collection|Event[] $events
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Issue findSimilarSlugs(string $attribute, array $config, string $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|Issue newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Issue newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Issue query()
 * @method static \Illuminate\Database\Eloquent\Builder|Issue withUniqueSlugConstraints(\Illuminate\Database\Eloquent\Model $model, string $attribute, array $config, string $slug)
 * @mixin \Eloquent
 */
class Issue extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'number',
        'title',
        'slug',
        'date_published',
        'file_id',
        'collection_id'
    ];

    protected $dates = ['date_published'];

    public function issueCollection(): BelongsTo
    {
        return $this->belongsTo(IssueCollection::class);
    }

    public function writers(): BelongsToMany
    {
        return $this->belongsToMany(Writer::class);
    }

    public function painters(): BelongsToMany
    {
        return $this->belongsToMany(Painter::class);
    }

    public function publisher(): BelongsTo
    {
        return $this->belongsTo(Publisher::class);
    }

    public function characters(): BelongsToMany
    {
        return $this->belongsToMany(Character::class);
    }

    public function events(): BelongsToMany
    {
        return $this->belongsToMany(Event::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['number', 'title']
            ]
        ];
    }
}
