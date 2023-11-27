<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * App\Models\User
 *
 * @property int $id
 * @property int|null $default_project_id
 * @property string|null $unique_id
 * @property string|null $name
 * @property string|null $avatar
 * @property int|null $is_admin
 * @property string|null $language
 * @property int|null $is_free_for_all_projects
 * @property string|null $email
 * @property string|null $password
 * @property int|null $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDefaultProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsFreeForAllProjects($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUniqueId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Project> $visibleprojects
 * @property-read int|null $visibleprojects_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Dashboard> $dashboards
 * @property-read int|null $dashboards_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Filter> $filters
 * @property-read int|null $filters_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Project> $projects
 * @property-read int|null $projects_count
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    protected $table = 'user';

    protected $settings = null;


    public function visibleprojects() {
        return $this->belongsToMany('App\Models\Project', 'users_visible_projects_index', 'project_id', 'user_id' );
    }



    public function getAvatar() {
        $url          = '/img/avatar.png';
        if( auth()->user()->avatar != '' ) {
            $url     = '/avatar/' . auth()->user()->avatar;
        }
        $url        = config('app_url') . $url;
        return $url;
    }



    /**
     * Relation N:M projects
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function projects() {
        return $this->belongsToMany('App\Models\Project', 'user_has_project', 'user_id', 'project_id' );
    }


    /**
     *
     * Relation to 1:N Dasbiard
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function dashboards() {
        return $this->hasMany('App\Models\Dashboard', 'user_id', 'id' );
    }

    /**
     *
     * Relation to 1:N Filters
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function filters() {
        return $this->hasMany('App\Models\Filter', 'user_id', 'id' );
    }



    /**
     * Get the value of a user setting
     *
     * @param string $code
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     * @return string|null $value
     */
    public function getSetting( $code ):string|null {
        if( $this->settings === null ) {
            $arrSettings    = array();
            if( $this->id != '' ) {
                $sql = 'SELECT unique_id, `value` FROM settings
                           LEFT JOIN user_has_settings uhs ON uhs.settings_id = settings.id
                            WHERE uhs.user_id     = ' . $this->id;
                $arrSettings = \DB::select($sql);
                $arrSettings = index_by($arrSettings, 'unique_id');
            }
            $this->settings = $arrSettings;
        }

        $value              = null;
        if( isset( $this->settings[ $code ] ) == true ) {
            $value          = $this->settings[ $code ]->value;
        }

        return $value;
    }
}
