<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Form extends Component
{
    public $action;
    public $method;
    public $submitText;

    public function __construct($action, $method = 'POST', $submitText = 'Submit')
    {
        $this->action = $action;
        $this->method = $method;
        $this->submitText = $submitText;
    }

    public function render()
    {
        return view('components.form');
    }
}
