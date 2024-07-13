<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilmFormRequest;
use App\Http\Resources\FilmResource;
use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $films = Film::orderBy('created_at', 'desc')->paginate(22);
            return response()->json([
                'error' => false,
                'message' => "Votre requête a bien réussie",
                'films' => FilmResource::collection(
                   $films
                )
            ],
                Response::HTTP_OK
            );


    }


    /**
     * Store a newly created resource in storage.
     *
     * @param FilmFormRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(FilmFormRequest $request)
    {
        if(!$request->validated())
        {
            return response()->json([
               'error' => true,
                'message' => 'Votre requête a échoué',
            ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
        $data = $request->validated();
        $data['affiche'] = $request->affiche->store('uploads');
        $film = Film::create($data);

        return response()->json([
            'error' => false,
            'message' => 'Votre film est bien ajouté avec succés',
            $film
        ],
            Response::HTTP_CREATED
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  Film  $film
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Film $film)
    {
        #dd($film,Response::HTTP_NO_CONTENT);
        return \response()->json([
            'error' => false,
            'message' => "Votre requête a bien réussie",
            $film
        ],
            Response::HTTP_OK
        );
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Film  $film
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(FilmFormRequest $request, Film $film)
    {
        if (!$request->validated())
        {
            return \response()->json([
                'error'=> true,
                'message' => 'Votre requête a échoué'
            ]);
        }
        return \response()->json(
            [
                'error' => false,
                'message' => 'Votre film est modifié avec succés',
                $film->update($request->validated()),
            ],
            Response::HTTP_CREATED
        ) ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        DB::table('favorites')->where('film_id', $id)->delete();
        DB::table('films')->where('id', $id)->delete();
        return response()->json(
            [
                'error' => false,
                'message' => 'Le film a bien été supprimé',
            ],
            Response::HTTP_NO_CONTENT
        );
    }
}
