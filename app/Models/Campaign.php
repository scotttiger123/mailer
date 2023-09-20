<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;
    protected $fillable = [
        'campaign_name',
        'group_id',
        'schedule_option',
        'start_date',
        'recurring_option',
        'template_option',
        'created_by'
    ];
    public function template()
        {
            return $this->belongsTo(Template::class, 'template_option');
        }

    public function group()
        {
            return $this->belongsTo(Group::class, 'group_id');
        }   
}
