<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class TextAreaInput extends Component
{
    public string $name;

    public string $title;

    public string $placeholder;

    public bool $preventNewLines = false;

    public string|null $value;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $name, string $title, ?string $placeholder = null, bool $preventNewLines = false, string|null $value = '')
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
