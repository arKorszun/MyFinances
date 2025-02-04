<?php

declare(strict_types=1);

namespace App\Config;

use Framework\App;
use App\Controllers\{
  HomeController,
  AuthController,
  TransactionController,
  SettingsController
};
use App\Middleware\{
  AuthRequiredMiddleware,
  GuestOnlyMiddleware
};

function registerRoutes(App $app)
{

  $app->get('/', [HomeController::class, 'home'])->add(GuestOnlyMiddleware::class);

  $app->get('/registration', [AuthController::class, 'registration'])->add(GuestOnlyMiddleware::class);
  $app->post('/registration', [AuthController::class, 'register'])->add(GuestOnlyMiddleware::class);

  $app->get('/login', [AuthController::class, 'loginView'])->add(GuestOnlyMiddleware::class);
  $app->post('/login', [AuthController::class, 'login'])->add(GuestOnlyMiddleware::class);

  $app->get('/welcome', [HomeController::class, 'welcome'])->add(AuthRequiredMiddleware::class);
  $app->get('/logout', [AuthController::class, 'logout'])->add(AuthRequiredMiddleware::class);
  
  $app->get('/addExpense', [TransactionController::class, 'addExpenseView'])->add(AuthRequiredMiddleware::class);
  $app->post('/addExpense', [TransactionController::class, 'addExpense'])->add(AuthRequiredMiddleware::class);
  $app->get('/addIncome', [TransactionController::class, 'addIncomeView'])->add(AuthRequiredMiddleware::class);
  $app->post('/addIncome', [TransactionController::class, 'addIncome'])->add(AuthRequiredMiddleware::class);

  $app->get('/balance', [TransactionController::class, 'balanceView'])->add(AuthRequiredMiddleware::class);

  $app->get('/settings', [SettingsController::class, 'settingsView'])->add(AuthRequiredMiddleware::class);
  $app->get('/edit/editIncomeCategory', [SettingsController::class, 'editIncomeCategory']);
  $app->get('/edit/editExpenseCategory', [SettingsController::class, 'editExpenseCategory']);
  $app->get('/edit/editPaymentMethod', [SettingsController::class, 'editPaymentMethod']);

  $app->get('/income/{income}', [TransactionController::class, 'editIncomeView']);
  $app->get('/expense/{expense}', [TransactionController::class, 'editExpenseView']);
  $app->post('/income/{income}', [TransactionController::class, 'editIncome']);
  $app->post('/expense/{expense}', [TransactionController::class, 'editExpense']);
  $app->delete('/income/{income}', [TransactionController::class, 'deleteIncome']);
  $app->delete('/expense/{expense}', [TransactionController::class, 'deleteExpense']);

  
}
