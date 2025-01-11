<?php

declare(strict_types=1);

namespace App\Config;

use Framework\App;
use App\Controllers\{HomeController, AuthController};
use App\Middleware\{AuthRequiredMiddleware, GuestOnlyMiddleware};

function registerRoutes(App $app)
{

  $app->get('/', [HomeController::class, 'home'])->add(GuestOnlyMiddleware::class);
  $app->get('/registration', [AuthController::class, 'registration'])->add(GuestOnlyMiddleware::class);
  $app->post('/registration', [AuthController::class, 'register'])->add(GuestOnlyMiddleware::class);
  $app->get('/login', [AuthController::class, 'loginView'])->add(GuestOnlyMiddleware::class);
  $app->post('/login', [AuthController::class, 'login'])->add(GuestOnlyMiddleware::class);
  $app->get('/welcome', [HomeController::class, 'welcome'])->add(AuthRequiredMiddleware::class);
  $app->get('/logout', [AuthController::class, 'logout'])->add(AuthRequiredMiddleware::class);
}
