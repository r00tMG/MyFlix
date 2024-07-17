<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FilmResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        /*$table->string('titre');
        $table->string('genre');
        $table->text('description')->nullable();
        $table->string('realisateur');
        $table->date('date_de_sortie');
        $table->integer('duree');
        $table->string('affiche')->nullable();*/
        return [
            'id' => $this->resource->id,
            'titre' => $this->resource->titre,
            'genre' => $this->resource->genre,
            'description' => $this->resource->description,
            'realisateur' => $this->resource->realisateur,
            'date_de_sortie' => $this->resource->date_de_sortie,
            'duree' => $this->resource->duree,
            'affiche' => $this->resource->affiche,
            'film' => $this->resource->film,
            'storage'=>asset('storage')


        ];
    }
}
