<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\User;

class ResetPasswordEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->view('site.auth.Mails.reset_password')
            ->subject('إعادة تعيين كلمة المرور')
            ->with([
                'resetLink' => url('/reset-password/' . $this->user->getToken()),
                'expiresAt' => $this->user->getExpires(),
            ]);
    }
}
