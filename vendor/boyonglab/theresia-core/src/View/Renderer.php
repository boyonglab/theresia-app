<?php
namespace Boyonglab\Theresia\Core\View;

use Boyonglab\Theresia\Core\Interfaces\View\IRenderer;
class Renderer implements IRenderer {

    public function html($temp, $params=[])
    {

        $filename = BASE_PATH . '/views/' . $temp . '.php';
        if (file_exists($filename)) {
            extract($params);
            ob_start();
            include($filename);
            $content = ob_get_contents();
            ob_end_clean();

            return $content;
        }else {
            return $filename . ' not found.';
        }

    }
}
