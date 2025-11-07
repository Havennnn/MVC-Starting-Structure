<?php
namespace App\Controllers;

use Core\Controller;

class Home extends Controller
{
    public function index(): void
    {
        $this->render('home/index');
    }
}
