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
    public $disabled;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label, $name, $type = 'text', $placeholder = '', $value = '', $disabled = false)
    {
        $this->label = $label;
        $this->name = $name;
        $this->type = $type;
        $this->placeholder = $placeholder;
        $this->value = $value;
        $this->disabled = $disabled;
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
