<?php

namespace App;

use App\Models\Client;
use Illuminate\Database\Eloquent\Model;

class ClientPastExhibitions extends Model
{
    protected $fillable = [
        'client_id', 'name', 'location', 'year', 'featured_image_url'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}