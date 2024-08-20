<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class TextInput extends Component
{
    public string $name;

    public string $title;

    public string $placeholder;

    public string $type;

    public string $value;

    /**
     * Create a new component instance.
     *
     * @param  string  $name
     * @param  string  $title
     * @param  string|null  $placeholder
     * @param  string  $type
     * @param  string  $value
     * @return void
     */
    public function __construct($name, $title, $placeholder = null, $type = 'text', $value = '')
    {
        $this->name = $name;
        $this->title = $title;
        $this->placeholder = $placeholder;
        $this->type = $type;
        $this->value = $value;
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
