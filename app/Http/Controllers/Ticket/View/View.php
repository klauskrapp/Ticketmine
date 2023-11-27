<?php
namespace App\Http\Controllers\Ticket\View;
use App\Http\Controllers\Ticket\Ticket;

class View extends Ticket {



    public function __construct()
    {

    }



    public function getStoragePath( $ticket, $filename ) {
        $path           = storage_path('attachments/' . strtolower( $ticket->project->unique_id ) . '/' . substr( $filename, 0, 1 ) . '/' );
        return $path;
    }

    /**
     * @param $projectIds
     * @param $field
     * @param $value
     * @return \App\Models\Ticket $ticket
     */
    public function getTicket( $projectIds, $field, $value )
    {

        $ticket = \App\Models\Ticket::whereIn('project_id', $projectIds)
            ->where( $field , '=', $value)
            ->get()
            ->first();

        return $ticket;
    }
}
