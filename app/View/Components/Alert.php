<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Alert extends Component
{

    public $type;
    public $message;
    /**
     * Create a new component instance.
     */
    public function __construct($type = null, $message = null)
{
    $this->message = $message ?? session('success') ?? session('error');
    
    // Detectar el tipo automáticamente
    if ($type) {
        $this->type = $type;
    } else if (session('success')) {
        $this->type = 'success';
    } else if (session('error')) {
        $this->type = 'error';
    } else {
        $this->type = null;
    }
}

    /**
     * Get the view / contents that represent the component.
     */
   public function render(): View|Closure|string
{
    // No renderizar si no hay mensaje
    if (!$this->message) {
        return '';
    }
    
    return view('components.alert');
}
}
