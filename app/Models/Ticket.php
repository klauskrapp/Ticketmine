<?php

namespace App\Models;

use App\Helpers\Editor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\URL;

/**
 * App\Models\AttributeType
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $datatype
 * @property string|null $template_for_filters
 * @property string|null $eav_column
 * @property int|null $has_option
 * @property int|null $can_add_options
 * @property string|null $save_to_table
 * @property string|null $source_model
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AttributeType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AttributeType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AttributeType query()
 * @method static \Illuminate\Database\Eloquent\Builder|AttributeType whereCanAddOptions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttributeType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttributeType whereDatatype($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttributeType whereEavColumn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttributeType whereHasOption($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttributeType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttributeType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttributeType whereSaveToTable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttributeType whereSourceModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttributeType whereTemplateForFilters($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttributeType whereUpdatedAt($value)
 * @property int $attribute_id
 * @property int|null $position
 * @method static \Illuminate\Database\Eloquent\Builder|AttributeOption whereAttributeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttributeOption wherePosition($value)
 * @property int $project_id
 * @property string|null $icon_class
 * @method static \Illuminate\Database\Eloquent\Builder|Priority whereIconClass($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Priority whereProjectId($value)
 * @property int|null $is_default
 * @method static \Illuminate\Database\Eloquent\Builder|Priority whereIsDefault($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, State> $statechain
 * @property-read int|null $statechain_count
 * @property int $state_id
 * @property int $action_id
 * @property int $priority_id
 * @property int $created_by
 * @property int|null $increment_id
 * @property string|null $unique_id
 * @property string|null $description
 * @property int|null $refernce_id
 * @property int|null $reference_position
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereActionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereIncrementId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket wherePriorityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereReferencePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereRefernceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereStateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereUniqueId($value)
 * @property-read \App\Models\Action $action
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $assigned
 * @property-read int|null $assigned_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TicketAttachment> $attachments
 * @property-read int|null $attachments_count
 * @property-read \App\Collections\Ticket<int, \App\Models\TicketComment> $comments
 * @property-read int|null $comments_count
 * @property-read \App\Models\User $creator
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $follower
 * @property-read int|null $follower_count
 * @property-read \App\Models\Priority $priority
 * @property-read \App\Models\Project $project
 * @property-read \App\Models\State $state
 * @method static \App\Collections\Ticket<int, static> all($columns = ['*'])
 * @method static \App\Collections\Ticket<int, static> get($columns = ['*'])
 * @mixin \Eloquent
 */
class Ticket extends Base {

    use HasFactory;

    public $table   = 'ticket';


    public $attributesAdded     = false;


    protected $_attributes      = array();


    /**
     *
     * Add Attribute
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     * @param EavAttribute $attribute
     *
     * @return void
     */
    public function addAttribute( $attribute ):void {
        $this->_attributes[ $attribute->getAttribute()->code ] = $attribute;
    }



    /**
     *
     * Relation to user 1:1
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function creator() {
        return $this->belongsTo( 'App\Models\User', 'created_by');
    }



    /**
     *
     * Relation to project 1:1
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function project() {
        return $this->belongsTo( 'App\Models\Project', 'project_id');
    }


    /**
     *
     * Get all Attributes
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     * @return array
     */
    public function getAllAttributes():array {
        return $this->_attributes;
    }


    /**
     * Relation 1::N to attributeoptons
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function attachments() {
        return $this->hasMany( 'App\Models\TicketAttachment', 'ticket_id', 'id');
    }


    /**
     * Relation 1::N to attributeoptons
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function comments() {
        return $this->hasMany( 'App\Models\TicketComment', 'ticket_id', 'id');
    }


    /**
     *
     * Relation to user 1:N
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function assigned() {
        return $this->belongsToMany('App\Models\User', 'ticket_assigned_to', 'ticket_id', 'user_id' );
    }

    /**
     *
     * Relation to follower 1:N
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function follower() {
        return $this->belongsToMany( 'App\Models\User', 'user_follows_ticket', 'ticket_id', 'user_id' );
    }


    /**
     *
     * Relation to follower 1:1
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function state() {
        return $this->belongsTo( 'App\Models\State');
    }



    /**
     *
     * Relation to action 1:1
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function action() {
        return $this->belongsTo( 'App\Models\Action');
    }



    /**
     *
     * Relation to priority 1:1
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function priority() {
        return $this->belongsTo( 'App\Models\Priority', 'priority_id', 'id' );
    }





    /**
     *
     * internal Ticket URL
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     * @return string
     */
    public function getUrl():string {
        return  URL::to('/') . '/browse/' . $this->unique_id;
    }



    /**
     *
     * create new ticket collection
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     * @return \App\Collections\Ticket
     */
    public function newCollection(array $models = Array())
    {
        return new \App\Collections\Ticket( $models );
    }



    /**
     *
     * add Attibutes to single Ticket
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     * @return void
     */
    public function addAttributes():void {
        $collection         = new \App\Collections\Ticket( array( $this ) );
        $collection->addAttributes();
    }


    /**
     *
     * get Parsed Descriotion
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     * @return String $desc
     */
    public function getParsedDescription():string|null {
        $desc       = Editor::replaceUsers( $this->description );
        $desc       = Editor::replaceAppUrl( $desc );

        return $desc;
    }
}

