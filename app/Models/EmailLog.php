<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailLog extends Model
{
    use HasFactory;



    public static function  logEmail($userId, $type = 1, $subject = null, $text = null){
        $log = new EmailLog();
        $log->user_id = $userId;
        $log->type = $type;
        $log->subject = $subject;
        $log->text = $text;
        $log->save();
    }

    public static function updateEmailLog($id, $status){
        $log = EmailLog::find($id);
        $log->status = $status;
        $log->save();
    }

    public static function getAllPendingMails(){
        return EmailLog::where('status', 0)->get();
    }



}
