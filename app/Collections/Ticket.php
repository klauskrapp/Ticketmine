<?php
namespace  App\Collections;


use App\Helpers\Attribute;
use App\Models\EavAttribute;

class Ticket extends \Illuminate\Database\Eloquent\Collection {


    /**
     * Add Attributes to Ticketcollection
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     * @return  void
     *
     */
	public function addAttributes() {
		$arrIds			= array();
		$projectIds		= array();
		foreach( $this as $record ) {
			$arrIds[]		= $record->id;
			$projectIds[]	= $record->project_id;
		}


		if( empty( $arrIds ) == false && empty( $projectIds ) == false ) {
			$attributes									= Attribute::getAttributes( $arrIds );
			$attributesets								= Attribute::getProjectesAttributes( $projectIds );

            $arrAttributesByTicket                      = array();
            foreach( $attributes as $attribute ) {
                $arrAttributesByTicket[ $attribute->getEntityId() ][ $attribute->getAttribute()->id ] = $attribute;
            }

            /** @var \App\Models\Ticket $record */
            foreach( $this as $record ) {
                $this->attributesAdded      = true;
                if( isset( $arrAttributesByTicket[ $record->id ] ) == true  && isset( $attributesets[ $record->project_id] ) == true ) {
                    /** @var EavAttribute $attribute */
                    foreach(  $arrAttributesByTicket[ $record->id ] as $attribute ) {
                        $record->addAttribute( $attribute );
                    }
                }
            }
		}
	}
}
