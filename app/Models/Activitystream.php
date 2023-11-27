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
 * @property int $user_id
 * @property string|null $template
 * @property string|null $content
 * @method static \Illuminate\Database\Eloquent\Builder|Activitystream whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activitystream whereTemplate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activitystream whereTicketId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activitystream whereUserId($value)
 * @property-read \App\Models\Ticket $ticket
 * @property-read \App\Models\User $user
 * @mixin \Eloquent
 */
class Activitystream extends Base {

    use HasFactory;

    public $table   = 'activitystream';



    /**
     *
     * Relation to user 1:1
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function user() {
        return $this->belongsTo( 'App\Models\User', 'user_id');
    }


    /**
     *
     * Relation to ticket 1:1
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function ticket() {
        return $this->belongsTo( 'App\Models\Ticket', 'ticket_id');
    }

}
