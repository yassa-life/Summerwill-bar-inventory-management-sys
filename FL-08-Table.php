<?php include_once ('includes/check_session.php'); ?>
<?php include ('includes/dbconnection.php'); ?>
<?php include_once ('includes/header.php'); ?>
<!-- <div class="container-fluid page-body-wrapper"> -->
<div id="preloader1"></div>

<!-- <div class="main-panel"> -->
<div class="content-wrapper">
  <div class="page-header">
    <h3 class="page-title"> FL-08 </h3>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page"> Manage Fl-08 Data</li>
      </ol>
    </nav>
  </div>
  <div class="row">
    <div class="col-12 grid-margin">
      <div class="card">
        <div class="card-body">
          <div class="d-sm-flex align-items-center mb-4">
            <a href="dashboard.php" style="border-radius: 10px;" class="btn btn-dark btn-sm"> <i class="icon-home"> Go
                To Home</i></a>
          </div>


          <form action="FL-08-Table.php" class="form-inline" method="get">
            <div class="form-group mx-sm-3 col-md-4 mb-2">
              <input type="date" id="date" name="dt" class="form-control col-12 " required='true'>
            </div>
            <button id="search-btn" class="btn btn-primary mb-2 ">Search</button>
          </form><br>
          <h4 class="card-title mb-sm-0" id="datemark" align=center><?php $date = $_GET['dt'];
          echo $date; ?></h4><br>

          <div class="table-responsive mb-2 border rounded p-1">
            <table class="table" id="dataTablefl08">
              <thead>
                <tr>
                  <th style="width: 3%;" class="font-weight-bold"></th>
                  <th style="width: 3%;" class="font-weight-bold">id</th>
                  <th style="width: 20%;" class="font-weight-bold">Product Name</th>
                  <!-- <th style="width: 10%;" class="font-weight-bold">Product type</th> -->
                  <th style="width: 13%;" class="font-weight-bold">Opening STK</th>
                  <th style="width: 13%;" class="font-weight-bold">Received</th>
                  <th style="width: 13%;" class="font-weight-bold">Balance</th>
                  <th style="width: 13%;" class="font-weight-bold">Unit Price</th>
                  <th style="width: 10%;" class="font-weight-bold">Sold</th>
                  <th style="width: %;" class="font-weight-bold">Sale Amout</th>
                </tr>
              </thead>
              <tbody>

                <?php

                $admin = "SELECT * FROM  invoice_rec where `date`='$date'";

                $admin_res = mysqli_query($conn, $admin);
                $row_admin = mysqli_num_rows($admin_res);
                if ($row_admin > 0 && $_SESSION['type'] == 'admin') {
                  $disabled = 'disabled';
                } else {
                  $disabled = '';
                }


                if (isset($_GET['dt'])) {
                  $date = $_GET['dt'];
                  $sql = "SELECT * FROM fl_08
                  INNER JOIN product ON product.product_id = fl_08.product_product_id 
                  INNER JOIN product_type ON product_type.type_id = product.`type` 
                  WHERE fl_08.`date` = '$date' 
                  ORDER BY product.`type`, product.product_id";
                  $result = mysqli_query($conn, $sql);

                  // Check if there are any rows under the given date
                  $total_rows = mysqli_num_rows($result);


                  if ($total_rows > 0) {
                    $count = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                      ?>
                      <tr>
                        <td>
                          <?php echo $count; ?>
                        </td>
                        <td class="product_id">
                          <?php echo ($row['id']); ?>
                        </td>
                        <td>
                          <?php echo $row['product_name']; ?>
                        </td>
                        <td class="open-stk">
                          <?php echo $row['op_stock']; ?>
                        </td>
                        <td class="received">
                          <?php echo $row['received']; ?>
                        </td>
                        <td>
                          <input id="balance-amount" type="text" style="height: 30px;" class="balance-amount form-control"
                            value=" <?php echo $row['balance']; ?>" required='true'>
                        </td>
                        <td class="unit_price">
                          <?php echo $row['unit_price']; ?>
                        </td>
                        <td class="sold-cell" id="balance_<?php echo $row['id']; ?>">
                          <?php  echo$row['sold']; ?>
                        </td>
                        <td class="sale-amount">
                          <?php  echo$row['sale_amount']; ?>
                        </td>
                      </tr>
                      <?php
                      $count = $count + 1;
                    }
                  }
                }
                ?>
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td>Total</td>
                  <td></td>
                  <td id="totaloft"></td>


                </tr>

              </tbody>
            </table>

          </div>

          <div align=right>
            <button <?php echo $disabled; ?> onclick="getTableRowDatafl08()" class="btn btn-primary mb-2"
              style="border-radius: 10px;">
              Update</button>
            <button <?php echo $disabled; ?> onclick="fl_08pdfsend()" class="btn btn-primary mb-2"
              style="border-radius: 10px;">
              Confirm</button>

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