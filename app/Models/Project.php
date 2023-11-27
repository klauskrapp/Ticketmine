<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Project
 *
 * @property int $id
 * @property string|null $unique_id
 * @property string|null $name
 * @property string|null $increment_id
 * @property int|null $allow_multiple_assignees
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Project newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Project newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Project query()
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereAllowMultipleAssignees($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereIncrementId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereUniqueId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereUpdatedAt($value)
 * @property int|null $is_free_for_all_user
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Attribute> $attributes
 * @property-read int|null $attributes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereIsFreeForAllUser($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $visibleusers
 * @property-read int|null $visibleusers_count
 * @mixin \Eloquent
 */
class Project extends Base {

    use HasFactory;

    public $table   = 'project';


    /**
     * Relation N:M attributes
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function attributes() {
        return $this->belongsToMany('App\Models\Attribute', 'project_has_attribute', 'project_id', 'attribute_id' )
            ->withPivot('position')->orderBy( 'position', 'asc' );
    }


    /**
     * Relation N:M users
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users() {
        return $this->belongsToMany('App\Models\User', 'user_has_project', 'project_id', 'user_id' );
    }


    /**
     * Relation N:M users
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function visibleusers() {
        return $this->belongsToMany('App\Models\User', 'users_visible_projects_index', 'project_id', 'user_id' );
    }
}
