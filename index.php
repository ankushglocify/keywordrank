<?php 
 include('./config/DbFunction.php');

	 $obj=new DbFunction();
	 $keywords = $obj->getKeyeordProduct();
   //echo "<pre>";
	 //print_r($keywords);die('test');

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
  <link  rel="stylesheet" type="text/css" href="./assets/css/style.css">  
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body>
<section class="productSection">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-sm-12">
        <div class="imgGraph">
          <div class="productImg">
            <img class="img-fluid" src="./assets/images/product-1.jpg" alt=""/>
          </div>
          <div class="graph">
            <ul class="nav nav-pills" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active dynagraph" data-id=""  data-day="1" data-toggle="pill" href="#home">D</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link dynagraph" data-id="" data-day="7" data-toggle="pill" href="#home">W</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link dynagraph" data-id="" data-dat="30" data-toggle="pill" href="#home">M</a>
                </li>
              </ul>
              <div class="tab-content">
                <div id="home" class="tab-pane active">
                  <canvas id="myChart" style="width:100%;max-width:712px"></canvas>
                </div>
                <div id="menu1" class="tab-pane fade">
                  <canvas id="myChart1" style="width:100%;max-width:712px"></canvas>
                </div>
                <div id="menu2" class="tab-pane fade">
                  <canvas id="myChart2" style="width:100%;max-width:712px"></canvas>
                </div>
              </div> 
          </div>
        </div>
      </div>
      <!-- <div class="col-md-12 col-sm-12">
         <div class="addBtns">
            <button type="button" class="btn btn-default addUserBtn" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-file-import"></i> <span>Import</span></button>
          </div>
      </div> -->
      <div class="col-md-12 col-sm-12">
        <div class="selectButtons">
          <div class="storeBtn">
          <!--  <button type="button" class="btn btn-primary">Store</button>
           <button type="button" class="btn btn-primary">Keyword</button> -->
          </div>
         
          <div class="addNewBtn">
            <button type="button" class="btn btn-default addUserBtn" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-file-import"></i> <span>Import</span></button>
          <!--  <button type="button" class="btn btn-primary"><i class="fas fa-plus"></i> Add New</button> -->
          </div>
        </div>
      </div>
      <?php 
        foreach ($keywords as $keyw => $keyword) {
          
         ?>

            <div class="col-lg-6 col-md-12 col-sm-12">
              <div class="seasonDress">
               <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th colspan="4"><?php echo $keyw;?></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      foreach ($keyword as $key => $value) { 

                        $rankRatio = $obj->rankRatio($value[0],$value[2],$keyw);
                        //print_r($rankRatio);die
                        ?>

                      <tr class="graph_id" data-id ="<?php echo $value[2];?>">
                        <td><span class="bigText"><?php echo $value[0];?></span></td>
                        <td><img class="img-fluid" src="<?php echo $value[8];?>" alt=""/></td>
                        <td><span><?php echo $value[3];?></span></td>

                        <?php 
                        $class = "";
                          $icon = '';
                          $rightRank ='' ;
                        if($rankRatio > $value[0]){
                          $class = "greentext";
                          $icon = '<i class="fas fa-caret-up"></i>';
                          $rightRank = $rankRatio - $value[0] ;
                          }elseif ($rankRatio < $value[0]) {
                            $class = "redText";
                            $icon = '<i class="fas fa-caret-down"></i>';
                            $rightRank =  $value[0] - $rankRatio ;
                          }elseif ($rankRatio == $value[0]) {
                            $class = "greyText";
                            $icon = '<i class="fas fa-equals"></i>';
                          }else {
                            $class = "yellowtext";
                            $rightRank ="New";
                          }
                        ?>
                        <td><span class="<?php echo $class; ?>"><?php echo $icon; ?></span> <span class="<?php echo $class; ?>"><?php echo $rightRank; ?></span></td>
                        
                      </tr>
                      
                      <?php
                    }
                    ?>
                    <tr>
                        <td colspan="4"><span>Last update 2021/04/06 02:22PM</span></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>


          <?php
        }
      ?>
      <div class="col-lg-6 col-md-12 col-sm-12">
        <div class="seasonDress">
         <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th colspan="4">Summer Dress</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><span class="bigText">8</span></td>
                  <td><img class="img-fluid" src="./assets/images/product.jpg" alt=""/></td>
                  <td><span>V Neck Cool Summer Dress</span></td>
                  <td><span class="greentext"><i class="fas fa-caret-up"></i></span> <span class="greentext">6</span></td>
                </tr>
                <tr>
                  <td><span class="bigText">15</span></td>
                  <td><img class="img-fluid" src="./assets/images/product.jpg" alt=""/></td>
                  <td><span>V Neck Cool Summer Dress</span></td>
                  <td><span class="redText"><i class="fas fa-caret-down"></i></span> <span class="redText">6</span></td>
                </tr>
                <tr>
                  <td><span class="bigText">19</span></td>
                  <td><img class="img-fluid" src="./assets/images/product.jpg" alt=""/></td>
                  <td><span>V Neck Cool Summer Dress</span></td>
                  <td><span class="yellowtext">NEW</span></td>
                </tr>
                <tr>
                  <td><span class="bigText">27</span></td>
                  <td><img class="img-fluid" src="./assets/images/product.jpg" alt=""/></td>
                  <td><span>V Neck Cool Summer Dress</span></td>
                  <td><span class="greyText"><i class="fas fa-equals"></i></span></td>
                </tr>
                <tr>
                  <td colspan="4"><span>Last update 2021/04/06 02:22PM</span></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    <!--   <div class="col-lg-6 col-md-12 col-sm-12">
        <div class="seasonDress">
         <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th colspan="4">Summer Dress</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><span class="bigText">8</span></td>
                  <td><img class="img-fluid" src="./assets/images/product.jpg" alt=""/></td>
                  <td><span>V Neck Cool Summer Dress</span></td>
                  <td><span class="greentext"><i class="fas fa-caret-up"></i></span> <span class="greentext">6</span></td>
                </tr>
                <tr>
                  <td><span class="bigText">15</span></td>
                  <td><img class="img-fluid" src="./assets/images/product.jpg" alt=""/></td>
                  <td><span>V Neck Cool Summer Dress</span></td>
                  <td><span class="redText"><i class="fas fa-caret-down"></i></span> <span class="redText">6</span></td>
                </tr>
                <tr>
                  <td><span class="bigText">19</span></td>
                  <td><img class="img-fluid" src="./assets/images/product.jpg" alt=""/></td>
                  <td><span>V Neck Cool Summer Dress</span></td>
                  <td><span class="yellowtext">NEW</span></td>
                </tr>
                <tr>
                  <td><span class="bigText">27</span></td>
                  <td><img class="img-fluid" src="./assets/images/product.jpg" alt=""/></td>
                  <td><span>V Neck Cool Summer Dress</span></td>
                  <td><span class="greyText"><i class="fas fa-equals"></i></span></td>
                </tr>
                <tr>
                  <td colspan="4"><span>Last update 2021/04/06 02:22PM</span></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div> -->
     <!--  <div class="col-lg-6 col-md-12 col-sm-12">
        <div class="seasonDress">
         <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th colspan="4">Summer Dress</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><span class="bigText">8</span></td>
                  <td><img class="img-fluid" src="./assets/images/product.jpg" alt=""/></td>
                  <td><span>V Neck Cool Summer Dress</span></td>
                  <td><span class="greentext"><i class="fas fa-caret-up"></i></span> <span class="greentext">6</span></td>
                </tr>
                <tr>
                  <td><span class="bigText">15</span></td>
                  <td><img class="img-fluid" src="./assets/images/product.jpg" alt=""/></td>
                  <td><span>V Neck Cool Summer Dress</span></td>
                  <td><span class="redText"><i class="fas fa-caret-down"></i></span> <span class="redText">6</span></td>
                </tr>
                <tr>
                  <td><span class="bigText">19</span></td>
                  <td><img class="img-fluid" src="./assets/images/product.jpg" alt=""/></td>
                  <td><span>V Neck Cool Summer Dress</span></td>
                  <td><span class="yellowtext">NEW</span></td>
                </tr>
                <tr>
                  <td><span class="bigText">27</span></td>
                  <td><img class="img-fluid" src="./assets/images/product.jpg" alt=""/></td>
                  <td><span>V Neck Cool Summer Dress</span></td>
                  <td><span class="greyText"><i class="fas fa-equals"></i></span></td>
                </tr>
                <tr>
                  <td colspan="4"><span>Last update 2021/04/06 02:22PM</span></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div> -->
    </div>
  </div>
  <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Import Products</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <!-- Form -->
        <form method='post' action='import.php' enctype="multipart/form-data" id="import_form">
          Select file : <input type='file' name='file' id='file_import' class='form-control' required ><br>
        </form>

        <!-- Preview-->
        <div id='preview'></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id='btn_upload'>Upload</button>
        
      </div>
    </div>
  </div>
</div>
</section>
  <script src="./assets/js/jquery.min.js"></script>
  <script src="./assets/js/popper.min.js"></script>
  <script src="./assets/js/bootstrap.min.js"></script>
  <script src="./assets/js/custom.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
  <!-- <script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script> -->
  <script>
    jQuery('.graph_id').on('click',function(e){
      var id = jQuery(this).data('id');
      jQuery.ajax({
            type: 'post',
            url: 'graph.php',
            dataType: "json",
            crossDomain : true,
            data: {
              "product_id": id
            },
            success: function ( data ) {
              var xValues = data.xdata;
              var yValues = data.ydata;
              var max = data.max;
              jQuery(".dynagraph").attr('data-id',id);
            new Chart("myChart", {
                type: "line",
                data: {
                  labels: xValues,
                  datasets: [{
                    fill: false,
                    lineTension: 0,
                    backgroundColor: "rgba(0,0,255,1.0)",
                    borderColor: "rgba(0,0,255,0.1)",
                    data: yValues
                  }]
                },
                options: {
                  legend: {display: false},
                  scales: {
                    yAxes: [{ticks: {min: 0, max:max}}],
                  }
                }
              });
            }
          });
    });
      var xValues = [50,60,70,80,90,100,110,120,130,140,150];
      var yValues = [7,8,8,9,9,9,10,11,14,14,15];

      new Chart("myChart", {
        type: "line",
        data: {
          labels: xValues,
          datasets: [{
            fill: false,
            lineTension: 0,
            backgroundColor: "rgba(0,0,255,1.0)",
            borderColor: "rgba(0,0,255,0.1)",
            data: yValues
          }]
        },
        options: {
          legend: {display: false},
          scales: {
            yAxes: [{ticks: {min: 0, max:18}}],
          }
        }
      });
      </script>
      <script>
      var xValues = [50,60,70,80,90,100,110,120,130,140,150];
      var yValues = [7,8,8,9,9,9,10,11,14,14,15];

      new Chart("myChart1", {
        type: "line",
        data: {
          labels: xValues,
          datasets: [{
            fill: false,
            lineTension: 0,
            backgroundColor: "rgba(0,0,255,1.0)",
            borderColor: "rgba(0,0,255,0.1)",
            data: yValues
          }]
        },
        options: {
          legend: {display: false},
          scales: {
            yAxes: [{ticks: {min: 6, max:16}}],
          }
        }
      });
      </script>
      <script>
      var xValues = [50,60,70,80,90,100,110,120,130,140,150];
      var yValues = [7,8,8,9,9,9,10,11,14,14,15];

      new Chart("myChart2", {
        type: "line",
        data: {
          labels: xValues,
          datasets: [{
            fill: false,
            lineTension: 0,
            backgroundColor: "rgba(0,0,255,1.0)",
            borderColor: "rgba(0,0,255,0.1)",
            data: yValues
          }]
        },
        options: {
          legend: {display: false},
          scales: {
            yAxes: [{ticks: {min: 6, max:16}}],
          }
        }
      });
      </script>
  </body>
</html>
