<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="/assets/addIncome.css">
  <!-- serif font - logo -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&display=swap" rel="stylesheet">
  <!-- sans font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Source+Sans+3:ital,wght@0,200..900;1,200..900&display=swap"
    rel="stylesheet">

  <title>Edit Income Page</title>
</head>

<body>
  <main>

    <nav class="navbar navbar-expand-md " aria-label="navbar">
      <div class="container-fluid main-navbar align-items-start ">
        <div class="navbar-brand col-4 px-5 d-flex">
          <a class="navbar-brand" id="logo" href="/welcome"><img class="coin" src="/assets/img/piggy-bank.svg"
              alt="coin icon">
            MyFinances</a>
          <button class="navbar-toggler" id="menubtn" type="button" data-bs-toggle="collapse"
            data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>

        <div class="col-8 ">

          <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="d-grid gap-2 d-flex navigation ">
              <li class="nav-item">
                <a role="button" href="/welcome" class="btn btn-outline-secondary home px-3 "><img
                    src="/assets/img/house-fill.svg" alt="house icon">Strona Główna</a>
              </li>
              <li class="nav-item">
                <a role="button" href="/addIncome" class="btn btn-outline-secondary px-3"><img
                    src="/assets/img/coin.svg" alt="coin icon">Dodaj
                  Przychód</a>
              </li>
              <li class="nav-item">
                <a role="button" href="/addExpense" class="btn btn-outline-secondary px-3"><img
                    src="/assets/img/cart-plus.svg" alt="cart icon">Dodaj Wydatek</a>
              </li>
              <li class="nav-item">
                <a role="button" href="/balance" class="btn btn-outline-secondary px-3"><img
                    src="/assets/img/clipboard-data.svg" alt="clipbord icon">Przeglądaj Bilans</a>
              </li>
              <li class="nav-item">
                <a role="button" href="/settings" class="btn btn-outline-secondary px-3"><img src="/assets/img/tools.svg"
                    alt="tools icon">Ustawienia</a>
              </li>
              <li class="nav-item">
                <a role="button" href="/logout" class="btn btn-outline-secondary logout px-3"><img
                    src="/assets/img/box-arrow-right.svg" alt="logout icon">Wyloguj</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>

    <article>


      <div>
        <div id="site">
          <div class="container text-panel">
            <div class="row ">
              <div class="col registration text-center ">
                <h1 class="h4 mt-2 fw-normal">Aktualizuj Dane Przychodu</h1>
              </div>
            </div>

            <form method="POST">
              <?php include $this->resolve('partials/_csrf.php'); ?>
              <div class="row justify-content-center ">
                <div class="col-9 pt-4">
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="amount"><img src="/assets/img/coin.svg" alt="coin icon"></span>
                    <input value="<?php echo e($income['amount'] ?? '') ?>" type="text" class="form-control input-place" placeholder="Kwota" aria-label="Kwota"
                      name="income_amount">
                  </div>
                </div>
              </div>
              <?php if (array_key_exists('income_amount', $errors)) : ?>
                <div class="col errors text-center ">
                  <p style="color:red">
                    <?php echo e($errors['income_amount'][0]); ?>
                  </p>
                </div>
              <?php endif; ?>
              <div class="row justify-content-center">
                <div class="col-9">
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="income-date"><img src="/assets/img/calendar-event.svg"
                        alt="calendar icon"></span>
                    <input value="<?php echo e($income['formatted_date'] ?? date("Y-m-d")) ?>" type="date" id="date" class="form-control input-place" aria-label="date" name="income_date">
                  </div>
                </div>
              </div>
              <?php if (array_key_exists('income_date', $errors)) : ?>
                <div class="col errors text-center ">
                  <p style="color:red">
                    <?php echo e($errors['income_date'][0]); ?>
                  </p>
                </div>
              <?php endif; ?>
              <div class="row justify-content-center">
                <div class="col-9 ">
                  <div class="input-group mb-3 flex-nowrap">
                    <div class="input-group-prepend">
                      <label class="input-group-text" for="income-category"><img src="/assets/img/book-half.svg"
                          alt="book icon"></label>
                    </div>
                    <select class="custom-select " id="income-category" name="income_category">
                      <option selected><?php echo e($income['name'] ?? '')  ?></option>
                      <?php foreach ($incomesCategories as $category) : ?>

                        <option value="<?php echo e($category['category_name']); ?>"><?php echo e($category['category_name']); ?></option>

                      <?php endforeach; ?>

                    </select>
                  </div>
                </div>
              </div>
              <?php if (array_key_exists('income_category', $errors)) : ?>
                <div class="col errors text-center ">
                  <p style="color:red">
                    <?php echo e($errors['income_category'][0]); ?>
                  </p>
                </div>
              <?php endif; ?>
              <div class="row justify-content-center">
                <div class="col-9 ">
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="coment"><img src="/assets/img/pencil.svg" alt="pencil icon"></span>
                    <input value="<?php echo e($income['income_comment'] ?? '') ?>" type="text" class="form-control input-place" placeholder="Komentarz (opcjonalnie)"
                      aria-label="Komentarz" name="income_comment">
                  </div>
                </div>
              </div>
              <?php if (array_key_exists('income_comment', $errors)) : ?>
                <div class="col errors text-center ">
                  <p style="color:red">
                    <?php echo e($errors['income_comment'][0]); ?>
                  </p>
                </div>
              <?php endif; ?>
              <div class="row">
                <div class="col-3"></div>
                <div class="col-3 pb-3 text-center">
                  <button type="submit" class="btn btn-primary"
                    style="--bs-btn-padding-y: 0.15rem; --bs-btn-padding-x: 2rem; --bs-btn-font-size: 1rem;">Aktualizuj
                  </button>
                </div>
            </form>
            <div class="col-3 pb-3 text-center">
              <button role="button" href="/balance" class="btn btn-primary" id="cancelbtn" 
                style="--bs-btn-padding-y: 0.15rem; --bs-btn-padding-x: 2rem; --bs-btn-font-size: 1rem;">Anuluj
              </button>
            </div>


            <div class="col-3"></div>
          </div>
        </div>
      </div>
      </div>

    </article>

  </main>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

</body>

</html>