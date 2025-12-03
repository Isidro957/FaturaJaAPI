<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FaturaEnviadaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $fatura;

    public function __construct($fatura)
    {
        $this->fatura = $fatura;
    }

    public function build()
    {
        return $this->subject('Sua Fatura - '.$this->fatura->numero)
                    ->markdown('emails.fatura')
                    ->attach(storage_path('app/public/faturas/'.$this->fatura->arquivo_pdf)); // anexa o PDF
    }
}
