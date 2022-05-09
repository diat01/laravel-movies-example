<?php

namespace App\View\Components\Admin\Buttons;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Delete extends Component
{
    public string $route;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $route)
    {
        $this->route = $route;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('admin.components.buttons.delete');
    }
}
