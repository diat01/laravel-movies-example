<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class TvCard extends Component
{
    public object $tvshow;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(object $tvshow)
    {
        $this->tvshow = $tvshow;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('components.tv-card');
    }
}
