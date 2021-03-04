<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ClientGallery;

class Client extends Model
{
    protected $fillable = [
        'name',
        'description',
        'is_published',
        'client_image_url',
        'uuid',
        'client_gallery_urls',
        'slug',
        'expiry_date'
    ];
    
    protected $table = "clients";
    
    public function gallery()
    {
        return $this->hasMany(ClientGallery::class, 'client_id');
    }
    
    public function getClientGalleryUrlsAttribute($value)
    {
        return $value ? unserialize($value): [];
    }
}

