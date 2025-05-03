<?php include_once ('includes/check_session.php'); ?>
<?php include ('includes/dbconnection.php'); ?>
<?php include_once ('includes/header.php'); ?>
<div class="container-fluid page-body-wrapper">
  <?php include_once ('includes/sidebar.php'); ?>


  <div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title"> Manage Product </h3>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"> Manage Products</li>
          </ol>
        </nav>
      </div>
      <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <form method="post">
                <div class="form-group">

                  <input onkeydown="search()" id="searchInput" type="text" name="searchdata" required="true"
                    class="form-control" placeholder="Search by Student ID">
                </div>
              </form>
              <div class="table-responsive border rounded p-1" style="max-height: 65vh; overflow-y: auto;">
                <table class="table" id="dataTable">
                  <thead>
                    <tr>
                      <th class="font-weight-bold">Product id</th>
                      <th class="font-weight-bold">Product Name</th>
                      <th class="font-weight-bold">Unit Priec</th>
                      <th class="font-weight-bold">Product Type</th>
                      <th class="font-weight-bold">Action</th>

                    </tr>
                  </thead>
                  <tbody>
                  <?php
                          if ($_SESSION['type'] == 'admin') {
                            $disabled = 'disabled'; // Leave the button enabled
                          } else {
                            $disabled = ''; // Disable the button
                          }
                          ?>

                    <?php
                    $sql = "SELECT * FROM product inner JOIN product_type ON product_type.type_id=product.`type`  ORDER BY product.`type`";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                      ?>
                      <tr>
                        <td>
                          <?php echo $row['product_id']; ?>
                        </td>
                        <td value="">
                          <?php echo $row['product_name']; ?>
                        </td>
                        <td>
                          <input <?php echo $disabled; ?> id="unit_price_<?php echo $row['product_id']; ?>" type="text"
                            style="height: 30px; width: 10rem" class="received-input form-control"
                            value="<?php echo $row['unit_price']; ?>" required='true'>
                        </td>
                        <td>
                          <?php echo $row['type_n']; ?>
                        </td>
                        <td>
                          <button onclick="edit_product_detail('<?php echo $row['product_id']; ?>')"
                            class="btn btn-primary btn-sm" <?php echo $disabled; ?>>Update</button>
                        </td>
                      </tr>
                    <?php } ?>

                  </tbody>
                </table>
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