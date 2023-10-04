<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $template;
    public $subject;

    public function __construct($data, $template, $subject)
    {
        $this->data = $data;
        $this->template = $template;
        $this->subject = $subject;
    }

    public function build()
    {
        return $this->from('mailing@lanuitdudroit.com', 'LA NUIT DU DROIT')
            ->view($this->template)
            ->subject($this->subject)
            ->with(['data' => $this->data]);
    }
}
