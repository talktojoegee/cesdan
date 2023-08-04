<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSupportingDocument extends Model
{
    use HasFactory;

    public static function getSupportingDocumentsByUserId($userId){
        return UserSupportingDocument::where('user_id', $userId)->get();
    }
}
