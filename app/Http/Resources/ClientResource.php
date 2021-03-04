<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
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
            'name'        => $this->name,
            'description'         => $this->description,
            'is_published' => (bool) $this->is_published,
            'client_image_url' => 'https://admin.bdicofficial.com'.$this->client_image_url,
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
