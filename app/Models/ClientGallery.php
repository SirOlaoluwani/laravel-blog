<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Client;

class ClientGallery extends Model
{
    protected $fillable = [
        'client_id',
        'image_url',
        'year_completed',
        'title',
        'medium',
        'category',
        'visibility',
        'status'
    ];
    
    protected $table = "client_gallery";
    
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}