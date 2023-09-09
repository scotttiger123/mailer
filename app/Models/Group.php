<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $fillable = [
        'group_name',
        'assign_email',
        'group_description',
        'group_type',
        'group_category',
        'privacy_settings',
        'group_image',
        
    ];

    public function mailsToGroups()
    {
        return $this->hasMany(MailsToGroup::class, 'group_id');
    }
    
}
