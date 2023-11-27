<?php
/**
 * Created by PhpStorm.
 * User: manuel.schaefer
 * Date: 30.10.2018
 * Time: 11:48
 */

namespace App\Models;


/**
 * App\Models\StateIsInStategroup
 *
 * @property int $state_group_id
 * @property int $state_id
 * @property-read \App\Models\State $state
 * @property-read \App\Models\Groupstate $stategroup
 * @method static \Illuminate\Database\Eloquent\Builder|StateIsInStategroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StateIsInStategroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StateIsInStategroup query()
 * @method static \Illuminate\Database\Eloquent\Builder|StateIsInStategroup whereStateGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StateIsInStategroup whereStateId($value)
 * @mixin \Eloquent
 */
class StateIsInStategroup extends Base {

	public $table		= 'state_is_in_state_group';


    /**
     *
     * Relation to Groupstate 1:1
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
	public function stategroup(){
		return $this->belongsTo('App\Models\Groupstate','state_group_id');
	}

    /**
     *
     * Relation to State 1:1
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
	public function state(){
		return $this->belongsTo('App\Models\State','state_id');
	}



}
