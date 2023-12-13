<?php
$page = "Other ICT Assistance";
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
              <label for="Category" class="form-label">Nature of Complaint</label>
              <input type="text" class="form-control" id="Category">
            </div>

            <div class="mb-3">
              <label for="SubCategory" class="form-label">Complaint/Category</label>
              <input type="text" class="form-control" id="SubCategory">
            </div>

            <div class="mb-3">
              <label for="Schedule" class="form-label">Preferred Schedule</label>
              <input type="date" class="form-control" id="Schedule">
            </div>

            <div class="mb-3">
              <label for="Complaint" class="form-label">Defects/Compliants</label>
              <textarea type="text" class="form-control" id="Complaint" style="resize:none"></textarea>
            </div>

            <div class="mb-3">
              <label for="AdditionalFiles" class="form-label">Additional File</label>
              <input type="file" class="form-control" id="AdditionalFiles" multiple>
            </div>

            <div class="mb-3 text-end">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </div>
        </div>

      </div>

      <div class="col-xl-8">

        <div class="card">
          <div class="card-body pt-3">
            <div class="list-group">
              <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
                <i class="bi bi-clock-history fs-2 text-warning"></i>
                <div class="d-flex gap-2 w-100 justify-content-between">
                  <div>
                    <h6 class="mb-0">List group item heading</h6>
                    <p class="mb-0 opacity-75">Some placeholder content in a paragraph.</p>
                  </div>
                  <small class="opacity-50 text-nowrap"><time class="timeago" datetime="2022-12-11T09:24:17Z"></time></small>
                </div>
              </a>
              <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
                <i class="bi bi-clock-history fs-2 text-warning"></i>
                <div class="d-flex gap-2 w-100 justify-content-between">
                  <div>
                    <h6 class="mb-0">Another title here</h6>
                    <p class="mb-0 opacity-75">Some placeholder content in a paragraph that goes a little longer so it wraps to a new line.</p>
                  </div>
                  <small class="opacity-50 text-nowrap">3d</small>
                </div>
              </a>
              <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
                <i class="bi bi-clock-history fs-2 text-warning"></i>
                <div class="d-flex gap-2 w-100 justify-content-between">
                  <div>
                    <h6 class="mb-0">Third heading</h6>
                    <p class="mb-0 opacity-75">Some placeholder content in a paragraph.</p>
                  </div>
                  <small class="opacity-50 text-nowrap">1w</small>
                </div>
              </a>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

</main><!-- End #main -->
<?php
require_once "components/footer.php";
?>