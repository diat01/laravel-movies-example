<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Spatie\ViewModels\ViewModel;

class TvViewModel extends ViewModel
{
    public array $popularTv;
    public array $topRatedTv;
    public array $genres;

    public function __construct(array $popularTv, array $topRatedTv, array $genres)
    {
        $this->popularTv = $popularTv;
        $this->topRatedTv = $topRatedTv;
        $this->genres = $genres;
    }

    public function popularTv(): Collection
    {
        return $this->formatTv($this->popularTv);
    }

    private function formatTv($tv): Collection
    {
        return collect($tv)->map(function ($tvshow) {
            $genresFormatted = collect($tvshow['genre_ids'])
                ->mapWithKeys(fn($value) => [$value => $this->genres()->get($value)])->implode(', ');

            return collect($tvshow)->merge([
                'poster_path'    => 'https://image.tmdb.org/t/p/w500/' . $tvshow['poster_path'],
                'vote_average'   => $tvshow['vote_average'] * 10 . '%',
                'first_air_date' => Carbon::parse($tvshow['first_air_date'])->format('M d, Y'),
                'genres'         => $genresFormatted,
            ])->only([
                'poster_path', 'id', 'genre_ids', 'name', 'vote_average', 'overview', 'first_air_date', 'genres',
            ]);
        });
    }

    public function genres(): Collection
    {
        return collect($this->genres)->mapWithKeys(fn($genre) => [$genre['id'] => $genre['name']]);
    }

    public function topRatedTv(): Collection
    {
        return $this->formatTv($this->topRatedTv);
    }
}
