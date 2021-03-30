<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
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
            'title' => $this->title,
            'contents' => $this->contents,
            //mappa l'autore nella risorsa
            'author' => new UserResource ($this->author),
            'category'=> new CategoryResource($this->category),
            'created_at' => $this->created_at
        ];
    }
}



// DTO -> Resource , mappare una entità(modello)



