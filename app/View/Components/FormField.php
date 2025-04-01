<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormField extends Component
{
    public $label;
    public $name;
    public $type;
    public $value;
    public $options;

    /**
     * Create a new component instance.
     *
     * @param string $label
     * @param string $name
     * @param string $type
     * @param mixed $value
     * @param array|null $options
     */
    public function __construct($label, $name, $type = 'text', $value = null, $options = null)
    {
        $this->label = $label;
        $this->name = $name;
        $this->type = $type;
        $this->value = $value;
        $this->options = $options;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.form-field');
    }
}
