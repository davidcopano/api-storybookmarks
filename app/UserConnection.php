<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\UserConnection
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $ip
 * @property string $operating_system
 * @property string $browser
 * @property string $device
 * @property string $user_agent
 * @property string|null $date
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserConnection newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserConnection newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserConnection query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserConnection whereBrowser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserConnection whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserConnection whereDevice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserConnection whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserConnection whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserConnection whereOperatingSystem($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserConnection whereUserAgent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserConnection whereUserId($value)
 * @mixin \Eloquent
 */
class UserConnection extends Model
{
    protected $table = 'user_connection';
}
