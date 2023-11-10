<?php

namespace App\Mail;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewTaskMail extends Mailable
{
    use Queueable, SerializesModels;

    public $task;
    public $date_limit_completion;
    public $url;

    /**
     * Create a new message instance.
     */
    public function __construct(Task $task)
    {
        $this->task = $task->task;
        $this->date_limit_completion = date('d/m/Y', strtotime($task->date_limit_completion));
        $this->url = 'http://localhost/task/' . $task->id;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nova tarefa criada',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.new-task',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
