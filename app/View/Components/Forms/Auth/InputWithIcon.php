<?php

namespace App\View\Components\Forms\Auth;

use Illuminate\View\Component;

class InputWithIcon extends Component
{
    public string $label;

    public string $name;

    public string $type;

    public string $placeholder;

    public ?string $value;

    public string $autocomplete;

    public bool $autofocus;

    public bool $readonly;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $label, string $name, string $type = 'text', string $placeholder = '', ?string $value = '', string $autocomplete = '', bool $autofocus = false, bool $readonly = false)
    {
        $this->label = $label;
        $this->name = $name;
        $this->type = $type;
        $this->placeholder = $placeholder;
        $this->value = $value;
        $this->autocomplete = $autocomplete;
        $this->autofocus = $autofocus;
        $this->readonly = $readonly;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    #[\Override]
    public function render()
    {
        return view('components.forms.auth.input-with-icon');
    }
}
