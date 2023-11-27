<?php

namespace App\Console\Commands;
use App\Indexer\Ticket;
use Illuminate\Console\Command;

class ReindexTickets extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'ReindexTickets:all';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Re-index Tickets attributes';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{

        $sql        = 'SELECT id FROM ticket';
        $arrIds     = get_ids( \DB::select( $sql ), 'id' );


		$ticket		        = new Ticket();
        $ticket->doTruncate = true;
		$ticket->reindex( $arrIds );
	}
}
