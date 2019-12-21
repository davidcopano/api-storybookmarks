<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Folder
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $name
 * @property string|null $color
 * @property \Illuminate\Support\Carbon $created_at
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
    protected $table = 'folder';
}
