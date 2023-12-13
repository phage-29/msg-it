<?php
$page = "Zoom Request Form";
require_once "includes/session.php";
require_once "components/header.php";
require_once "components/topbar.php";
require_once "components/sidebar.php";
?>
<main id="main" class="main">

  <div class="pagetitle">
    <h1><?= $page ?></h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Form</a></li>
        <li class="breadcrumb-item active"><?= $page ?></li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section profile">
    <div class="row">
      <div class="col-xl-4">

        <div class="card">
          <div class="card-body">
            <div class="card-title"></div>
            <div class="mb-3">
              <label for="Topic" class="form-label">Topic</label>
              <textarea type="text" class="form-control" id="Topic" style="resize:none"></textarea>
            </div>

            <div class="mb-3">
              <label for="Office" class="form-label">Office/Division</label>
              <input type="text" class="form-control" id="Office">
            </div>

            <div class="mb-3">
              <label for="Schedule" class="form-label">Schedule</label>
              <input type="date" class="form-control" id="Schedule">
            </div>

            <div class="mb-3">
              <label for="DateStart" class="form-label">From</label>
              <input type="time" class="form-control" id="DateStart">
            </div>

            <div class="mb-3">
              <label for="DateEnd" class="form-label">To</label>
              <input type="time" class="form-control" id="DateEnd">
            </div>

            <div class="mb-3 text-end">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </div>
        </div>

      </div>

      <div class="col-xl-8">

        <div class="card">
          <div class="card-body">
            <div class="card-title small"></div>
            <div id='calendar' class="small"></div>
          </div>
        </div>

      </div>
    </div>
  </section>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');
      var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        titleFormat: {
          month: 'short',
          year: 'numeric'
        },
        dayMaxEventRows: 1
      });
      calendar.render();
    });
  </script>
</main><!-- End #main -->
<?php
require_once "components/footer.php";
?>