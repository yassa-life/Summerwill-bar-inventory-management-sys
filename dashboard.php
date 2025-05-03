<?php include_once ('includes/check_session.php'); ?>
<?php include_once ('includes/header.php'); ?>
<?php include ('includes/dbconnection.php'); ?>
<div class="container-fluid page-body-wrapper">
  <?php include_once ('includes/sidebar.php'); ?>

  <?php

  $date_rela = "SELECT *
  FROM fl_08
INNER JOIN invoice_rec ON invoice_rec.date = fl_08.date
WHERE fl_08.date = (SELECT MAX(`date`) FROM invoice_rec)";
  $data_rw = mysqli_query($conn, $date_rela);

  $bottlec = "SELECT COUNT(product.product_id) AS `COUNT` FROM product";
  $bottlecc = mysqli_query($conn, $bottlec);
  $bottlecount = mysqli_fetch_assoc($bottlecc);

  $dataarra = [];
  while ($row = mysqli_fetch_assoc($data_rw)) {
    $dataarra[] = $row;
  }



  ?>

  <div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-md-12 grid-margin">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="d-sm-flex align-items-baseline report-summary-header">
                    <h5 class="font-weight-semibold">Report Summary</h5> <span class="ml-auto">Updated Report</span>
                    <button class="btn btn-icons border-0 p-2"><i class="icon-refresh"></i></button>
                  </div>
                </div>
              </div>
              <div class="row ">
                <div class=" col-md-6 report-inner-cards-wrapper">
                  <div class="report-inner-card color-1">
                    <div class="inner-card-text text-white">
                      <span class="report-title">Total Bottles</span>
                      <h4 style="margin-top: 5px;"><?php echo ($bottlecount['COUNT']) ?></h4>
                    </div>
                    <div class="inner-card-icon">
                      <i class="icon-rocket"></i>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 report-inner-cards-wrapper">
                  <div class="report-inner-card color-2">
                    <div class="inner-card-text text-white">
                      <span class="report-title">Total sales</span>
                      <h4 style="margin-top: 5px;"><?php echo ('Rs ' . $dataarra[0]['income'] . '/-') ?></h4>
                    </div>
                    <div class="inner-card-icon ">
                      <i class="icon-user"></i>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 report-inner-cards-wrapper">
                  <div class="report-inner-card color-3">
                    <div class="inner-card-text text-white">
                      <span class="report-title">Last Updated Day</span>
                      <h4 style="margin-top: 5px;"><?php echo ($dataarra[0]['date']) ?></h4>
                    </div>
                    <div class="inner-card-icon ">
                      <i class="icon-doc"></i>
                    </div>
                  </div>
                </div>
              </div>
              <div  style="margin-top: 45px;">

                <canvas id="myChart" style="width:100%; height: 400px;"></canvas>
              </div>
            </div>
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
<script>

  function getdata() {
    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
      if (request.readyState == 4 && request.status == 200) {
        console.log("Raw response:", request.responseText);  // Log the raw response

        var response;
        try {
          response = JSON.parse(request.responseText.trim());
        } catch (e) {
          console.error("Error parsing JSON:", e);
          alert('Error parsing server response');
          return;
        }

        console.log("Parsed response:", response);  // Log the parsed response

        if (response.dateside && response.incomeside) {
          var xValues = response.dateside;
          var yValues = response.incomeside;

          // Log the values to the console
          // console.log("xValues:", xValues);
          // console.log("yValues:", yValues);

          new Chart("myChart", {
            type: "line",
            data: {
              labels: xValues,
              datasets: [{
                fill: false,
                lineTension: 0,
                backgroundColor: "rgb(102, 50, 0)",
                borderColor: "rgb(255, 204, 0)",
                data: yValues
              }]
            },
            options: {
              legend: { display: false },
              scales: {
                xAxes: [{
                  ticks: {
                    min: 1,
                    max: 10,
                    fontColor: 'rgb(1, 153, 52)' // Specify the color as a string
                  }
                }],
                yAxes: [{
                  ticks: {
                    fontColor: 'rgb(1, 153, 52)' // Specify the color as a string
                  }
                }]
              }
            }
          });
        } else {
          console.error("Response does not contain expected data");
          alert('No data found');
        }
      }
    };
    request.open("POST", "process/tabledata.php", true);
    request.send();
  }

  getdata();

  // const xValues = [50, 60, 70, 80, 90, 100, 110, 120, 130, 140, 150];
  // const yValues = [7, 8, 8, 9, 9, 9, 10, 11, 14, 14, 15];

  // new Chart("myChart", {
  //   type: "line",
  //   data: {
  //     labels: xValues,
  //     datasets: [{
  //       fill: false,
  //       lineTension: 0,
  //       backgroundColor: "rgba(0,0,255,1.0)",
  //       borderColor: "rgba(0,0,255,0.1)",
  //       data: yValues
  //     }]
  //   },
  //   options: {
  //     legend: { display: false },
  //     scales: {
  //       yAxes: [{ ticks: { min: 6, max: 16 } }],
  //     }
  //   }
  // });
</script>