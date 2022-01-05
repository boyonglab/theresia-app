<?php
namespace Boyonglab\Theresia\Core;

use Boyonglab\Theresia\Core\Interfaces\IConfig;

class Config implements IConfig {
    protected $viewPath = 'view';

    public function getViewPath()
    {
        return $this->viewPath;
    }
}
