<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');

if (!isset($_SESSION['customers'])) {
  $_SESSION['customers'] = [];
}

if (!isset($_SESSION['searchDate'])) {
  $_SESSION['searchDate'] = date("Y-m-d");
}

$morning;
$afternoon;
$night;

class Customer
{
  public string $id;
  public string $name;
  public string $time;
  public string $date;

  public function __construct($name, $time, $date)
  {
      $this->id = uniqid();
      $this->name = $name;
      $this->time = $time;
      $this->date = $date;
  }

  public function getFormattedTime(): string
  {
      return "{$this->time}:00";
  }

  public function update($name, $time, $date): void {
    $this->name = $name;
    $time && $this->time = $time;
    $this->date = $date;
  }
}

function filterScheduleByDate(): void {
  $customers = array_filter($_SESSION['customers'], function($customer) {
    return $customer->date == $_SESSION['searchDate'];
  });

  foreach ($customers as $customer) {
    categorizeScheduleByTime($customer);
  }
}

function categorizeScheduleByTime($customer): void {
  if ($customer->time >= 9 && $customer->time <= 12) {
    $GLOBALS['morning'][] = $customer;
  }

  if ($customer->time >= 13 && $customer->time <= 18) {
    $GLOBALS['afternoon'][] = $customer;
  }

  if ($customer->time >= 19) {
    $GLOBALS['night'][] = $customer;
  }
}

function getCustomerById($id): Customer {
  foreach ($_SESSION['customers'] as $customer) {
    if ($customer->id == $id) {
      return $customer;
    }
  }
  return null;
}

function getUpdatedCustomer(): Customer {
  $_SESSION['customerToEdit']->update($_POST['customer'], $_POST['time'], $_POST['date']);
  $_SESSION['customers'] = array_filter($_SESSION['customers'], function ($customer) {
    return $customer->id != $_SESSION['customerToEdit']->id;
  });

  return $_SESSION['customerToEdit'];
}

 
if (isset($_POST['submit'])) {
  $_SESSION['customers'][] = isset($_SESSION['customerToEdit']) ? getUpdatedCustomer() : new Customer($_POST['customer'], $_POST['time'], $_POST['date']);
  isset($_SESSION['customerToEdit']) && $_SESSION['customerToEdit'] = null;
}

if (isset($_POST['delete'])) {
  $_SESSION['customers'] = array_filter($_SESSION['customers'], function ($customer) {
    return $customer->id != $_POST['delete'];
  });
}

if (isset($_POST['edit'])) {  
  $_SESSION['customerToEdit'] = getCustomerById($_POST['edit']);
}

if (isset($_POST['search'])) {
  $_SESSION['searchDate'] = $_POST['searchDate'];
}

filterScheduleByDate();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="../custom.css">
  <link rel="stylesheet" href="../style.css"/>
  <title>Document</title>
</head>
<body>
<main>
  <section class="section-form">
    <div class="heading">
      <h2>Agende um atendimento</h2>
      <p>
        Selecione data, horário e informe o nome do cliente para criar o
        agendamento
      </p>
    </div>

    <form method="post" class="customer-form">
      <div>
        <label class="form-label" for="date">Data</label>
        <input id="date" class="form-control" type="date" name="date" value="<?=$_SESSION['customerToEdit']->date ?? null?>"/>
      </div>

      <div class="time">
        <p class="form-label">Horários</p>
        <div class="daytime">
          <p>Manhã</p>
          <div class="time-list">
            <input id="time-btn-9" type="radio" class="btn-check" name="time" value="9"
              <?php if (isset($_SESSION['customerToEdit']) && $_SESSION['customerToEdit']->time == 9) {echo 'checked';} ?> 
            >
            <label class="btn" for="time-btn-9">9:00</label>

            <input id="time-btn-10" type="radio" class="btn-check" name="time" value="10"
              <?php if (isset($_SESSION['customerToEdit']) && $_SESSION['customerToEdit']->time == 10) {echo 'checked';} ?>
            > 
            <label class="btn" for="time-btn-10">10:00</label>

            <input id="time-btn-11" type="radio" class="btn-check" name="time" value="11"
              <?php if (isset($_SESSION['customerToEdit']) && $_SESSION['customerToEdit']->time == 11) {echo 'checked';} ?>
            >
            <label class="btn" for="time-btn-11">11:00</label>

            <input id="time-btn-12" type="radio" class="btn-check" name="time" value="12"
              <?php if (isset($_SESSION['customerToEdit']) && $_SESSION['customerToEdit']->time == 12) {echo 'checked';} ?> 
            >
            <label class="btn" for="time-btn-12">12:00</label>
          </div>
        </div>

        <div class="daytime">
          <p>Tarde</p>
          <div class="time-list">
            <input id="time-btn-13" type="radio" class="btn-check" name="time" value="13"
              <?php if (isset($_SESSION['customerToEdit']) && $_SESSION['customerToEdit']->time == 13) {echo 'checked';} ?> 
            >
            <label class="btn" for="time-btn-13">13:00</label>

            <input id="time-btn-14" type="radio" class="btn-check" name="time" value="14"
              <?php if (isset($_SESSION['customerToEdit']) && $_SESSION['customerToEdit']->time == 14) {echo 'checked';} ?>
            >
            <label class="btn" for="time-btn-14">14:00</label>

            <input id="time-btn-15" type="radio" class="btn-check" name="time" value="15"
              <?php if (isset($_SESSION['customerToEdit']) && $_SESSION['customerToEdit']->time == 15) {echo 'checked';} ?> 
            >
            <label class="btn" for="time-btn-15">15:00</label>

            <input id="time-btn-16" type="radio" class="btn-check" name="time" value="16"
              <?php if (isset($_SESSION['customerToEdit']) && $_SESSION['customerToEdit']->time == 16) {echo 'checked';} ?>
            >
            <label class="btn" for="time-btn-16">16:00</label>

            <input id="time-btn-17" type="radio" class="btn-check" name="time" value="17" 
              <?php if (isset($_SESSION['customerToEdit']) && $_SESSION['customerToEdit']->time == 17) {echo 'checked';} ?>
            >
            <label class="btn" for="time-btn-17">17:00</label>

            <input id="time-btn-18" type="radio" class="btn-check" name="time" value="18"
              <?php if (isset($_SESSION['customerToEdit']) && $_SESSION['customerToEdit']->time == 18) {echo 'checked';} ?> 
            >
            <label class="btn" for="time-btn-18">18:00</label>
          </div>
        </div>

        <div class="daytime">
          <p>Noite</p>
          <div class="time-list">
            <input id="time-btn-19" type="radio" class="btn-check" name="time" value="19"
              <?php if (isset($_SESSION['customerToEdit']) && $_SESSION['customerToEdit']->time == 19) {echo 'checked';} ?>
            >
            <label class="btn" for="time-btn-19">19:00</label>

            <input id="time-btn-20" type="radio" class="btn-check" name="time" value="20"
              <?php if (isset($_SESSION['customerToEdit']) && $_SESSION['customerToEdit']->time == 20) {echo 'checked';} ?>
            >
            <label class="btn" for="time-btn-20">20:00</label>

            <input id="time-btn-21" type="radio" class="btn-check" name="time" value="21"
              <?php if (isset($_SESSION['customerToEdit']) && $_SESSION['customerToEdit']->time == 21) {echo 'checked';} ?>
            >
            <label class="btn" for="time-btn-21">21:00</label>
          </div>
        </div>
      </div>

      <div class="customer">
        <div>
          <label class="form-label" for="customer">Cliente</label>
          <input id="customer" class="form-control" type="text" name="customer" value="<?=$_SESSION['customerToEdit']->name ?? ''?>"/>
        </div>
      </div>
      <button id="submitButton" class="btn w-100 <?=isset($_SESSION['customerToEdit']) ? 'btn-info' : 'btn-warning'?>" name="submit">
        <?=isset($_SESSION['customerToEdit']) ? 'UPDATE' : 'AGENDAR' ?>
      </button>
    </form>
  </section>

  <section class="section-agenda">
    <div class="heading-agenda">
      <div>
        <h2>Sua agenda</h2>
        <p>Consulte os atendimentos agendados por dia</p>
      </div>
      <form method="post" class="search-date-form">
        <div>
          <label class="form-label" for="search-date">Data</label>
          <input id="search-date" class="form-control" type="date" name="searchDate" value="<?=$_SESSION['searchDate']?>"/>
        </div>
        <button type="submit" id="searchButton" class="btn btn-warning w-100" name="search">
          PESQUISAR
        </button>
      </form>

    </div>
    <span>Exibindo resultados para <?= date_format(date_create($_SESSION['searchDate']), 'd/m/Y') ?> </span>
    <div class="schedule">
      <div class="schedule-card">
        <div class="schedule-card-header">
          <div class="card-title">
            <img class="icon" src="../assets/morning.svg" alt="">
            <span>Manhã - <?= date_format(date_create($_SESSION['searchDate']), 'd/m') ?></span>
          </div>
          <p>09h-12h</p>
        </div>
        <ul class="schedule-list">
          <?php if (isset($morning)): ?>
            <?php foreach ($morning as $index => $customer): ?>
              <li class="schedule-item">
                <div class="schedule-info">
                  <span><?= $customer->getFormattedTime(); ?></span>
                  <span><?= $customer->name ?></span>
                </div>
                <form method="post">
                    <div class="schedule-action">
                    <button type="submit" class="btn btn-danger" name="delete" data-time="<?=$customer->time?>" data-date="<?=$customer->date?>" value="<?=$customer->id?>">
                        DELETE
                    </button>
                    <button type="submit" class="btn btn-warning" name="edit" value="<?=$customer->id?>">
                        EDIT
                    </button>
                    </div>
                </form>
              </li> 
            <?php endforeach; ?>
          <?php endif; ?>
          <?php if (!isset($morning)): ?>
            <p class="no-schedule-message">Sem agendamentos</p>
          <?php endif; ?>
        </ul>
      </div>
    </div>

    <div class="schedule">
      <div class="schedule-card">
        <div class="schedule-card-header">
          <p class="card-title">
            <img class="icon" src="../assets/afternoon.svg" alt="">
            <span>Tarde - <?= date_format(date_create($_SESSION['searchDate']), 'd/m') ?></span>
          </p>
          <p>13h-18h</p>
        </div>
        <ul class="schedule-list">
        <?php if (isset($afternoon)): ?>
         <?php foreach ($afternoon as $index => $customer): ?>
             <li class="schedule-item">
                 <div class="schedule-info">
                     <span><?= $customer->getFormattedTime(); ?></span>
                     <span><?= $customer->name ?></span>
                 </div>
                 <form method="post">
                     <div class="schedule-action">
                         <button type="submit" class="btn btn-danger" name="delete" data-time="<?=$customer->time?>" data-date="<?=$customer->date?>" value="<?=$customer->id?>">
                             DELETE
                         </button>
                         <button type="submit" class="btn btn-warning" name="edit" value="<?=$customer->id?>">
                             EDIT
                         </button>
                     </div>
                 </form>
             </li>
          <?php endforeach; ?>
         <?php endif;?>
         <?php if (!isset($afternoon)): ?>
            <p class="no-schedule-message">Sem agendamentos</p>
          <?php endif; ?>
        </ul>
      </div>
    </div>

    <div class="schedule">
      <div class="schedule-card">
        <div class="schedule-card-header">
          <p class="card-title">
            <img class="icon" src="../assets/night.svg" alt="">
            <span>Noite - <?= date_format(date_create($_SESSION['searchDate']), 'd/m') ?></span>
          </p>
          <p>19h-21h</p>
        </div>
        <ul class="schedule-list">
          <?php if (isset($night)): ?>
            <?php foreach ($night as $index => $customer): ?>
              <li class="schedule-item">
                  <div class="schedule-info">
                      <span><?= $customer->getFormattedTime(); ?></span>
                      <span><?= $customer->name ?></span>
                  </div>

                  <form method="post">
                      <div class="schedule-action">
                          <button type="submit" class="btn btn-danger" name="delete" data-time="<?=$customer->time?>" data-date="<?=$customer->date?>" value="<?=$customer->id?>">
                              DELETE
                          </button>
                          <button type="submit" class="btn btn-warning" name="edit" value="<?=$customer->id?>">
                              EDIT
                          </button>
                      </div>
                  </form>
              </li>
            <?php endforeach; ?>
          <?php endif;?>
          <?php if (!isset($night)): ?>
            <p class="no-schedule-message">Sem agendamentos</p>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </section>
</main>
<script src="script.js"></script>
</body>
</html>
