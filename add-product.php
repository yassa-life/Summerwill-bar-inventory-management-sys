<?php include_once ('includes/check_session.php'); ?>
<?php include ('includes/dbconnection.php'); ?>
<?php include_once ('includes/header.php'); ?>

<div class="container-fluid page-body-wrapper">

  <?php include_once ('includes/sidebar.php'); ?>


  <div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title"> Add New Product </h3>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"> Add Product</li>
          </ol>
        </nav>
      </div>
      <div class="row">

        <div class="col-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">

              <form id="add_product_f" class="forms-sample row" method="post">

                <div class="form-group col-md-6">
                  <label for="exampleInputName1">Product Volume</label>
                  <select id="pvolume" name="gender" value="" class="form-control" required='true'>
                    <option value="">Choose Product</option>
                    <option value="180 ml">180 ml</option>
                    <option value="330 ml">330 ml</option>
                    <option value="375 ml">375 ml</option>
                    <option value="500 ml">500 ml</option>
                    <option value="625 ml">625 ml</option>
                    <option value="750 ml">750 ml</option>
                    <option value="not_list">not listed</option>
                    

                  </select>
                </div>
                <div class="form-group col-md-6">
                  <label for="exampleInputName1">Product Name</label>
                  <input type="text" id="pname" class="form-control" required='true'>
                </div>
                <div class="form-group col-md-6">
                  <label for="exampleInputName1">Product Type</label>
                  <select id="ptype" name="gender" value="" class="form-control" required='true'>
                    <option value="">Choose Product</option>

                    <?php
                    $sql = "SELECT * FROM product_type";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                      ?>
                      <option value="<?php echo $row['type_id']; ?>">
                        <?php echo $row['type_n']; ?>
                      </option>
                    <?php } ?>


                  </select>
                </div>
                <div class="form-group col-md-6">
                  <label for="exampleInputEmail3">Unit Price</label>
                  <input id="pprice" placeholder="Use format : (RS. xxx.xx)" pattern="^\d*(\.\d{0,2})?$"
                    class="form-control" required='true'>
                </div>
                <button onclick="add_product()" style="border-radius: 10px;" class="btn btn-primary mr-2"
                  name="submit">Add</button>

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