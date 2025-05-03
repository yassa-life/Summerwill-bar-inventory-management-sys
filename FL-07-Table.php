<?php include_once ('includes/check_session.php'); ?>
<?php include ('includes/dbconnection.php'); ?>
<?php include_once ('includes/header.php'); ?>
<!-- <div class="container-fluid page-body-wrapper"> -->

<!-- Loading indicator -->
<!-- Loading indicator with full-screen background -->
<div id="preloader1"></div>


<!-- <div class="main-panel"> -->
<div class="content-wrapper">
  <div class="page-header">
    <h3 class="page-title"> Manage Class </h3>
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





          <form action="FL-07-Table.php" class="form-inline" method="get">
            <div class="form-group mx-sm-3 col-md-4 mb-2">
              <input type="date" id="date" name="dt" class="form-control col-12 " required='true'>
            </div>
            <button id="search-btn" style="border-radius: 10px;" class="btn btn-primary mb-2 ">Search</button>
            <div style="position: absolute; right: 0;">

              <a href="Dashboard.php" style="border-radius: 10px;" class="btn btn-primary mb-2 ">Home</a>
              <a href="FL-08-Table.php?dt=<?php $date = $_GET['dt'];
              echo htmlentities($date); ?>" style="border-radius: 10px;" class="btn btn-primary mb-2">Fl_08</a>


            </div>
          </form><br>
          <h4 class="card-title mb-sm-0" id="datemark" align=center><?php $date = $_GET['dt'];
          echo $date; ?></h4><br>

          <div class="table-responsive mb-2 border rounded p-1">
            <table class="table" id="dataTablefl07">
              <thead>
                <tr>
                  <th style="width: 3%;" class="font-weight-bold"></th>
                  <th style="width: 3%;" class="font-weight-bold">id</th>
                  <th style="width: 22%;" class="font-weight-bold">Product Name</th>
                  <!-- <th style="width: 7%;" class="font-weight-bold">type</th> -->
                  <th style="width: 10%;" class="font-weight-bold">Opening STK</th>
                  <th style="width: 13%;" class="font-weight-bold">Received</th>
                  <th style="width: 13%;" class="font-weight-bold">To FL 08</th>
                  <th style="width: 10%;" class="font-weight-bold">Balance</th>
                  <th style="width: %;" class="font-weight-bold">Remark</th>
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
                  $sql = "SELECT * FROM fl_07 
                  INNER JOIN product ON product.product_id = fl_07.product_product_id 
                  INNER JOIN product_type ON product_type.type_id = product.`type` 
                  WHERE fl_07.`date` = '$date' 
                  ORDER BY product.`type`";

                  $result = mysqli_query($conn, $sql);
                  $total_rows = mysqli_num_rows($result);
                  if ($total_rows > 0) {
                    $count = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                      ?>
                      <tr style="height: 20px;">
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
                        <td>
                          <input id="<?php echo $row['id']; ?>" type="text" style="height: 30px;"
                            class="received-input form-control" value="<?php echo $row['received']; ?>" required='true'>
                        </td>
                        <td>
                          <input id="to_fl08_<?php echo $row['id']; ?>" type="text" style="height: 30px;"
                            class="to-fl08-input form-control" value="<?php echo $row['to_fl_08']; ?>" required='true'>
                        </td>
                        <td class="balance-cell" id="balance_<?php echo $row['id']; ?>">
                          <?php echo $row['balance']; ?>
                        </td>
                        <td>
                          <textarea name="address" style="height: 30px;"
                            class="form-control"><?php echo $row['remark']; ?></textarea>
                        </td>
                      </tr>
                      <?php
                      $count = $count + 1;
                    }
                  } else {

                    $previous_date = date('Y-m-d', strtotime('-1 day', strtotime($date)));
                    $sql_previous = "SELECT * FROM `fl_07` WHERE date='$previous_date'";
                    $result_previous = mysqli_query($conn, $sql_previous);
                    $total_rows_previous = mysqli_num_rows($result_previous);

                    if ($total_rows_previous > 0) {

                      $sql_getdata = "SELECT * FROM `fl_07` WHERE date='$previous_date'";
                      $result_getdata = mysqli_query($conn, $sql_getdata);

                      if ($result_getdata) {



                        while ($rows_data = mysqli_fetch_assoc($result_getdata)) {
                          $product_id = $rows_data['product_product_id'];
                          $balance = $rows_data['balance'];


                          $sql_insert = "INSERT INTO `fl_07` (`date`,`product_product_id`,`op_stock`,`balance`) VALUES ('$date','$product_id','$balance','$balance') ";

                          if ($conn->query($sql_insert) === FALSE) {
                            echo "Error: " . $sql_insert . "<br>" . $conn->error;
                          }
                        }


                        $sql = "SELECT * FROM fl_07 
                        INNER JOIN product ON product.product_id = fl_07.product_product_id 
                        INNER JOIN product_type ON product_type.type_id = product.`type` 
                        WHERE fl_07.`date` = '$date' 
                        ORDER BY product.`type`";
                        $result = mysqli_query($conn, $sql);
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
                              <td>
                                <input id="<?php echo $row['id']; ?>" type="text" style="height: 30px;"
                                  class="received-input form-control" value="<?php echo $row['received']; ?>" required='true'>
                              </td>
                              <td>
                                <input id="to_fl08_<?php echo $row['id']; ?>" type="text" style="height: 30px;"
                                  class="to-fl08-input form-control" value="<?php echo $row['to_fl_08']; ?>" required='true'>
                              </td>
                              <td class="balance-cell" id="balance_<?php echo $row['id']; ?>">
                                <?php echo $row['balance']; ?>
                              </td>
                              <td>
                                <textarea name="address" style="height: 30px;"
                                  class="form-control"><?php echo $row['remark']; ?></textarea>
                              </td>
                            </tr>
                            <?php
                            $count = $count + 1;
                          }
                        }





                      } else {
                        echo "Error fetching previous data: " . mysqli_error($conn);
                      }


                    }
                  }
                }
                ?>

                <?php
                if (isset($_GET['dt'])) {
                  $date = $_GET['dt'];
                  $sql = "SELECT * FROM `fl_08` INNER JOIN product ON product.product_id=fl_08.product_product_id WHERE fl_08.date='$date'";
                  $result = mysqli_query($conn, $sql);

                  // Check if there are any rows under the given date
                  $total_rows = mysqli_num_rows($result);
                  if ($total_rows > 0) {

                  } else {

                    $previous_date = date('Y-m-d', strtotime('-1 day', strtotime($date)));
                    $sql_previous = "SELECT * FROM `fl_08` WHERE `date`='$previous_date'";
                    $result_previous = mysqli_query($conn, $sql_previous);
                    $total_rows_previous = mysqli_num_rows($result_previous);

                    if ($total_rows_previous > 0) {

                      $sql_getdata = "SELECT * FROM `fl_08` WHERE `date`='$previous_date'";
                      $result_getdata = mysqli_query($conn, $sql_getdata);

                      if ($result_getdata) {



                        while ($rows_data = mysqli_fetch_assoc($result_getdata)) {
                          $product_id = $rows_data['product_product_id'];
                          $balance = $rows_data['balance'];


                          $sql_insert = "INSERT INTO `fl_08` (`date`,`product_product_id`,`op_stock`) VALUES ('$date','$product_id','$balance') ";

                          if ($conn->query($sql_insert) === FALSE) {
                            echo "Error: " . $sql_insert . "<br>" . $conn->error;
                          }
                        }
                      } else {
                        echo "Error fetching previous data: " . mysqli_error($conn);
                      }


                    } else {

                      ?>
                      <tr>
                        <td colspan="5">No data available for the selected date or the previous date.</td>
                        <td colspan="4">
                          <div align=right>
                            <button onclick="force_update()" class="btn btn-primary mb-2" style="border-radius: 10px;">Force
                              Update</button>
                          </div>
                        </td>
                      </tr>

                      <?php
                    }
                  }
                }
                ?>

              </tbody>
            </table>


          </div>

          <div align=right>
            <button <?php echo $disabled; ?> onclick="function2()" class="btn btn-primary mb-2"
              style="border-radius: 10px;">
              Update</button>

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