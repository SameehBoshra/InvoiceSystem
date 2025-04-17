<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;

class AddInvoiceNotification extends Notification
{
    use Queueable;
    private $invoiceNewId;

    /**
     * Create a new notification instance.
     */
    public function __construct(Invoice $invoiceNewId)
    {
        $this->invoiceNewId = $invoiceNewId;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];

    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */

     public function toDatabase(object $notifiable): array
     {

        return [
            'id'=>$this->invoiceNewId,
            'title'=>'تمت أضافة فاتورة بواسطة ',
            'user'=>auth::user()->name,
            'invoice_Date'=>$this->invoiceNewId->invoice_Date,
            'url'=>'http://127.0.0.1:8000/InvoiceDetails/'.$this->invoiceNewId,
        ];

    }

}
