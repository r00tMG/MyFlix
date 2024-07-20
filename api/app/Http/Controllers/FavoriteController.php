<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFavoriteRequest;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        //var_dump('SAlut');
        #$favorites = DB::table('favorites')->where('user_id', Auth::id())->with('film_id')->get();

        $favorites = Favorite::where('user_id', Auth::id())->with('film')->get();
        //dd($favorites);
        return response()->json([
            'error' => false,
            'message' => "Votre requete a réussie avec succés",
            $favorites
        ],
            Response::HTTP_OK
        );
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFavoriteRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        #dd($request->film_id);
        //dd(Auth::id());
        $favorite = Favorite::create([
            'user_id' => Auth::id(),
            'film_id' => $request->film_id
        ]);
        #dd($favorite);

        return response()->json([
            'error' => false,
            'message' => "Votre film favorie a été ajouté",
            $favorite
        ], Response::HTTP_CREATED);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Favorite  $favorite
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $favorite = Favorite::find($id);
        //dd($favorite);
        if($favorite)
        {
            $favorite->delete();
            return response()->json(null, 204);

        }
        return response()->json([
            'error' => 'favorite n\'existe pas'
        ],204);
    }
}
