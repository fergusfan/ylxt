<?php

namespace App;

use App\Notifications\GotVote;
use App\Model\Doctor;
use EloquentFilter\Filterable;
use Jcc\LaravelVote\Vote;
use App\Traits\FollowTrait;
use App\Scopes\StatusScope;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, SoftDeletes, FollowTrait, Vote, HasRoles, Filterable;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'is_admin',
        'avatar',
        'password',
        'confirm_code',
        'nickname',
        'real_name',
        'weibo_name',
        'weibo_link',
        'email_notify_enabled',
        'github_id',
        'github_name',
        'github_url',
        'website',
        'description',
        'status',
        'user_type',
        'phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'confirm_code',
        'updated_at',
        'deleted_at'
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(new StatusScope());
    }

    //用户模型关联医生模型
    public function doctor()
    {
        return $this->hasOne(Doctor::class);
    }
    /**
     * Get the discussions for the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    //前台免费咨询和健康论坛问题显示
    public function discussions()
    {
        return $this->hasMany(Discussion::class)->orderBy('created_at', 'desc');
    }

    /**
     * Get the comments for the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class)->orderBy('created_at', 'desc');
    }

    /**
     * Determine whether user is a super administrator.
     *
     * @return int
     */
    //判断用户类型是否为管理员
    public function isSuperAdmin()
    {
        return ($this->id == config('blog.super_admin')) ? 1 : 0;
    }

    /**
     * Get the avatar and return the default avatar if the avatar is null.
     *
     * @param string $value
     * @return string
     */
    public function getAvatarAttribute($value)
    {
        return isset($value) ? $value : config('blog.default_avatar');
    }

    /**
     * Route notifications for the mail channel.
     *
     * @return string
     */
    public function routeNotificationForMail()
    {
        if (auth()->id() != $this->id && $this->email_notify_enabled == 'yes' && config('blog.mail_notification')) {
            return $this->email;
        }
    }

    /**
     * Up vote or down vote item.
     *
     * @param  \App\User $user
     * @param  \Illuminate\Database\Eloquent\Model $target
     * @param  string $type
     *
     * @return boolean
     */
    public static function upOrDownVote($user, $target, $type = 'up')
    {
        $hasVoted = $user->{'has' . ucfirst($type) . 'Voted'}($target);

        if ($hasVoted) {
            $user->cancelVote($target);
            return false;
        }

        if ($type == 'up') {
            $target->user->notify(new GotVote($type . '_vote', $user, $target));
        }

        $user->{$type . 'Vote'}($target);

        return true;
    }
}
