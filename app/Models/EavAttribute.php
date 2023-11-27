<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class EavAttribute  {

	use HasFactory;

	protected $_attributeValue		= null;
	protected $_attributeCode		= null;
	protected $_baseAttribute		= null;
	protected $_label				= null;
	protected $_entityId			= null;
	protected $_type				= null;

	public static $tablePrefix		= null;
	public static $column			= null;
	public static $addToFlat		= true;
	public static $tableFlat		= null;

	protected static $attributeCache	= array();

	public function setAttributeCode( $data ) {
		$this->_attributeCode		= $data;
	}


	public function getAttributeCode() {
		return $this->_attributeCode;
	}




	public function getValue( ) {
		return $this->_attributeValue;
	}



	public function setType( $type ) {
		$this->_type		= $type;
	}

	public function setEntityId( $entityId ) {
		$this->_entityId		= $entityId;
	}


	public function getEntityId() {
		return $this->_entityId;
	}


	public function setLabel( $label ) {
		$this->_label		= $label;
	}



	public function setValue( $value  ) {
		$this->_attributeValue		= $value;
	}



	public function setAttribute( $attribute ) {
		$this->_baseAttribute		= $attribute;
	}



	public function getAttribute() {
		return $this->_baseAttribute;
	}


}
