<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'book_title' => $this->title,
            //'authored by' => $this->firstname . " " . $this->lastname,
            'authored by' => new AuthorResource($this->author),
        ];
    }
}
