<?php
namespace Boyonglab\Theresia\Core\Interfaces\View;

interface IRenderer{
    public function html($filePath, $params=[]);
}
