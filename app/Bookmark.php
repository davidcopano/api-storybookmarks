<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Bookmark
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $tag_id
 * @property string|null $folder_id
 * @property string $title
 * @property string $url
 * @property string $color
 * @property string|null $note
 * @property \Illuminate\Support\Carbon $created_at
 * @property int|null $public
 * @property string|null $expiration_date Expiration date if public bookmark
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
    protected $table = 'bookmark';
}
