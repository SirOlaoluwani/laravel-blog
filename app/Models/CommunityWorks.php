<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommunityWorks extends Model
{
    protected $fillable = [
        'title',
        'body',
        'is_published',
        'featured_image_url'
    ];
    
    protected $table = "community_works";
}

