<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use PDF;
use Illuminate\Queue\SerializesModels;

class FacturaGenerada extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $factura;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($factura)
    {
        $this->factura = $factura;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $pdf = PDF::setOptions(['logOutputFile' => null])->loadView("pdf.factura",[
            "factura" => $this->factura
        ]);
        return $this->markdown('emails.factura.creada')
                    ->attachData($pdf->output(), 'factura.pdf', [
                        'mime' => 'application/pdf',
                    ]);
    }
}
