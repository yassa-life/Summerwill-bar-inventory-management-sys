<?php include_once ('includes/check_session.php'); ?>
<?php include ('includes/dbconnection.php'); ?>
<?php include_once ('includes/header.php'); ?>
<div class="container-fluid page-body-wrapper">
  <?php include_once ('includes/sidebar.php'); ?>


  <div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title"> Update FL 07 Data </h3>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"> Add Data</li>
          </ol>
        </nav>
      </div>
      <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
           

              <form action="FL-07-Table.php" method="get">
                <div class="form-group col-md-6">
                  <input type="date" id="date" name="dt" class="form-control" required='true'>
                </div>
                <button id="search-btn" style="border-radius: 10px;" class="btn btn-primary">Search</button>
              </form><br>


            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include_once ('includes/footer.php'); ?>
</div>
</div>
</div>
}