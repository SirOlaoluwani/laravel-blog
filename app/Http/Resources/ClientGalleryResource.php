<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientGalleryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'           => $this->id,
            'client_id'        => $this->client_id,
            'image_url'         => 'https://admin.bdicofficial.com'.$this->image_url,
            'created_at'   => $this->created_at->format('d-m-Y H:i'),
            'updated_at'   => $this->updated_at->format('d-m-Y H:i'),
        ];
    }

    /**
     * Customize the outgoing response for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Http\Response  $response
     * @return void
     */
    public function withResponse($request, $response)
    {
        $response->header('ETag', $this->etag);
    }
}
