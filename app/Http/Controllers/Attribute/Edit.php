<?php

namespace App\Http\Controllers\Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;


class Edit extends Attribute
{


    public function __construct()
    {
        parent::__construct();
    }


    /**
     * edits an attribute
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     * @param Request $request
     * @param \App\Models\Attribute $attribute
     * @return \Illuminate\View\View $mView
     *
     */
    public function execute(Request $request, \App\Models\Attribute $attribute ):\Illuminate\View\View {

        $mView	= View::make( 'attribute.edit', array('entity' => $attribute) );
        return $mView;
    }


}
