<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class TextInput extends Component
{

    public $name;
    public $title;
    public $placeholder;

    public $type;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $title, $placeholder = null, $type = 'text')
    {
        $this->name = $name;
        $this->title = $title;
        $this->placeholder = $placeholder;
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.text-input');
    }
}
