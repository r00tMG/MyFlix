<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RatingController extends Controller
{
    public function index($filmId)
    {
        $ratings = Rating::where('film_id', $filmId)->with('user')->get();
        return response()->json([
            'error' => true,
            'message' => "Requête réussie",
            $ratings
        ], Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        //var_dump('salut');
        /*$request->validate([
            'film_id' => 'required|exists:films,id',
            'rating' => 'required|integer|min=1|max=5',
            'comment' => 'nullable|string',
        ]);
        dd($request->input());*/

        $rating = Rating::create([
            'user_id' => Auth::id(),
            'film_id' => $request->film_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);
        //dd($rating);
        return response()->json([
            'error' => false,
            'message' => "Votre a bien été ajouté",
            $rating
        ], Response::HTTP_CREATED);
    }

    public function update(Request $request, Rating $rating)
    {
        //$this->authorize('update', $rating);

        $request->validate([
            'rating' => 'required|integer|min=1|max=5',
            'comment' => 'nullable|string',
        ]);

        $rating->update($request->all());

        return response()->json($rating);
    }

    public function destroy(Rating $rating)
    {
        //$this->authorize('delete', $rating);

        $rating->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
