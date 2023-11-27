<?php

namespace App\Jobs;
use App\Indexer\Conversation;
use App\Indexer\Customer;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;


class TicketIndex implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected $ticketId		= null;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct( $ticketId ) {
        $this->ticketId		= $ticketId;
    }


    /**
     * Execute the job.
     *
     *
     * @return void
     */
    public function handle()
    {

        $indexer			= new \App\Indexer\Ticket();
        $indexer->reindex( array( $this->ticketId ) );
    }

}
