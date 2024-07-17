<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilmFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        /*$table->string('titre');
        $table->string('genre');
        $table->text('description')->nullable();
        $table->string('realisateur');
        $table->date('date_de_sortie');
        $table->integer('duree');
        $table->string('affiche')->nullable();*/
        return [
            'titre' => ['required','string','min:3'],
            'genre' => ['required','string','min:3'],
            'description' => ['required','string','min:3'],
            'realisateur' => ['required','string','min:3'],
            'date_de_sortie' => ['required','string'],
            'duree' => ['required','string'],
            'film' => ['require','string'],
            'affiche' => ['required','string','min:3'],



        ];
    }
}
