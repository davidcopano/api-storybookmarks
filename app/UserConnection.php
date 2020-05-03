<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\UserConnection
 *
 * @property int $id
 * @property int $user_id
 * @property string $ip
 * @property string $operating_system
 * @property string $browser
 * @property string $device
 * @property string $user_agent
 * @property string $date
 * @property User $user
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
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_connection';

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'ip', 'operating_system', 'browser', 'device', 'user_agent', 'date'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
