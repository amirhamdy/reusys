<?php

namespace App\Mail;

use App\Models\Customer;
use App\Models\Job;
use App\Models\Opportuninty;
use App\Models\Productline;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendNotificationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public string $type;
    public string $model;
    public Customer|Productline|Project|Job|Task $record;

    /**
     * Create a new message instance.
     *
     * @param string $type
     * @param string $model
     * @param $record
     */
    public function __construct(
        $record,
        string $type = 'created' | 'updated',
        string $model = 'customer' | 'productline' | 'project' | 'job' | 'task'
    )
    {
        $this->type = $type;
        $this->model = $model;
        $this->record = $record;
    }

    /**
     * Get the message envelope.
     *
     * @return Envelope
     */
    public function envelope(): Envelope
    {
        $envelope = new Envelope(
            from: env('MAIL_FROM', 'no_reply@reutrans.com'),
            to: env('MAIL_TO', 'projects@reutrans.com'),
            bcc: env('MAIL_BCC', 'amirhamdy66@gmail.com'),
            replyTo: env('MAIL_REPLY_TO', 'projects@reutrans.com'),
        );

        if ($this->type === 'created') {
            $envelope->subject = 'New ' . ucfirst($this->model) . ' Created';
        } else {
            $envelope->subject = ucfirst($this->model) . ' Updated';
        }

        return $envelope;
    }

    /**
     * Get the message content definition.
     *
     * @return Content
     */
    public function content(): Content
    {
        $content = new Content();

        if ($this->type === 'created') {
            $content->view = 'mail.' . $this->model . '.created';
            $content->with['title'] = ucfirst($this->model) . ' Created';
        } else {
            $content->view = 'mail.' . $this->model . '.updated';
            $content->with['title'] = ucfirst($this->model) . ' Updated';
        }

        switch ($this->model) {
            case 'customer':
                $content->with['customer'] = $this->record;
                break;
            case 'productline':
                $content->with['productline'] = $this->record;
                break;
            case 'project':
                $content->with['project'] = $this->record;
                break;
            case 'job':
                $content->with['job'] = $this->record;
                break;
            case 'task':
                $content->with['task'] = $this->record;
                break;
        }

        return $content;
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments(): array
    {
        return [];
    }
}
