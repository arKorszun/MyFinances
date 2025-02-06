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

  $app->get('/edit/editIncomeCategory', [SettingsController::class, 'editIncomeCategory'])->add(AuthRequiredMiddleware::class);
  $app->get('/edit/editExpenseCategory', [SettingsController::class, 'editExpenseCategory'])->add(AuthRequiredMiddleware::class);
  $app->get('/edit/editPaymentMethod', [SettingsController::class, 'editPaymentMethod'])->add(AuthRequiredMiddleware::class);

  $app->get('/add/addIncomeCategory', [SettingsController::class, 'addIncomeCategory'])->add(AuthRequiredMiddleware::class);
  $app->get('/add/addExpenseCategory', [SettingsController::class, 'addExpenseCategory'])->add(AuthRequiredMiddleware::class);
  $app->get('/add/addPaymentMethod', [SettingsController::class, 'addPaymentMethod'])->add(AuthRequiredMiddleware::class); 

  $app->get('/delete/deleteIncomeCategory', [SettingsController::class, 'deleteIncomeCategory'])->add(AuthRequiredMiddleware::class);
  $app->get('/delete/deleteExpenseCategory', [SettingsController::class, 'deleteExpenseCategory'])->add(AuthRequiredMiddleware::class);
  $app->get('/delete/deletePaymentMethod', [SettingsController::class, 'deletePaymentMethod'])->add(AuthRequiredMiddleware::class); 
  
  $app->get('/editUserData', [SettingsController::class, 'editUserDataView'])->add(AuthRequiredMiddleware::class);
  $app->post('/editUserData', [SettingsController::class, 'editUserData'])->add(AuthRequiredMiddleware::class);

  $app->get('/delete/deleteUser', [SettingsController::class, 'deleteAllUserData'])->add(AuthRequiredMiddleware::class);

  $app->get('/income/{income}', [TransactionController::class, 'editIncomeView'])->add(AuthRequiredMiddleware::class);
  $app->get('/expense/{expense}', [TransactionController::class, 'editExpenseView'])->add(AuthRequiredMiddleware::class);
  $app->post('/income/{income}', [TransactionController::class, 'editIncome'])->add(AuthRequiredMiddleware::class);
  $app->post('/expense/{expense}', [TransactionController::class, 'editExpense'])->add(AuthRequiredMiddleware::class);
  $app->delete('/income/{income}', [TransactionController::class, 'deleteIncome'])->add(AuthRequiredMiddleware::class);
  $app->delete('/expense/{expense}', [TransactionController::class, 'deleteExpense'])->add(AuthRequiredMiddleware::class);

  
}
