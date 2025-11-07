<?php
namespace Core;

final class App
{
    private string $controller;
    private string $action;
    private array $params = [];
    private array $config;

    public function __construct()
    {
        $this->config     = require __DIR__ . '/../system/config.php';
        $this->controller = $this->config['app']['default_controller'] ?? 'Home';
        $this->action     = $this->config['app']['default_action']     ?? 'index';
    }

    private function parseUrl(): void
    {
        $path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?? '/';

        $base = rtrim(dirname($_SERVER['SCRIPT_NAME'] ?? ''), '/');
        if ($base && $base !== '/') {
            $path = preg_replace('#^' . preg_quote($base, '#') . '#', '', $path);
        }

        $path = trim($path, '/');
        if ($path === '' || $path === 'index.php') {

            $this->params = [];
            return;
        }

        $parts = explode('/', $path);

        $this->controller = $this->studly($parts[0]) ?: ($this->config['app']['default_controller'] ?? 'Home');

        $this->action = $parts[1] ?? ($this->config['app']['default_action'] ?? 'index');

        $this->params = array_slice($parts, 2);
    }

    private function studly(string $name): string
    {
        $name = str_replace(['-', '_'], ' ', strtolower($name));
        return str_replace(' ', '', ucwords($name));
    }

    public function run(): void
    {
        $this->parseUrl();

        $controllerClass = "App\\Controllers\\{$this->controller}";
        $controllerFile  = __DIR__ . "/../app/controllers/{$this->controller}.php";

        if (!is_file($controllerFile)) { http_response_code(404); exit('Controller not found'); }
        require_once $controllerFile;

        if (!class_exists($controllerClass)) { http_response_code(500); exit('Controller class missing'); }

        $controller = new $controllerClass($this->config);

        if (!method_exists($controller, $this->action)) { http_response_code(404); exit('Action not found'); }

        call_user_func_array([$controller, $this->action], $this->params);
    }
}
