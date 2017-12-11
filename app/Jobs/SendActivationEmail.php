<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\Models\User;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendActivationEmail extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    /**
     * 用户的实例
     *
     * @var User
     */
    protected $user;

    /**
     * Create a new job instance.
     *
     * @param User $recipient
     */
    public function __construct(User $recipient)
    {
        $this->user = $recipient;
    }

    /**
     * Execute the job.
     * Send the account activation email via queue
     *
     * @param Mailer $mailer
     * @return void
     */
    public function handle(Mailer $mailer)
    {
        $from = 'admin@dev.local';
        $fromName = 'admin';
        $recipient = $this->user->email;
        $subject = '注册验证通知邮件';

        $mailer->send('emails.activation', [
            'user' => $this->user,
        ], function($message) use ($from, $fromName, $recipient, $subject) {
            $message->from($from, $fromName)->to($recipient)->subject($subject);
        });
    }
}
