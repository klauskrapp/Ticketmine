<?php

namespace App\Http\Controllers\Ticket\Create;
use App\Http\Controllers\Ticket\Ticket;
use App\Models\Attribute;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;


class Form extends Ticket
{


    /**
     *
     * Settings depening to project
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     * @param Request $request
     * @param \App\Models\Project $project
     * @return  array $result
     *

     *
     *
     */
    public function execute(Request $request, Project $project ):\Illuminate\View\View {

        // get attribtues for the project
        $arrAttributes          = array();
        $attributes             = \App\Helpers\Attribute::getProjectesAttributes( array( $project->id ) );
        if( isset( $attributes[ $project->id ] ) == true ) {
            $arrAttributes      = $attributes[$project->id];
        }


        $mView	= View::make( 'ticket.create.form', array(
            'project'   => $project,
            'attributes'    => $arrAttributes
        )  );
        return $mView;
    }


}
