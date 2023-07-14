<?php

namespace App\Jobs;

use App\Mail\EmailVerification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;

class EmailVerificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $mailData;
    protected $user;
    /**
     * Create a new job instance.
     */
    public function __construct($mailData, $user)
    {
        $this->mailData = $mailData;
        $this->user = $user;
      
    }


    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $email = new EmailVerification($this->mailData);
        Mail::to($this->user->email)->send($email);
    }
}