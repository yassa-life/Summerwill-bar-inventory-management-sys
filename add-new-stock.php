<?php include_once ('includes/check_session.php'); ?>
<?php include ('includes/dbconnection.php'); ?>
<?php include_once ('includes/header.php'); ?>
<div class="container-fluid page-body-wrapper">
  <?php include_once ('includes/sidebar.php'); ?>


  <div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title"> Add New Stock </h3>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"> Add New Stock</li>
          </ol>
        </nav>
      </div>
      <div class="row">

        <div class="col-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">

              <form id="add_product_f" class="forms-sample row" method="post">

                <div class="form-group col-md-6">
                  <label for="exampleInputName1">Product</label>
                  <select id="dropd" name="gender" value="" class="form-control" required='true'>
                    <option value="">Choose Product</option>

                    <?php
                    $sql = "SELECT * FROM product";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                      ?>
                      <option value="<?php echo $row['product_id']; ?>">
                        <?php echo $row['product_name']; ?>
                      </option>
                    <?php } ?>


                  </select>
                </div>
                <div class="form-group col-md-6">
                  <label for="exampleInputEmail3">Date</label>               
                  <input type="date" id="date" name="dt" class="form-control" required='true'>
                </div>
                <div class="form-group col-md-6">
                  <label for="exampleInputEmail3">Stock Amount</label>
                  <input type="number" id="qty" class="form-control" required='true'>
                </div>
                <div class="form-group col-md-6">
               
                </div>
                <button onclick="add_new_stock()" style="border-radius: 10px;" class="btn btn-primary mr-2" name="submit">Add</button>

              </form>
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