<?php

namespace App\Notifications;

use App\Models\Client;
use App\Models\Project;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewProjectNotification extends Notification
{
    use Queueable;

    private Project $project;
    private User $user;
    private Client $client;
    private User $creator;

    /**
     * Create a new notification instance.
     */
    public function __construct($project, $creator)
    {
        $this->project = $project;
        $this->user = $project->user;
        $this->client = $project->client;
        $this->creator = $creator;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable): MailMessage
    {
        $url = url('/projects/' . $this->project->id);
        //get the current user role
        $role = $this->creator->role;
        if ($role === 'user') {
            $title = 'New Project Created';
        } else {
            $title = 'New Project Assigned';
        }

        return (new MailMessage)
            ->subject($title)
            ->markdown('emails.new_project', [
                'title' => $title,
                'project' => $this->project,
                'user' => $this->user,
                'client' => $this->client->user,
                'url' => $url,
            ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
