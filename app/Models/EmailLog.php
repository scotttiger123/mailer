<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailLog extends Model
{
    
    protected $fillable = [
        'recipient_email',
        'message_content',
    ];
}
