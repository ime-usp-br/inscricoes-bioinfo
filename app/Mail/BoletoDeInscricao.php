<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Blade;
use TijsVerkoyen\CssToInlineStyles\CssToInlineStyles;
use Illuminate\Mail\Mailables\Attachment;
use App\Models\Inscricao;
use App\Models\ModeloEmail;

class BoletoDeInscricao extends Mailable
{
    use Queueable, SerializesModels;

    public $inscricao, $modelo;

    public function __construct(Inscricao $inscricao, ModeloEmail $modelo)
    {
        $this->inscricao = $inscricao;
        $this->modelo = $modelo;
    }

    public function envelope(): Envelope
    {
        $subject = Blade::render(
            html_entity_decode($this->modelo->assunto),
            [
                "inscricao"=>$this->inscricao,
            ]
        );

        return new Envelope(
            subject: $subject,
        );
    }

    public function content(): Content
    {
        $cssToInlineStyles = new CssToInlineStyles();
        
        $body = Blade::render(
            html_entity_decode($this->modelo->corpo),
            [
                "inscricao"=>$this->inscricao,
            ]
        );

        $css = file_get_contents(base_path() . '/public/css/mail.css');

        return new Content(
            htmlString: $cssToInlineStyles->convert($body, $css),
        );
    }

    public function attachments(): array
    {
        return [
            Attachment::fromData(fn () => base64_decode($this->inscricao->boleto->obterBoletoPDF()), 'Boleto.pdf')->withMime('application/pdf'),
        ];
    }
}
