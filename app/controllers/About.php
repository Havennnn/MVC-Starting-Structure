<?php
namespace App\Controllers;

use Core\Controller;

class About extends Controller
{
    public function index(): void
    {
        $this->render('about/index', [
            'title' => 'About Us'
        ]);
    }
}
