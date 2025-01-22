<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="/assets/balance.css">
  <!-- serif font - logo -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&display=swap" rel="stylesheet">
  <!-- sans font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Source+Sans+3:ital,wght@0,200..900;1,200..900&display=swap"
    rel="stylesheet">

  <title>Balance Page</title>
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
                <a role="button" class="btn btn-outline-secondary px-3"><img src="/assets/img/tools.svg"
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

    <section class="date-modal">
      <div class="modal fade bd-modal-md" tabindex="-1" role="dialog" aria-labelledby="date-modal" aria-hidden="true">
        <div class="modal-dialog modal-md">
          <form method="GET">            
            <div class="modal-content px-4 py-2">
              <h3 class="modal-header">Wybierz zakres dat</h3>
              <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Data początkowa</span>
                <input type="date" id="date" class="form-control input-place" name="custom_date_start" aria-label="Date">
              </div>
              <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon2">Data końcowa</span>
                <input type="date" id="date2" class="form-control input-place" name="custom_date_end" aria-label="Date">
              </div>
              <div class="text-center">
                <button type="submit" value="1" name="custom_period" class="btn btn-success"> Akceptuj</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </section>

    <article>
      <div id="site">

        <div class=" container-fluid menu  ">
          <div class="row">
            <div class="dropdown nav-item d-flex justify-content-md-end period-change">
              <button class="btn btn-secondary dropdown-toggle period-list" type="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                Wybierz Okres
              </button>
              <form method="GET">                
                <ul class="dropdown-menu">
                  <li><button class="dropdown-item" type="submit" name="current_month">Bieżący miesiąc</button></li>
                  <li><button class="dropdown-item" name="previous_month" type="submit">Poprzedni miesiąc</button></li>
                  <li><button class="dropdown-item" type="submit" name="current_year">Bieżący rok</button></li>
                  <li><a class="dropdown-item" id="modal-item" href="#" data-bs-toggle="modal"
                      data-bs-target=".bd-modal-md">Niestandardowy</a>
                  </li>
                </ul>
              </form>
            </div>
          </div>

          <div class="row">
            <div class="col-md-8 col-sm-12 pt-5">
              <div class="row">
                <div class="row">
                  <div class="col-md-6">
                    <div class="bd-example text-panel table">
                      <table class="table table-hover incomes">
                        <thead>
                          <tr>
                            <th colspan="3"> Przychody według kategorii </th>
                          </tr>
                          <tr>
                            <th scope="col"> </th>
                            <th scope="col">Kategoria</th>
                            <th scope="col">Kwota</th>

                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $total_incomes_sum = 0;
                          extract($transactions);

                          foreach ($incomesCatSum as $incomesSum) :
                          ?>
                            <tr>
                              <th scope="row"><?php $row = 1;
                                              echo $row;
                                              $row++; ?></th>
                              <td> <?php echo e($incomesSum['name']); ?> </td>
                              <td> <?php echo e($incomesSum['category_sum']); ?> </td>
                            </tr>
                            <?php $total_incomes_sum += $incomesSum['category_sum']; ?>

                          <?php endforeach; ?>

                          <tr>
                            <th colspan="2">Suma</th>
                            <td><?php echo $total_incomes_sum; ?> PLN</td>
                          </tr>
                        </tbody>
                      </table>
                      <button class="btn btn-outline-secondary" id="show-incomes"> Pokaż przychody w okresie</button>
                      <div class="">

                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="bd-example text-panel table">
                      <table class="table table-hover expenses ">
                        <thead>
                          <tr>
                            <th colspan="3"> Wydatki według kategorii </th>
                          </tr>
                          <tr>
                            <th scope="col"></th>
                            <th scope="col">Kategoria</th>
                            <th scope="col">Kwota</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $total_expenses_sum = 0;

                          foreach ($expensesCatSum as $expensesSum) :
                          ?>
                            <tr>
                              <th scope="row"><?php $row = 1;
                                              echo $row;
                                              $row++; ?></th>
                              <td> <?php echo e($expensesSum['name']); ?> </td>
                              <td> <?php echo e($expensesSum['category_sum']); ?> </td>
                            </tr>
                            <?php $total_expenses_sum += $expensesSum['category_sum']; ?>
                          <?php endforeach; ?>
                          <tr>
                            <th colspan="2">Suma</th>
                            <td><?php echo $total_expenses_sum; ?> PLN</td>
                          </tr>
                        </tbody>
                      </table>
                      <button class="btn btn-outline-secondary" id="show-expenses"> Pokaż wydatki w okresie</button>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="bd-example text-panel table" id="incomes-details">
                      <table class="table table-hover ">
                        <thead>
                          <tr>
                            <th colspan="6"> Szczegółowy wykaz przychodów </th>
                          </tr>
                          <tr>
                            <th scope="col"> </th>
                            <th scope="col">Data</th>
                            <th scope="col">Kwota</th>
                            <th scope="col">Kategoria</th>
                            <th scope="col">Komentarz</th>
                            <th scope="col"><img src="/assets/img/tools.svg" alt="tools icon"></th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($incomes as $income) : ?>
                            <tr>
                              <th scope="row"><?php $row = 1;
                                              echo $row;
                                              $row++; ?></th>
                              <td> <?php echo e($income['date_of_income']); ?> </td>
                              <td> <?php echo e($income['amount']); ?> </td>
                              <td> <?php echo e($income['category_name']); ?> </td>
                              <td> <?php echo e($income['income_comment']); ?> </td>
                              <td><img src="/assets/img/pencil.svg" alt="pencil icon"> <img src="/assets/img/trash.svg"
                                  alt="trash icon"> </td>
                            </tr>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="bd-example text-panel table" id="expenses-details">
                      <table class="table table-hover ">
                        <thead>
                          <tr>
                            <th colspan="7"> Szczegółowy wykaz wydatków </th>
                          </tr>
                          <tr>
                            <th scope="col"></th>
                            <th scope="col">Data</th>
                            <th scope="col">Kwota</th>
                            <th scope="col">Sposób płatności</th>
                            <th scope="col">Kategoria</th>
                            <th scope="col">Komentarz</th>
                            <th scope="col"><img src="/assets/img/tools.svg" alt="tools icon"></th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($expenses as $expense) : ?>
                            <tr>
                              <th scope="row"><?php $row = 1;
                                              echo $row;
                                              $row++; ?></th>
                              <td> <?php echo e($expense['date_of_expense']); ?> </td>
                              <td> <?php echo e($expense['amount']); ?> </td>
                              <td> <?php echo e($expense['payment_method']); ?> </td>
                              <td> <?php echo e($expense['expense_category_name']); ?> </td>
                              <td> <?php echo e($expense['expense_comment']); ?> </td>
                              <td><img src="/assets/img/pencil.svg" alt="pencil icon"> <img src="/assets/img/trash.svg"
                                  alt="trash icon"> </td>
                            </tr>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-4 p-4 pt-5">
              <div class="row text-panel balance-sum ">
                <div class="col ">

                  <h3 id="balance-header">Bilans za wskazany okres wynosi:
                    <?php                                        
                      $summar_balance = $total_incomes_sum - $total_expenses_sum;
                      if ($summar_balance > 0) {
                        echo '<span class="balance-difference">' . $summar_balance .
                          ' PLN</span> </h3>';
                        echo '<p class="balance-feedback" style="color:green">Gratulacje. Świetnie zarządzasz finansami!</p>';
                      } else if($summar_balance < 0){
                        echo '<span class="balance-difference" style="color:red">' . $summar_balance .
                          ' PLN</span> </h3>';
                        echo '<p class="balance-feedback" style="color:red">Uważaj! Twoje wydatki przerosły dochody! </p>';
                      } else {
                        echo '<span class="balance-difference">' . $summar_balance .
                          ' PLN</span> </h3>';
                        echo '<p class="balance-feedback" > Brak transakcji we wskazanym okresie </p>';
                      }
                    
                    ?>
                </div>
              </div>
              <div class="row pie-char text-panel">
                <div>
                  <canvas id="myChart"></canvas>
                </div>

                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                <script>
                  const ctx = document.getElementById('myChart');

                  new Chart(ctx, {
                    type: 'pie',
                    data: {
                      labels: [
                        <?php                        
                          foreach ($expensesCatSum as $category) {
                            echo "'" . $category['name'] . "',";
                          }                        
                        ?>
                      ],
                      datasets: [{
                        label: 'Kwota (PLN)',
                        data: [
                          <?php                          
                            foreach ($expensesCatSum as $sum) {
                              echo "'" . $sum['category_sum'] . "',";
                            }                          
                          ?>
                        ],
                        borderWidth: 1
                      }]
                    },
                    options: {
                      title: {
                        display: true,
                        text: "Rozkład wydatków według kategorii"
                      }
                    }
                  });
                </script>

              </div>
            </div>

          </div>

        </div>
      </div>
    </article>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="/assets/balance.js"></script>
</body>

</html>