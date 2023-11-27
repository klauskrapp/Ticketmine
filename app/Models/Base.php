<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
/**
 * App\Models\Base
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Base newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Base newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Base query()
 * @mixin \Eloquent
 */
class Base extends Model {





	public $timestamps					= true;

	protected $guarded					= array();


    /**
     * Add data to the Model, without using fillable attributes. but ignore ID
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     * @param array $data, array with data, key must be a field of the model / database
     * @return void
     */
    public function addData( $data ) {
        foreach( $data as $key => $value ) {
            if ($key == 'id' ) {
                continue;
            }

            $value      = $value == '' ? null : $value;
            $this->$key = $value;
        }
    }


}
