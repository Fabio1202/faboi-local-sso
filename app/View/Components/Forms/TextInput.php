<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class TextInput extends Component
{
    public string $name;

    public string $title;

    public string|null $placeholder;

    public string $type;

    public string|null $value;

    public bool $readonly;

    /**
     * Create a new component instance.
     *
     * @param string $name
     * @param string $title
     * @param string|null $placeholder
     * @param string $type
     * @param string|null $value
     * @param bool $readonly
     * @return void
     */
    public function __construct(string $name, string $title, string $placeholder = null, string $type = 'text', ?string $value = "", bool $readonly = false)
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
