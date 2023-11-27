<?php

namespace App\Indexer;

use App\Models\EavAttribute;
use App\Models\User;
use App\Models\Project;

class Ticket {


    const itemsPerChunk                 = 1000;

    public $doTruncate                  = false;


    /**
     * Reindex Search and Filtertable
     *
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     * @param $ticketIds
     * @return void
     */
    public function reindex( $ticketIds ):void {
        $arrItems = array_chunk( $ticketIds, self::itemsPerChunk);
        foreach ($arrItems as $chunk) {
            /** @var \App\Collections\Ticket $tickets */
            $tickets = \App\Models\Ticket::whereIn('id', $chunk)->get();
            $tickets->addAttributes();
            $this->createDataForFulltextsearch( $tickets );
            $this->createDataForFilter( $tickets );
        }
    }


    /**
     *
     * Write into filtertable
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     * @param array $tickets
     * @return void
     */
    protected function createDataForFilter( $tickets ):void {
        $write              = array();
        $deleteIds          = array();
        foreach( $tickets as $ticket ) {
            $deleteIds[ $ticket->id ]       = $ticket->id;
            $allAttributes  = $ticket->getAllAttributes();
            if( empty( $allAttributes ) == false ) {
                /** @var EavAttribute $attribute */
                foreach( $allAttributes as $attribute ) {
                    $baseAttribute      = $attribute->getAttribute();
                    if( $baseAttribute->attributetype->datatype != 'text' && $attribute->getValue() != '' ) {
                        $arrValue               = array(
                            $attribute->getValue()
                        );
                        if( $attribute->getValue() != '' ) {
                            $arrValue           = explode(',', $attribute->getValue() );
                        }

                        foreach( $arrValue as $item ) {
                            $write[]            = array(
                                'ticket_id'     => $ticket->id,
                                'attribute_id'  => $baseAttribute->id,
                                'value'         => $item
                            );
                        }
                    }
                }
            }
        }


        if( $this->doTruncate == false && empty( $deleteIds ) == false ) {
            \DB::table('ticket_eav_index')->whereIn('ticket_id', $deleteIds )->delete();
        }
        else {
            \DB::table('ticket_eav_index')->truncate();
        }

        if( empty( $write ) == false ) {
            $arrChunksToSave        = array_chunk( $write, 500 );
            foreach( $arrChunksToSave as $saveChunk ) {
                \DB::table('ticket_eav_index')->insert($saveChunk);
            }
        }
    }



    /**
     *
     * Write into fulltextsearch index data
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     * @param array $tickets
     * @return void
     */
    protected function createDataForFulltextsearch( $tickets ):void {
        $write              = array();
        $deleteIds          = array();
        foreach( $tickets as $ticket ) {
            $deleteIds[ $ticket->id ]       = $ticket->id;
            $data		= $ticket->unique_id . '|' . $ticket->name . '|' . $ticket->description;
            $write[]    = array(
                'ticket_id'     => $ticket->id,
                'data'          => $data
            );
        }
        if( $this->doTruncate == false && empty( $deleteIds ) == false ) {
            \DB::table('ticket_search_index')->whereIn('ticket_id', $deleteIds )->delete();
        }
        else {
            \DB::table('ticket_search_index')->truncate();
        }

        if( empty( $write ) == false ) {
            \DB::table('ticket_search_index')->insert( $write );
        }

    }
}
