<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;

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
 * @property int $ticket_id
 * @property int $created_by
 * @property int|null $updated_by
 * @property string|null $description
 * @property-read \App\Models\Action $action
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $assigned
 * @property-read int|null $assigned_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TicketAttachment> $attachments
 * @property-read int|null $attachments_count
 * @property-read \App\Collections\Ticket<int, TicketComment> $comments
 * @property-read int|null $comments_count
 * @property-read \App\Models\User $creator
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $follower
 * @property-read int|null $follower_count
 * @property-read \App\Models\Priority $priority
 * @property-read \App\Models\Project $project
 * @property-read \App\Models\State $state
 * @property-read \App\Models\User|null $updatedby
 * @method static \App\Collections\Ticket<int, static> all($columns = ['*'])
 * @method static \App\Collections\Ticket<int, static> get($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder|TicketComment whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketComment whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketComment whereTicketId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketComment whereUpdatedBy($value)
 * @mixin \Eloquent
 */
class TicketComment extends Ticket {

    use HasFactory;

    public $table   = 'ticket_comment';




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
    public function ticket() {
        return $this->belongsTo( 'App\Models\Ticket', 'ticket_id');
    }




    /**
     *
     * Relation to user 1:1
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function updatedby() {
        return $this->belongsTo( 'App\Models\User', 'updated_by');
    }
}
