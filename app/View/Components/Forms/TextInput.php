<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class TextInput extends Component
{
    public string $name;

    public string $title;

    public ?string $placeholder;

    public string $type;

    public ?string $value;

    public bool $readonly;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $name, string $title, ?string $placeholder = null, string $type = 'text', ?string $value = '', bool $readonly = false)
    {
        $this->name = $name;
        $this->title = $title;
        $this->placeholder = $placeholder;
        $this->type = $type;
        $this->value = $value;
        $this->readonly = $readonly;
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
