<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Spatie\ViewModels\ViewModel;

class MoviesViewModel extends ViewModel
{
    public array $popularMovies;
    public array $nowPlayingMovies;
    public array $genres;

    public function __construct(array $popularMovies, array $nowPlayingMovies, array $genres)
    {
        $this->popularMovies = $popularMovies;
        $this->nowPlayingMovies = $nowPlayingMovies;
        $this->genres = $genres;
    }

    public function popularMovies(): Collection
    {
        return $this->formatMovies($this->popularMovies);
    }

    private function formatMovies($movies): Collection
    {
        return collect($movies)->map(function ($movie) {
            $genresFormatted = collect($movie['genre_ids'])
                ->mapWithKeys(fn($value) => [$value => $this->genres()->get($value)])->implode(', ');

            return collect($movie)->merge([
                'poster_path'  => 'https://image.tmdb.org/t/p/w500/' . $movie['poster_path'],
                'vote_average' => $movie['vote_average'] * 10 . '%',
                'release_date' => Carbon::parse($movie['release_date'])->format('M d, Y'),
                'genres'       => $genresFormatted,
            ])->only([
                'poster_path', 'id', 'genre_ids', 'title', 'vote_average', 'overview', 'release_date', 'genres',
            ]);
        });
    }

    public function genres(): Collection
    {
        return collect($this->genres)->mapWithKeys(fn($genre) => [$genre['id'] => $genre['name']]);
    }

    public function nowPlayingMovies(): Collection
    {
        return $this->formatMovies($this->nowPlayingMovies);
    }
}
