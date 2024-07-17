<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilmFormRequest;
use App\Http\Requests\SearchFormRequest;
use App\Http\Resources\FilmResource;
use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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
        /*$query = Film::query();
        #dd($request->input('titre'));
        if ($request->has('titre'))
        {
            $query = $query->where('titre', 'like', "%{$request->input('titre')}%");
        }*/
        $films = Film::orderBy('created_at', 'desc')->paginate(22);
        //dd(asset('storage/'));
            return response()->json([
                'error' => false,
                'message' => "Votre requête a bien réussie",
                'storage' => asset('storage'),
               # 'queries' => $query,
                #'input'=>$request->validated(),
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
    public function store(Request $request)
    {
        #dd($request->all());

        $data = $request->all();
        $data['affiche'] = $request->affiche->store('uploads');
        $data['film'] = $request->film->store('films/uploads');
        //dd($data);
        $film = Film::create($data);
        //dd($film);

        return response()->json([
            'error' => false,
            'message' => 'Votre film est bien ajouté avec succés',
            $film,
            'affiche_url' => asset('storage/' . $data['affiche']),
            'film_url' => asset('storage/' . $data['film'])
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
    public function update(Request $request, Film $film)
    {
        $data = $request->all();
        if ($request->hasFile('film')) {
            // Supprimer l'ancien fichier si nécessaire
            if ($film->film && Storage::exists($film->film)) {
                Storage::delete($film->film);
            }
            $data['film'] = $request->file('film')->store('film/uploads');
        } else {
            // Conserver l'ancien chemin de fichier
            $data['film'] = $film->film;
        }

        if ($request->hasFile('affiche')) {
            // Supprimer l'ancienne affiche si nécessaire
            if ($film->affiche && Storage::exists($film->affiche)) {
                Storage::delete($film->affiche);
            }
            $data['affiche'] = $request->file('affiche')->store('uploads');
        } else {
            // Conserver l'ancien chemin de l'affiche
            $data['affiche'] = $film->affiche;
        }


        //dd($data);
        $film = $film->update($data);
        return \response()->json(
            [
                'error' => false,
                'message' => 'Votre film est modifié avec succés',
                $film
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
