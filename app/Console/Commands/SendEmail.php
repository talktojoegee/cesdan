<?php

namespace App\Console\Commands;

use App\Mail\PaymentVerificationMail;
use App\Mail\ProfileUpdateMail;
use App\Mail\WelcomeNewUserMail;
use App\Models\EmailLog;
use App\Models\User;
use Illuminate\Console\Command;

class SendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send pending mails';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $mails = EmailLog::getAllPendingMails();
        if(count($mails) > 0){
            foreach ($mails as $mail){
                $user = User::find($mail->user_id);
                if(!empty($user)){
                    switch ($mail->type){
                        case 1: //Welcome mail
                            try {
                                \Mail::to($user)->send(new WelcomeNewUserMail($user) );
                                EmailLog::updateEmailLog($mail->id, 1);
                            }catch (\Exception $exception){
                                EmailLog::updateEmailLog($mail->id, 2);
                            }
                            break;
                        case 2: //Update profile
                            try {
                                \Mail::to($user)->send(new ProfileUpdateMail($user) );
                                EmailLog::updateEmailLog($mail->id, 1);
                            }catch (\Exception $exception){
                                EmailLog::updateEmailLog($mail->id, 2);
                            }
                            break;
                        case 3:
                            try {
                                \Mail::to($user)->send(new PaymentVerificationMail($user, $mail->subject, $mail->text) );
                                EmailLog::updateEmailLog($mail->id, 1);
                            }catch (\Exception $exception){
                                EmailLog::updateEmailLog($mail->id, 2);
                            }
                            break;
                    }
                }
            }
        }
    }
}
