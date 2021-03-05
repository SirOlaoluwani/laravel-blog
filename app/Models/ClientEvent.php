<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Client;

class ClientEvent extends Model
{
    protected $fillable = [
        'client_id',
        'name',
        'description',
        'date',
        'location',
    ];
    
    protected $table = "client_event";
    
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}