<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    public function TopicConfirm()
    {
        return $this->hasMany('App\Models\TopicConfirm', 'topic_id');
    }
}
