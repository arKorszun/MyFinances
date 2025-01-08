<?php

declare(strict_types=1);

namespace App\Config;

use Framework\App;
use App\Controllers\{HomeController, AuthController};

function registerRoutes(App $app) {

  $app->get('/', [HomeController::class, 'home']);
  $app->get('/registration', [AuthController::class, 'registration']);
  $app->post('/registration', [AuthController::class, 'register']);
  $app->get('/login', [AuthController::class, 'loginView']);
}