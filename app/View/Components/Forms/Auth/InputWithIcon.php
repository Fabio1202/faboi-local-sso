<?php

namespace App\View\Components\Forms\Auth;

use Illuminate\View\Component;

class InputWithIcon extends Component
{
    public $label;
    public $name;
    public $type;
    public $placeholder;
    public $value;
    public $autocomplete;
    public $autofocus;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label, $name, $type = 'text', $placeholder = '', $value = '', $autocomplete = '', $autofocus = false)
    {
        $this->label = $label;
        $this->name = $name;
        $this->type = $type;
        $this->placeholder = $placeholder;
        $this->value = $value;
        $this->autocomplete = $autocomplete;
        $this->autofocus = $autofocus;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.auth.input-with-icon');
    }
}
