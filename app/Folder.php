<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Folder
 *
 * @property string $id
 * @property int $user_id
 * @property string $name
 * @property string $color
 * @property string $created_at
 * @property FosUser $fosUser
 * @property Bookmark[] $bookmarks
 * @property-read int|null $bookmarks_count
 * @property-read \App\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Folder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Folder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Folder query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Folder whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Folder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Folder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Folder whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Folder whereUserId($value)
 * @mixin \Eloquent
 */
class Folder extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'folder';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'name', 'color', 'created_at'];

    public $timestamps = false;

    public static function boot()
    {
        parent::boot();
        // When a new record is about to create, we generate and assign a new GUID for it
        self::creating(function ($model) {
            $model->id = guid();
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bookmarks()
    {
        return $this->hasMany('App\Bookmark');
    }
}
