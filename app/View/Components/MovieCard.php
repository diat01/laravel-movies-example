<?php

namespace App\View\Components;

use App\Movie;
use Illuminate\View\Component;
use Illuminate\View\View;

class MovieCard extends Component
{
    public Movie $movie;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Movie $movie)
    {
        $this->movie = $movie;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('components.movie-card');
    }
}
