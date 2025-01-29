<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="/assets/home.css">
  <!-- serif font - logo -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&display=swap" rel="stylesheet">
  <!-- sans font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Source+Sans+3:ital,wght@0,200..900;1,200..900&display=swap"
    rel="stylesheet">

  <title>HomePage</title>
</head>

<body>
  <main>

    <nav class="navbar navbar-expand " aria-label="Second navbar example">
      <div class="container-fluid main-navbar align-items-end ">
        <div class="navbar-brand col-8 px-5 align-bottom">
          <a class="navbar-brand" id="logo" href="/"><img class="coin" src="/assets/img/piggy-bank.svg" alt="coin icon">
            MyFinances</a>
        </div>
        <div class="collapse navbar-collapse col-4 pb-3 ">
          <ul class="navbar-nav m-auto">
            <li class="nav-item">
              <a class="nav-link active " id="question" aria-current="page" href="#">Dlaczego warto?</a>

            </li>

          </ul>
        </div>
      </div>
    </nav>

    <article>
      <div>
        <div id="site">
          <div class=" container menu  ">
            <div class=" row justify-content-center ">
              <div class="col ">
                <div class="text-panel ">
                  <h3 id="quote">"Podróż tysiąca mil zaczyna sie od jednego kroku"<br> <i>Lao Tzu</i></h3>
                  <p>Twoja podróż do zorganizowania swoich finansów osobistych może zacząć się właśnie tutaj.<br> Jej
                    pierwszym
                    krokiem jest założenie konta. Kiedy to zrobisz, skierujesz się prosto do celu, a jest nim skuteczne
                    zarządzanie budżetem domowym.<br><br><em> Po szczegółowe informacje zajrzyj do „Dlaczego
                      warto?”.</em> </p>
                </div>
              </div>
            </div>
            <div class="row mt-3 text-center">
              <div class="col">
                <p class="button-descript">Witaj ponownie!</p>
              </div>
              <div class="col">
                <p class="button-descript">Pierwszy raz? Załóż konto</p>
              </div>
            </div>

            <div class="row text-center ">
              <div class="col-6">
                <a href="/login" type="button" class="btn btn-success"
                  style="--bs-btn-padding-y: .15rem; --bs-btn-padding-x: 5rem; --bs-btn-font-size: 1.2rem;">Logowanie</a>
              </div>
              <div class="col-6">
                <a href="/registration" type="button" class="btn btn-primary"
                  style="--bs-btn-padding-y: .15rem; --bs-btn-padding-x: 5rem; --bs-btn-font-size: 1.2rem;">Rejestracja</a>
              </div>
            </div>
          </div>
        </div>
      </div>

    </article>

    <section class="slider">
      <div class="hideShow">

        <div class="about-budget">
          <article>
            <svg id="closebtn" xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor"
              class="bi bi-x-circle close-button" viewBox="0 0 16 16">
              <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
              <path
                d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
            </svg>
            <h2>Co to w ogóle jest budżet domowy?</h2>
            <p>Budżet to niezwykle ważny element domowych finansów. W skrócie zestawienie przychodów i rozchodów (w tym
              głównie wydatków) w ustalonym przedziale czasowym w gospodarstwie domowym.</p>
            <h2>Jak zacząć prowadzenie budżetu domowego?</h2>
            <p>Najlepiej SZYBKO i bez ociągania się! Wiadomo, że początkującym nie jest łatwo, więc tym bardziej nie
              warto tego odkładać tylko zacząć jak najwcześniej i szybko mieć etap wdrażania się za sobą. </p>
            <p>Budżet domowy jest narzędziem efektywnie wspierającym zarządzanie finansami. Spełnia on wiele ważnych
              funkcji:</p>
            <ul>
              <li>pozwala kontrolować wydatki,</li>
              <li>pozwala planować wydatki,</li>
              <li>pozwala na osiągnięcie bezpieczeństwa finansowego,</li>
              <li>pozwala rozpoznać źródło problemów finansowych,</li>
              <li>daje poczucie kontroli i sprawczości.</li>
            </ul>
          </article>
        </div>
      </div>
    </section>

  </main>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="/assets/home.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

</body>

</html>