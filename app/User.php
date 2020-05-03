<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\User
 *
 * @property int $id
 * @property string $username
 * @property string $username_canonical
 * @property string $email
 * @property string $email_canonical
 * @property boolean $enabled
 * @property string $salt
 * @property string $password
 * @property string $last_login
 * @property string $confirmation_token
 * @property string $password_requested_at
 * @property array $roles
 * @property string $created_at
 * @property boolean $enable_multimedia
 * @property Bookmark[] $bookmarks
 * @property Folder[] $folders
 * @property Tag[] $tags
 * @property UserConnection[] $userConnections
 * @property-read int|null $bookmarks_count
 * @property-read int|null $folders_count
 * @property-read int|null $tags_count
 * @property-read int|null $user_connections_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereConfirmationToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmailCanonical($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEnableMultimedia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereLastLogin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePasswordRequestedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRoles($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereSalt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUsernameCanonical($value)
 * @mixin Eloquent
 */
class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fos_user';

    /**
     * @var array
     */
    protected $fillable = ['username', 'username_canonical', 'email', 'email_canonical', 'enabled', 'salt', 'password', 'last_login', 'confirmation_token', 'password_requested_at', 'roles', 'created_at', 'enable_multimedia'];

    protected $casts = [
        'enabled' => 'boolean',
        'enable_multimedia' => 'boolean'
    ];

    public $timestamps = false;

    public function getRolesAttribute()
    {
        return !empty($this->attributes['roles']) ? unserialize($this->attributes['roles']) : null;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bookmarks()
    {
        return $this->hasMany('App\Bookmark', 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function folders()
    {
        return $this->hasMany('App\Folder', 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tags()
    {
        return $this->hasMany('App\Tag', 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userConnections()
    {
        return $this->hasMany('App\UserConnection', 'user_id');
    }
}
