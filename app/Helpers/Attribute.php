<?php
namespace App\Helpers;
use App\Models\EavAttribute;
use Illuminate\Support\Facades\DB;

class Attribute

{

    /**
     * prefix for EAV Table
     */
    const eavPrefix        = 'ticket_eav_';

    /**
     * @var array
     */
    public static $entityIds		= array();

    /**
     * Load attributes, defined for a list of projects
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     * @param array $projectIds, IDs of the project
     * @return array $arrData
     *
     */
    public static function getProjectesAttributes( $projectIds ):array {
        $sql                = 'select pha.project_id, attribute.*, at.datatype, at.template_for_filters, at.eav_column, at.has_option, at.can_add_options FROM attribute
                            LEFT JOIN project_has_attribute pha on attribute.id = pha.attribute_id
                            LEFT JOIN attribute_type at on attribute.attribute_type_id = at.id
                            WHERE pha.project_id IN ('.implode(',', $projectIds).') ORDER BY pha.position asc';

        $arrData            = \DB::select( $sql );
        foreach( $arrData as $key => $item ) {
            $arrData[ $key ]->options       = array();
        }
        $attributeIds       = get_ids( $arrData, 'id');
        $arrData            = index_by( $arrData, 'id');


        if( empty( $attributeIds ) == false ) {
            $sql            = 'SELECT * FROM attribute_option WHERE attribute_id IN('.implode(',', $attributeIds).') ORDER BY position asc';
            $arrOptions     = \DB::select( $sql );

            foreach( $arrOptions as $option ) {
                $arrData[ $option->attribute_id ]->options[]        = $option;
            }
        }
        $arrResult          = array();
        foreach( $arrData as $item ) {
            $arrResult[ $item->project_id ][ $item->id ]     = $item;
        }
        return $arrResult;
    }


    /**
     * Save Attributes into eav table
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     * @param $ticketId, id of the ticket
     * @param $attributes, array with attributes, key is ID
     * @return void
     */
    public static function saveAttributes( $ticketId, $attributes ):void {
        if( empty( $attributes ) == false ) {
            $attribtueIds       = array_keys($attributes);
            $arrAttributes      = \App\Models\Attribute::with(array('attributetype'))->whereIn('id', $attribtueIds )->get();
            $arrAttributes      = index_by( $arrAttributes, 'id' );


            foreach( $attributes as $id => $value ) {
                /** @var \App\Models\Attribute $attribute */
                $attribute      = $arrAttributes[ $id ];

                $table          = self::eavPrefix . $attribute->save_to_table;
                $sql            = 'REPLACE INTO '.$table.' (attribute_id, ticket_id, `value`) VALUES ('.$attribute->id.', '.$ticketId.', :value)';
                $strValue       = null;
                if( is_array ( $value ) == true ) {
                    $strValue   = implode(',', $value);
                }
                else if( $value != '' ) {
                    $strValue       = $value;
                }
                \DB::insert( $sql, array(':value' => $strValue ) );
            }
        }
    }


    /**
     * Get the value of an attribute
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     * @param \App\Models\Ticket $ticket
     * @param $attribute
     * @param $implodeArray, if false multiselect attributes are returned as array
     * @return string $value
     */
    public static function getAttributesValue( \App\Models\Ticket $ticket, $attribute, $implodeArray, $asText ) {
        $attributes         = $ticket->getAllAttributes();
        $value              = '';
        $datatype           = $attribute->datatype;
        $options            = $attribute->options;
        if ( get_class( $attribute ) != 'stdClass' ) {
            $datatype       = $attribute->attributetype->datatype;
            $options        = $attribute->attributeoptions;

        }
        $options        = index_by( $options, 'id');


        if( isset( $attributes[ $attribute->code ]  ) == true ) {
            $value      =  $attributes[ $attribute->code ]->getValue();
            if( $datatype == 'dropdown') {
                if( isset( $options[$value] ) == true && $asText == true ) {
                    $value      = $options[$value]->name;
                }

                if( isset( $options[$value] ) == true && $asText == false ) {
                    $value      = $options[$value]->id;
                }
            }
            else if( $datatype == 'multiselect'  ) {
                $arrValues      = explode(',', $value );
                $arrValResult   = array();
                foreach( $arrValues as $val ) {
                    if( isset( $options[ $val ] ) == true && $asText == true ) {
                        $arrValResult[]     = $options[ $val ]->name;
                    }

                    if( isset( $options[ $val ] ) == true && $asText == false ) {
                        $arrValResult[]     = $options[ $val ]->id;
                    }
                }
                if( $implodeArray == true ) {
                    $arrValResult   = implode(',', $arrValResult );
                }
                $value          = $arrValResult;
            }
            else if( $datatype == 'yes_no' ) {
                if( $asText == true ) {
                    $value      = $value == 1 ? __('global.yes') : __('global.no');
                }
            }
        }
        return $value;
    }


    /**
     * Load Attibutes for a ticket
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     * @param $entityId, id of the ticket
     * @return array
     */
    public static function getAttributes( $entityId ):array {
        $arrResult = array();
        $addAttributes = false;
        // Wenn entity kein array ist, array basteln
        if (is_array( $entityId ) == false && $entityId > 0) {
            $addAttributes      = true;
            $entityId           = array($entityId);
        }
        else if (is_array($entityId) == true) {
            $addAttributes = true;
        }


        /// attribute laden
        if ($addAttributes == true) {
            $arrToLoad = array_unique($entityId);
            if (empty($arrToLoad) == false) {
                self::$entityIds = $arrToLoad;
                $arrResult = self::getAttributeValues();
            }
        }


        return $arrResult;
    }



    /**
     * Load Attributes from EAV Tables for tickets
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>

     * @return array
     */
    protected static function getAttributeValues():array {
        $arrResult			= array();

        $sql				= 'SELECT DISTINCT save_to_table FROM attribute';
        $tables             = get_ids( \DB::select( $sql ), 'save_to_table');

        $select				= array();
        // union select zusammenbauen
        foreach( $tables as $table ) {
            $select[]		= 'SELECT * FROM ' . self::eavPrefix . $table . ' WHERE ticket_id IN ('.implode(',', self::$entityIds ).')';
        }

        if( empty( $select ) == false ) {
            $strSelect = implode(' UNION ', $select);
            $data = DB::select($strSelect);


            $arrAttributes = get_ids($data, 'attribute_id');


            // attribute laden, welche gefunden wurden
            $baseAttributes = \App\Models\Attribute::query()
                ->with('attributeoptions')
                ->with('attributetype')
                ->whereIn('id', $arrAttributes)
                ->get();


            $baseAttributes = index_by($baseAttributes, 'id');

            // attribute aufbereiten
            foreach ($data as $attribute) {
                if (isset($baseAttributes[$attribute->attribute_id]) == true) {
                    $attr = new EavAttribute();
                    $attr->setEntityId($attribute->ticket_id);
                    $attr->setValue($attribute->value);
                    $attr->setAttributeCode($baseAttributes[$attribute->attribute_id]->code);
                    $attr->setLabel($baseAttributes[$attribute->attribute_id]->label);
                    $attr->setAttribute($baseAttributes[$attribute->attribute_id]);
                    $attr->setType($baseAttributes[$attribute->attribute_id]->attributetype->datatype);
                    $arrResult[] = $attr;
                }
            }
        }
        return $arrResult;

    }
}


