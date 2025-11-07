<?php
namespace Core;

final class View
{
    public function render(string $view, array $data = []): void
    {
        extract($data, EXTR_SKIP);
        $path = __DIR__ . "/../app/views/" . str_replace('.', '/', $view) . ".php";
        if (!is_file($path)) { http_response_code(500); exit("View $view not found"); }
        require $path;
    }
}
