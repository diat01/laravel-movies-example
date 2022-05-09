<?php

namespace App\ViewModels;

use App\Movie;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Spatie\ViewModels\ViewModel;

class MovieViewModel extends ViewModel
{
    public Movie $movie;

    public function __construct(Movie $movie)
    {
        $this->movie = $movie->load('casts', 'media');
    }

    public function movie(): Collection
    {
        return collect([
            'poster_path'  => $this->movie->getFirstMediaUrl('posters'),
            'title'        => $this->movie->title,
            'overview'     => $this->movie->overview,
            'vote_average' => $this->movie->vote_average * 10 . '%',
            'release_date' => Carbon::parse($this->movie->release_date)->format('M d, Y'),
            'genres'       => collect($this->movie->genres)->pluck('name')->flatten()->implode(', '),
            'images'       => $this->movie->getMedia('backdrops')->map(fn($backdrop) => $backdrop->getUrl()),
            'cast'         => $this->movie->casts->map(fn($cast) => [
                'profile_path' => $cast->actor->getFirstMedia('profile')
                    ? $cast->actor->getFirstMediaUrl('profile')
                    : asset('img/placeholder.jpg'),
                'character'    => $cast->character
            ])
        ]);
    }
}
