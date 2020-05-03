<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Bookmark
 *
 * @property string $id
 * @property int $user_id
 * @property int $tag_id
 * @property string $folder_id
 * @property string $title
 * @property string $url
 * @property string $color
 * @property string $note
 * @property string $created_at
 * @property boolean $public
 * @property string $expiration_date
 * @property Folder $folder
 * @property FosUser $fosUser
 * @property Tag $tag
 * @property-read \App\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bookmark newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bookmark newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bookmark query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bookmark whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bookmark whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bookmark whereExpirationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bookmark whereFolderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bookmark whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bookmark whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bookmark wherePublic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bookmark whereTagId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bookmark whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bookmark whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bookmark whereUserId($value)
 * @mixin \Eloquent
 */
class Bookmark extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bookmark';

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
    protected $fillable = ['user_id', 'tag_id', 'folder_id', 'title', 'url', 'color', 'note', 'created_at', 'public', 'expiration_date'];

    protected $casts = [
        'public' => 'boolean'
    ];

    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function folder()
    {
        return $this->belongsTo('App\Folder');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tag()
    {
        return $this->belongsTo('App\Tag');
    }
}
