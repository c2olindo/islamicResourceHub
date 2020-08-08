<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use DB;

class ResourceBanMail extends Mailable
{
    use Queueable, SerializesModels;

    public $mailData;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mailData)
    {
        $this->mailData = $mailData;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mailFooter = DB::table('mail_settings')->where('name', '=', 'footer')->first();
        return $this->from("info@projexin.com", "Resource Ban")
                    ->subject("Resource Ban")
                    ->view('emails.resourceBanMail', [
                                'mailData' => $this->mailData, 
                                'mail_footer' => $mailFooter
                            ]);
    }
}
