<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Mail\SendMail;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $email;
    protected $recipientName;
    protected $sexo;
    protected $isValid;
    protected $processNumber;

    /**
     * Create a new job instance.
     */
    public function __construct($email, $recipientName, $sexo, $isValid, $processNumber)
    {
        $this->email = $email;
        $this->recipientName = $recipientName;
        $this->sexo = $sexo;
        $this->isValid = $isValid;
        $this->processNumber = $processNumber;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->email)->send(new SendMail($this->recipientName, $this->sexo, $this->isValid, $this->processNumber));
    }
}
