<?php

namespace App\Http\Controllers\Attribute;
use App\Models\AttributeOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;


class Save extends Attribute
{

    /**
     * Saves a attribute
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     * @param Request $request
     * @return Illuminate\Http\RedirectResponse
     *
     */
    public function execute(Request $request ):\Illuminate\Http\RedirectResponse {

        $data           = $request->get('attribute');
        /** @var \App\Models\Attribute $entity */
        $entity		    = \App\Models\Attribute::findOrNew( $data['id'] );

        $arrResult                  = array();
        $arrResult['move_to']       = url('attribute');

        $blnIsValid     = true;
        // check if code already exists
        if( $entity->id == '' ) {
            $blnIsValid             = true;
            $projectsToLoad         = \App\Models\Attribute::where('code', '=', $data['code'])->first();
            if( $projectsToLoad ) {
                $blnIsValid         = false;

                $arrResult['message_type']      = 'danger';
                $arrResult['message']           = __('attribute.code_already_exists');
            }
        }


        // Save options for an attribute
        if( $blnIsValid == true ) {
            $entity->addData( $data );
            $entity->save();
            $options            = $request->get('option', array() );
            $delete             = $request->get('deleteoption', array() );
            // delete not used attributes
            foreach( $delete as $item ) {
                AttributeOption::find($item)->delete();
            }


            // write the options
            foreach( $options as $option ) {
                if( $option['name'] != '' ) {
                    $optionItem = AttributeOption::findOrNew($option['id']);
                    $optionItem->attribute_id = $entity->id;
                    $optionItem->name = $option['name'];
                    $optionItem->position = $option['position'];
                    $optionItem->save();
                }
            }



            $arrResult['message_type']      = 'success';
            $arrResult['message']           = __('global.entity_saved');
            $arrResult['move_to']           = url('attribute/edit/' . $entity->id );
        }


        $request->session()->flash('message',  $arrResult );
        return redirect( $arrResult['move_to'] );

    }


}
