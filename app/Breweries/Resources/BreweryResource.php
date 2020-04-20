<?php

namespace App\Breweries\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BreweryResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->brewery_type,
            'address' => [
                'street' => $this->street,
                'city' => $this->city,
                'state' => $this->state,
                'postcode' => $this->postal_code,
                'country' => $this->country,
            ]
        ];
    }
}
