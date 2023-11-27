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
 * @mixin \Eloquent
 */
class AttributeType extends Base {

    use HasFactory;

    public $table   = 'attribute_type';




}