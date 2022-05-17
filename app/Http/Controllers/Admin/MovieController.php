<?php

namespace App\Http\Controllers\Admin;

use App\Actor;
use App\Genre;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMovieRequest;
use App\Movie;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreMovieRequest $request
     * @return RedirectResponse|void
     */
    public function store(StoreMovieRequest $request)
    {
        $tmdb_id = $request->get('tmdb_id');

        if (Movie::whereId($tmdb_id)->exists()) {
            return back();
        }

        try {
            $movieResponse = $this->client()->get("movie/{$tmdb_id}", [
                'append_to_response' => 'images,casts'
            ]);

            if ($movieResponse->failed()) {
                $movieResponse->throw();
            }

            $movieResponse->json();

            $movie = Movie::create([
                'id'           => $movieResponse['id'],
                'title'        => $movieResponse['title'],
                'release_date' => $movieResponse['release_date'],
                'vote_average' => $movieResponse['vote_average'],
                'overview'     => $movieResponse['overview']
            ]);

            foreach ($movieResponse['genres'] as $genre) {
                $genreModel = Genre::firstOrCreate(
                    ['id' => $genre['id']],
                    ['name' => $genre['name']]
                );

                $movie->genres()->attach($genreModel);
            }

            $actors = collect($movieResponse['casts']['cast'])->take(5)->toArray();

            foreach ($actors as $actor) {

                if (Actor::whereId($actor['id'])->exists()) {
                    $movie->casts()->create([
                        'actor_id'  => $actor['id'],
                        'character' => $actor['character']
                    ]);

                    continue;
                }

                $actorModel = Actor::create([
                    'id'     => $actor['id'],
                    'name'   => $actor['name'],
                    'gender' => $actor['gender']
                ]);

                if (!is_null($actor['profile_path'])) {
                    $profileUrl = "https://image.tmdb.org/t/p/w500{$actor['profile_path']}";
                    $actorModel->addMediaFromUrl($profileUrl)->toMediaCollection('profile');
                }

                $movie->casts()->create([
                    'actor_id'  => $actor['id'],
                    'character' => $actor['character']
                ]);
            }

            $posterUrl = "https://image.tmdb.org/t/p/w500{$movieResponse['poster_path']}";
            $movie->addMediaFromUrl($posterUrl)->toMediaCollection('posters');

            $backdrops = collect($movieResponse['images']['backdrops'])->take(9)->toArray();

            foreach ($backdrops as $backdrop) {
                $backdropPath = "https://image.tmdb.org/t/p/w500{$backdrop['file_path']}";
                $movie->addMediaFromUrl($backdropPath)->toMediaCollection('backdrops');
            }

            return back();
        } catch (Exception $e) {
            dd($e);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Movie $movie
     * @return Response
     */
    public function show(Movie $movie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Movie $movie
     * @return Application|Factory|View
     */
    public function edit(Movie $movie)
    {
        return view('admin.movies.edit', compact('movie'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Movie $movie
     * @return RedirectResponse
     */
    public function update(Request $request, Movie $movie)
    {
        $validated = $request->validate([
            'title'    => 'required|string',
            'overview' => 'required|string'
        ]);

        $movie->update($validated);

        return redirect()->route('admin.dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Movie $movie
     * @return RedirectResponse
     */
    public function destroy(Movie $movie)
    {
        $movie->delete();

        return back();
    }
}
