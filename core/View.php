<?php
namespace Core;

final class View
{
    public function render(string $view, array $data = []): void
    {
        extract($data, EXTR_SKIP);

        ob_start();
        $viewPath = __DIR__ . "/../app/views/" . str_replace('.', '/', $view) . ".php";
        if (!is_file($viewPath)) { http_response_code(500); exit("View $view not found"); }
        require $viewPath;
        $content = ob_get_clean();

        $layoutPath = __DIR__ . "/../app/views/layout.php";
        if (is_file($layoutPath)) {
            require $layoutPath;
        } else {
            echo $content;
        }
    }
}
