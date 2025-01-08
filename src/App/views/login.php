<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="/assets/login.css">
  <!-- serif font - logo -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&display=swap" rel="stylesheet">
  <!-- sans font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Source+Sans+3:ital,wght@0,200..900;1,200..900&display=swap"
    rel="stylesheet">
  <title>Login Page</title>
</head>

<body>
  <main>
    <nav class="navbar navbar-expand " aria-label="Second navbar example">
      <div class="container-fluid main-navbar align-items-end ">
        <div class="navbar-brand col-8 px-5 align-bottom">
          <a class="navbar-brand" id="logo" href="/"><img class="coin" src="/assets/img/piggy-bank.svg"
              alt="coin icon">
            MyFinances</a>
        </div>
        <div class="collapse navbar-collapse col-4 pb-3 ">
          <ul class="navbar-nav m-auto">
            <li class="nav-item">
              <div class="col-6 pb-2">
                <a href="/registration" class="btn btn-outline-primary"
                  style="--bs-btn-padding-y: .15rem; --bs-btn-padding-x: 5rem; --bs-btn-font-size: 1.2rem;">Rejestracja</a>
              </div>
            </li>

          </ul>
        </div>
      </div>
    </nav>

    <article>
      <div>
        <div id="site">
          <div class="container text-panel">
            <div class="row ">
              <div class="col registration text-center ">
                <h1 class="h4 mt-2 fw-normal">Logowanie</h1>
              </div>
            </div>
            <form action="log_In.php" method="POST">
              <div class="row justify-content-center">
                <div class="col-9 pt-4">
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><img src="/assets/img/envelope-at.svg"
                        alt="envelope icon"></span>
                    <input type="email" class="form-control input-place" placeholder="Email" aria-label="Email" name="email">
                  </div>
                </div>
              </div>
              <div class="row justify-content-center">
                <div class="col-9 ">
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon2"><img src="/assets/img/lock.svg" alt="lock icon"></span>
                    <input type="password" class="form-control input-place" placeholder="Hasło" aria-label="Hasło" name="password">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col pb-3 text-center">
                  <button type="submit" class="btn btn-success"
                    style="--bs-btn-padding-y: .15rem; --bs-btn-padding-x: 5rem; --bs-btn-font-size: 1.2rem;">Zaloguj</button>
                </div>
              </div>
            </form>
            <div class="row">
              <div class="col pb-3 text-center">
                <?php
                
                ?>
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