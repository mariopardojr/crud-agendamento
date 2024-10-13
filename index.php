<?php
session_start();
$name = '';
$time = '';
$date = '';

//$name = $_POST['name'];
//$time = $_POST['time'];
//$date = $_POST['date'];


if (isset($_POST['submit'])) {
    !isset($_SESSION['formData']) && $_SESSION['formData'] = [];
    $customer = [
        'name' => $_POST['customer'] ?? '',
        'time' => $_POST['time'] ?? '',
        'date' => $_POST['date'] ?? '',
    ];

    $_SESSION['formData'][] = $customer;
    header('Location: index.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="custom.css">
  <link rel="stylesheet" href="style.css"/>
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

    <form method="post" action="">
      <div>
        <label class="form-label" for="date">Data</label>
        <input id="date" class="form-control" type="date" name="date"/>
      </div>

      <div class="time">
        <p class="form-label">Horários</p>
        <div class="daytime">
          <p>Manhã</p>
          <div class="time-list">
            <input id="time-btn-9" type="radio" class="btn-check" name="time" value="9:00">
            <label class="btn" for="time-btn-9">9:00</label>

            <input id="time-btn-10" type="radio" class="btn-check" name="time" value="10:00">
            <label class="btn" for="time-btn-10">10:00</label>

            <input id="time-btn-11" type="radio" class="btn-check" name="time" value="11:00">
            <label class="btn" for="time-btn-11">11:00</label>

            <input id="time-btn-12" type="radio" class="btn-check" name="time" value="12:00">
            <label class="btn" for="time-btn-12">12:00</label>
          </div>
        </div>

        <div class="daytime">
          <p>Tarde</p>
          <div class="time-list">
            <input id="time-btn-13" type="radio" class="btn-check" name="time" value="13:00">
            <label class="btn" for="time-btn-13">13:00</label>

            <input id="time-btn-14" type="radio" class="btn-check" name="time" value="14:00">
            <label class="btn" for="time-btn-14">14:00</label>

            <input id="time-btn-15" type="radio" class="btn-check" name="time" value="15:00">
            <label class="btn" for="time-btn-15">15:00</label>

            <input id="time-btn-16" type="radio" class="btn-check" name="time" value="16:00">
            <label class="btn" for="time-btn-16">16:00</label>

            <input id="time-btn-17" type="radio" class="btn-check" name="time" value="17:00">
            <label class="btn" for="time-btn-17">17:00</label>

            <input id="time-btn-18" type="radio" class="btn-check" name="time" value="18:00">
            <label class="btn" for="time-btn-18">18:00</label>
          </div>
        </div>

        <div class="daytime">
          <p>Noite</p>
          <div class="time-list">
            <input id="time-btn-19" type="radio" class="btn-check" name="time" value="19:00">
            <label class="btn" for="time-btn-19">19:00</label>

            <input id="time-btn-20" type="radio" class="btn-check" name="time" value="20:00">
            <label class="btn" for="time-btn-20">20:00</label>

            <input id="time-btn-21" type="radio" class="btn-check" name="time" value="21:00">
            <label class="btn" for="time-btn-21">21:00</label>
          </div>
        </div>
      </div>

      <div class="customer">
        <div>
          <label class="form-label" for="customer">Cliente</label>
          <input id="customer" class="form-control" type="text" name="customer"/>
        </div>
      </div>
      <button id="submitButton" class="btn btn-warning w-100" name="submit">
        AGENDAR
      </button>
    </form>
  </section>

  <section class=" section-agenda
      ">
    <div class="heading-agenda">
      <div>
        <h2>Sua agenda</h2>
        <p>Consulte os seus cortes de cabelo agendados por dia</p>
      </div>
      <div>
        <label class="form-label" for="agenda-date">Data</label>
        <input id="agenda-date" class="form-control" type="date" name="agendaDate"/>
      </div>
    </div>
    <div class="schedule">
      <div class="schedule-card">
        <div class="schedule-card-header">
          <div class="card-title">
            <img class="icon" src="assets/morning.svg" alt="">
            <span>Manhã</span>
          </div>
          <p>09h-12h</p>
        </div>
        <ul class="schedule-list">
            <?php foreach ($_SESSION['formData'] as $schedule): ?>
              <li class="schedule-item">
                  <div>
                      <?= $schedule['time'] ?> <?= $schedule['name'] ?>
                  </div>
                  <div class="schedule-action">
                      <button id="" class="btn btn-danger" name="">
                          DELETE
                      </button>
                      <button id="" class="btn btn-warning" name="">
                          EDIT
                      </button>
                  </div>
              </li>
            <?php endforeach; ?>
        </ul>
      </div>
    </div>

    <div class="schedule">
      <div class="schedule-card">
        <div class="schedule-card-header">
          <p class="card-title">
            <img class="icon" src="assets/afternoon.svg" alt="">
            <span>Tarde</span>
          </p>
          <p>13h-18h</p>
        </div>
        <ul class="schedule-list">
          <li>Test</li>
          <li>Test</li>
          <li>Test</li>
        </ul>
      </div>
    </div>

    <div class="schedule">
      <div class="schedule-card">
        <div class="schedule-card-header">
          <p class="card-title">
            <img class="icon" src="assets/night.svg" alt="">
            <span>Noite</span>
          </p>
          <p>19h-21h</p>
        </div>
        <ul class="schedule-list">
          <li>Test</li>
          <li>Test</li>
          <li>Test</li>
        </ul>
      </div>
    </div>
  </section>
</main>
</body>
</html>
