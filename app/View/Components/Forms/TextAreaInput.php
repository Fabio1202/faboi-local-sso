<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class TextAreaInput extends Component
{
    public $name;

    public $title;

    public $placeholder;

    public $preventNewLines = false;

    public $value;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $title, $placeholder = null, $preventNewLines = false, $value = '')
    {
        $this->name = $name;
        $this->title = $title;
        $this->placeholder = $placeholder;
        $this->preventNewLines = $preventNewLines;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.text-area-input');
    }
}
