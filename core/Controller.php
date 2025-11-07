<?php
namespace Core;

abstract class Controller
{
    protected View $view;

    public function __construct(protected array $config = [])
    {
        $this->view = new View();
    }

    protected function model(string $name)
    {
        $class = "App\\Models\\$name";
        $file  = __DIR__ . "/../app/models/$name.php";
        if (is_file($file)) { require_once $file; return new $class($this->config); }
        throw new \RuntimeException("Model $name not found");
    }

    protected function render(string $view, array $data = []): void
    {
        $this->view->render($view, $data);
    }

    protected function redirect(string $path): void
    {
        header("Location: /$path"); exit;
    }
}
