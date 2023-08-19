<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailsToGroup extends Model
{
    use HasFactory;
    protected $fillable = [
        'group_id',
        'assign_emails_json',
    ];

    // Define the relationship with the Group model
    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }

    
}
