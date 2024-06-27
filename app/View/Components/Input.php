<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Input extends Component
{
    public $type;
    public $name;
    public $value;
    public $placeholder;

    /**
     * Create a new component instance.
     *
     * @param string $type
     * @param string $name
     * @param mixed $value
     * @param string|null $placeholder
     */
    public function __construct($type = 'text', $name, $value = null, $placeholder = null)
    {
        $this->type = $type;
        $this->name = $name;
        $this->value = $value;
        $this->placeholder = $placeholder;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.input');
    }
}
