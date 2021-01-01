<?php

namespace App\Mail;

use App\Models\Screening;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ScreeningResponse extends Mailable
{
    use Queueable, SerializesModels;

    public $content;
    public ?Screening $screening;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $content, Screening $screening)
    {
        $this->content = $content;
        $this->screening = $screening;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.screening.response');
    }
}
