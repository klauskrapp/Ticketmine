<?php
return [

	'new_ticket_created' => array(
		'subject'	=> 'email.new_ticket_created_subject',
		'didwhat'	=> 'email.new_ticket_created_didwhat',
		'template'	=> 'emails.master_email'
	),
    'action_changed' => array(
        'subject'	=> 'email.action_changed_subject',
        'didwhat'	=> 'email.action_changed_didwhat',
        'template'	=> 'emails.master_email'
    ),
    'priority_changed' => array(
        'subject'	=> 'email.priority_changed_subject',
        'didwhat'	=> 'email.priority_changed_didwhat',
        'template'	=> 'emails.master_email'
    ),
    'state_changed' => array(
        'subject'	=> 'email.state_changed_subject',
        'didwhat'	=> 'email.state_changed_didwhat',
        'template'	=> 'emails.master_email'
    ),
    'assignees_changed' => array(
        'subject'	=> 'email.assignees_changed_subject',
        'didwhat'	=> 'email.assignees_changed_didwhat',
        'template'	=> 'emails.master_email'
    ),
    'follower_changed' => array(
        'subject'	=> 'email.follower_changed_subject',
        'didwhat'	=> 'email.follower_changed_didwhat',
        'template'	=> 'emails.master_email'
    ),
    'author_changed' => array(
        'subject'	=> 'email.author_changed_subject',
        'didwhat'	=> 'email.author_changed_didwhat',
        'template'	=> 'emails.master_email'
    ),
    'attachment_added' => array(
        'subject'	=> 'email.attachment_added_subject',
        'didwhat'	=> 'email.attachment_added_didwhat',
        'template'	=> 'emails.master_email'
    ),
    'attachment_removed' => array(
        'subject'	=> 'email.attachment_removed_subject',
        'didwhat'	=> 'email.attachment_removed_didwhat',
        'template'	=> 'emails.master_email'
    ),


    'description_changed' => array(
        'subject'	=> 'email.description_changed_subject',
        'didwhat'	=> 'email.description_changed_didwhat',
        'template'	=> 'emails.master_email'
    ),

    'comment_mention' => array(
        'subject'	=> 'email.comment_mention_subjectTicketsystem: {unique_id} {name} - Erwähnung in Kommentar',
        'didwhat'	=> 'email.comment_mention_didwhat',
        'template'	=> 'emails.master_email'
    ),
    'new_comment_added' => array(
        'subject'	=> 'email.new_comment_added_subject',
        'didwhat'	=> 'email.new_comment_added_didwhat',
        'template'	=> 'emails.master_email'
    ),

    'comment_edit' => array(
        'subject'	=> 'email.comment_edit_subject',
        'didwhat'	=> 'email.comment_edit_didwhat',
        'template'	=> 'emails.master_email'
    ),

    'comment_removed' => array(
        'subject'	=> 'email.comment_removed_subject',
        'didwhat'	=> 'email.comment_removed_didwhat',
        'template'	=> 'emails.master_email'
    ),

    'ticket_deleted' => array(
        'subject'	=> 'email.ticket_deleted_subject',
        'didwhat'	=> 'email.ticket_deleted_didwhat',
        'template'	=> 'emails.master_email'
    ),












	'attributes_changed' => array(
		'subject'	=> 'Ticketsystem: {unique_id} {name} - Attribute wurden geändert',
		'didwhat'	=> 'hat Attribute geändert: <b>{from}</b> auf <b>{to}</b>',
		'template'	=> 'emails.master_email'
	),

	'description_changed' => array(
		'subject'	=> 'Ticketsystem: {unique_id} {name} - Die Beschreibung wurde geändert',
		'didwhat'	=> 'hat die Beschreibung geändert',
		'template'	=> 'emails.master_email'
	),

	'send_notification_at' => array(
		'subject'	=> 'Ticketsystem: Erinnerung an folgende Tickets',
		'template'	=> 'emails.send_notification_at'
	),
	'notification_at_changed' => array(
		'subject'	=> 'Ticketsystem: {unique_id} {name} - das Erinnerungsdatum wurde geändert',
		'didwhat'	=> 'hat das Erinnerungsdatum geändert: von <b>{from}</b> auf <b>{to}</b>',
		'template'	=> 'emails.master_email'
	),
	'finish_at' => array(
		'subject'	=> 'Ticketsystem: {unique_id} {name} - das Fertigstellungsdatum wurde geändert',
		'didwhat'	=> 'hat das Fertigstellungsdatum geändert: von <b>{from}</b> auf <b>{to}</b>',
		'template'	=> 'emails.master_email'
	),

	'ticket_unteraufgabe' => array(
		'subject'	=> 'Ticketsystem: {unique_id} {name} wurde in ein Unterticket konvertiert',
		'didwhat'	=> 'hat das Ticket in ein Unterticket konvertiert',
		'template'	=> 'emails.master_email'
	),

];
