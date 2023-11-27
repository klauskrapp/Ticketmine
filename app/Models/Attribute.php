<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Attribute
 *
 * @property int $id
 * @property int $attribute_type_id
 * @property string|null $name
 * @property string|null $code
 * @property string|null $save_to_table
 * @property string|null $source_model
 * @property string|null $default_value
 * @property int|null $filterable
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\AttributeType $AttributeType
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute query()
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereAttributeTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereDefaultValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereFilterable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereSaveToTable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereSourceModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\AttributeOption> $attributeoptions
 * @property-read int|null $attributeoptions_count
 * @property-read \App\Models\AttributeType $attributetype
 * @property int $ticket_eav_index_id
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereTicketEavIndexId($value)
 * @mixin \Eloquent
 */
class Attribute extends Base {

    use HasFactory;

    public $table   = 'attribute';


    /**
     * Relation 1:1 to AttributeType
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function attributetype() {
        return $this->belongsTo( 'App\Models\AttributeType', 'attribute_type_id');
    }




    /**
     * Relation 1::N to attributeoptons
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function attributeoptions() {
        return $this->hasMany( 'App\Models\AttributeOption', 'attribute_id', 'id')->orderBy( 'position', 'asc' );
    }

}
