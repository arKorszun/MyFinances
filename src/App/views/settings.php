<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="/assets/settings.css">
  <!-- serif font - logo -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&display=swap" rel="stylesheet">
  <!-- sans font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Source+Sans+3:ital,wght@0,200..900;1,200..900&display=swap"
    rel="stylesheet">

  <title>Settings</title>
</head>

<body>
  <main>

    <nav class="navbar navbar-expand-md " aria-label="navbar">
      <div class="container-fluid main-navbar align-items-start ">
        <div class="navbar-brand col-4 px-5 d-flex">
          <a class="navbar-brand" id="logo" href="/welcome"><img class="coin" src="/assets/img/piggy-bank.svg" alt="coin icon">
            MyFinances</a>
          <button class="navbar-toggler" id="menubtn" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>

        <div class="col-8 ">

          <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="d-grid gap-2 d-flex navigation ">
              <li class="nav-item">
                <a role="button" href="/welcome" class="btn btn-outline-secondary home px-3 "><img src="/assets/img/house-fill.svg"
                    alt="house icon">Strona Główna</a>
              </li>
              <li class="nav-item">
                <a role="button" href="/addIncome" class="btn btn-outline-secondary px-3"><img src="/assets/img/coin.svg" alt="coin icon">Dodaj
                  Przychód</a>
              </li>
              <li class="nav-item">
                <a role="button" href="/addExpense" class="btn btn-outline-secondary px-3"><img src="/assets/img/cart-plus.svg"
                    alt="cart icon">Dodaj Wydatek</a>
              </li>
              <li class="nav-item">
                <a role="button" href="/balance" class="btn btn-outline-secondary px-3"><img src="/assets/img/clipboard-data.svg"
                    alt="clipbord icon">Przeglądaj Bilans</a>
              </li>
              <li class="nav-item">
                <a role="button" href="/settings" class="btn btn-outline-secondary px-3"><img src="/assets/img/tools.svg"
                    alt="tools icon">Ustawienia</a>
              </li>
              <li class="nav-item">
                <a role="button" href="/logout" class="btn btn-outline-secondary logout px-3"><img src="/assets/img/box-arrow-right.svg"
                    alt="logout icon">Wyloguj</a>
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
              <div class="col window-header text-center ">
                <h1 class="h4 mt-2 fw-normal">Ustawienia</h1>
              </div>
            </div>
            <div class="settings">
              <div class="category_edition">
                <div class="row mb-1 mt-3 text-center">
                  <h6>Edytuj kategorie</h6>
                </div>
                <div class="row mb-2 text-center">
                  <div class="col-4 d-grid gap-2">
                    <button class="btn btn-success" type="button">Przychody</button>
                  </div>
                  <div class="col-4 d-grid gap-2">
                    <button class="btn btn-warning" type="button">Wydatki</button>
                  </div>
                  <div class="col-4 d-grid gap-2">
                    <button class="btn btn-primary" type="button">Metody płatności</button>
                  </div>
                </div>

              </div>
              <div class="category_addition">
                <div class="row mb-1 mt-3 text-center">
                  <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                  <h6>Dodaj kategorie</h6>
                </div>
                <div class="row mb-2 text-center">
                  <div class="col-4 d-grid gap-2">
                    <button class="btn btn-success" type="button">Przychody</button>
                  </div>
                  <div class="col-4 d-grid gap-2">
                    <button class="btn btn-warning" type="button">Wydatki</button>
                  </div>
                  <div class="col-4 d-grid gap-2">
                    <button class="btn btn-primary" type="button">Metody płatności</button>
                  </div>
                </div>

              </div>
              <div class="category_deletion">
                <div class="row mb-1 mt-3 text-center">
                  <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                  <h6>Usuń kategorie</h6>
                </div>
                <div class="row mb-2 text-center">
                  <div class="col-4 d-grid gap-2">
                    <button class="btn btn-success" type="button">Przychody</button>
                  </div>
                  <div class="col-4 d-grid gap-2">
                    <button class="btn btn-warning" type="button">Wydatki</button>
                  </div>
                  <div class="col-4 d-grid gap-2">
                    <button class="btn btn-primary" type="button">Metody płatności</button>
                  </div>
                </div>

              </div>
              <div class="user_settings">
                <div class="row mb-1 mt-3 text-center">
                  <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                  <h6>Ustawienia użytkownika</h6>
                </div>
                <div class="d-grid gap-2 col-8 mx-auto">
                  <button class="btn btn-info" type="button">Edytuj swoje dane</button>
                  <button class="btn btn-danger" type="button">Usuń konto</button>
                </div>


              </div>


            </div>



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