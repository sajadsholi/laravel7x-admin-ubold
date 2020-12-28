<?php

namespace App\View\Components;

use Illuminate\View\Component;

class selectLanguage extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $translation;
    public $redirect;

    public function __construct($translation, $redirect)
    {
        $this->translation = $translation->pluck('locale')->toArray();
        $this->redirect = $redirect;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.select-language');
    }
}
