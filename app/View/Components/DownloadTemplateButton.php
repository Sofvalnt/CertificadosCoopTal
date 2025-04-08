<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DownloadTemplateButton extends Component
{
    public $url;
    
    public function __construct($url = '/ruta/por/defecto')
    {
        $this->url = $url;
    }

    public function render()
    {
        return view('components.download-template-button');
    }
}