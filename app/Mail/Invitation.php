<?php
/**
 * Copyright (c) Liigem 2017.
 */

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Invitation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Invite the invite
     */
    public $invite;

    /**
     * Create a new message instance.
     *
     * @return void
     */
	public function __construct(\App\Invite $invite, $code)
    {
        $this->invite = $invite;
		$this->code = $code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.invite')
			->with('name', User::find($this->invite->from_id)->name . ' ' . User::find($this->invite->from_id)->last_name)
			->with('code', $this->code);


    }
}
