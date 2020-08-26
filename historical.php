<?php
require_once("connection.php");
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="LiveExchangeRate">
    <meta name="description" content="A currency exchange service for latest currency exchange for Nigeria, USA, African countries, Europe, America and Asia">
    <meta name="author" content="">

    <title>Extambaya</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/unicons.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">

    <!-- MAIN STYLE -->
    <link rel="stylesheet" href="css/tooplate-style.css">

<!--

Tooplate 2115 Marvel

https://www.tooplate.com/view/2115-marvel

-->

<script>
function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 1; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];

    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>


<style>

  #costom-table{
    border: 1px, red;
    color:blue;
  }

  #scrolltable {
     margin-top: 20px;
     height: 200px;
     overflow: auto;
}
#scrolltable thead h4 {
     position: absolute;
     margin-top: -20px;
}

 </style>

</head>

<body>

    <!-- MENU -->
    <nav class="navbar navbar-expand-sm navbar-light">
        <div class="container">
            <a class="navbar-brand" href="index.php"><i class="display-5"><code>ex</code></i><b class="display-6 text-danger">tambaya</b></a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav mx-auto">
                  <li class="nav-item">
                      <a href="about.php" class="nav-link"><span data-hover="About"><small class="small-text">About</small></span></a>
                  </li>
                  <li class="nav-item">
                      <a href="index.php" class="nav-link"><span data-hover="Live Rates"><small class="small-text">Live Rates</small></span></a>
                  </li>
                  <li class="nav-item">
                      <a href="historical.php" class="nav-link"><span data-hover="Historical"><small class="small-text">Historical</small></span></a>
                  </li>
                  <li class="nav-item">
                      <a href="privacy.php" class="nav-link"><span data-hover="Privacy"><small class="small-text">Privacy</small></span></a>
                  </li>
                  <li class="nav-item">
                      <a href="contact.php" class="nav-link"><span data-hover="Contact"><small class="small-text">Contact</small></span></a>
                  </li>
              </ul>
            </div>
        </div>
    </nav>


    <!-- Live Panel -->
    <section class="project py-5" id="project">
        <div class="container">

          <div class="row">
            <div class="col-lg-2 text-center mx-auto col-2 text-success">
              <div class="owl-carouse owl-theme">
                <?php
                if(isset($_GET['filter'])){
                  if(preg_match("/[A-Za-z]{3,5}/", $_GET['base'])){
                      $base = trim($_GET['base']);
                  }
                  if(isset($_GET['date'])){
                    $v_date = date("Y-m-d", strtotime($_GET['date']));
                    $_SESSION['v_date'] = $v_date;
                        //$v_date = $_GET['date'];
                  }

                }else{
                  $base = "EUR";
                  //$v_date = date("Y-m-d");
                }
                if(isset($_GET['calculate'])){
                  if(isset($_GET['amount'])){
                      if(preg_match("/[0-9]/", $_GET['amount'])){
                        $v_amount = $_GET['amount'];
                      }
                  }
                  if(isset($_GET['from'])){
                    if(preg_match("/[A-Z]{3,5}/", $_GET['from'])){
                      $v_from = $_GET['from'];
                    }
                  }
                  if(isset($_GET['to'])){
                    if(preg_match("/[A-Z]{3,5}/", $_GET['to'])){
                      $v_to = $_GET['to'];
                    }
                  }
                  if(isset($v_amount) and ((isset($v_from)) and isset($v_to))){
                    //$url = "https://api.exchangeratesapi.io/latest?base=$v_from";
                    if(isset($_SESSION['v_date'])){
                      $v_date = $_SESSION['v_date'];
                    }else{
                      $v_date = date("Y-m-d");
                    }

                    $url = "https://api.exchangeratesapi.io/$v_date?base=$v_from";
                      $data = Connection::getRate($url);

                    if($data[0] == 1){
                      $fromval = $v_from;
                      $toval = $v_to;
                      $amount = $v_amount;
                      $c_value = $data[1]['rates'][$v_to] * $v_amount;
                    }
                  }

                }
                if(isset($_SESSION['v_date'])){
                  $v_date = $_SESSION['v_date'];
                }else{
                  $v_date = date("Y-m-d");
                }
                  $url = "https://api.exchangeratesapi.io/$v_date?base=$base";

                  $data = Connection::getRate($url);

                if($data[0] == 1){
                  //print_r($data[1]);

                ?>
                <form method="GET" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
              <div class="form-group">
                <p><input type="number" name="amount" value="<?php if(isset($amount)) echo $amount; else echo 1; ?>" class="form-control bg-dark"></p>
                <p><select name="from" class="form-control">
                  <?php
                  foreach($data[1]['rates'] as $key => $value){?>
                    <option value='<?php echo $key; ?>' <?php if (isset($fromval) and $fromval==$key) echo "selected='selected'"; ?>><?php echo $key; ?></option>";
                  <?php } ?>
                </select></p>

                <select name="to" class="form-control"><p>
                  <?php
                  foreach($data[1]['rates'] as $key => $value){?>
                    <option value='<?php echo $key; ?>' <?php if (isset($toval) and $toval==$key) echo "selected='selected'"; ?>><?php echo $key; ?></option>";
                  <?php } ?>
                </select></p>
                <p><input type="submit" name="calculate" class="form-control bg-dark" value="Calculate"></p>
              <?php } ?>
                <div class="container">
                  <p class="text-success"><?php if(isset($c_value)) echo $c_value; else if($data[0] == 1) echo 0; ?>

                </div>

              </div>
            </div>
          </div>


            <div class="col-lg-8 text-center mx-auto col-8">

                <div class="col-lg-8 mx-auto">
                <div class="owl-carouse owl-theme">
                  <div class="container"><small class="small-text text-warning">Historical Rates</small></div>
                  <?php

                    if($data[0] == 1){ ?>

                       <table class='table' id='myTable'>
                       <tr>
                         <td><input type="date" name="date" class="form-control" value="<?php if(isset($_SESSION['v_date'])) echo $_SESSION['v_date']; else echo $v_date; ?>"></td>
                       </tr>
                       <tr>
                         <th><input type='text' onkeyup='myFunction()' id="myInput" placeholder='search' class="form-control form-control-sm"></th>
                         <th><select class='form-control form-control-sm' name='base'>
                           <?php
                           foreach($data[1]['rates'] as $key => $value){?>
                             <option value='<?php echo $key; ?>' <?php if (isset($base) and $base==$key) echo "selected='selected'"; ?>><?php echo $key; ?></option>";
                           <?php } ?>
                      </select></th>
                        <th><input type='submit' name='filter' value='Filter' class='form-control  form-control-sm' onkeyup='myFunction()'></th>
                      </tr>
                      <tr>
                        <th><small class="small-text">Currency</small></th>
                        <th><small class="small-text">Rate</small></th>
                        <th><small class="small-text">Inflation</small></th>
                      </tr>
                      <?php
                      foreach($data[1]['rates'] as $key => $value){
                        ?>
                        <tr class="text-success">
                          <td><small><?php echo $key; ?></small></td>
                          <td><small><?php echo $value; ?></small></td>
                          <td><small><?php echo $value/100; ?></small></td>
                        </tr>
                      <?php } ?>
                      </table>
                       </form>
                    <?php
                    }else if ($data[0] == 0){
                      //echo $data[1];
                      echo "<div><a href='historical.php'>Refresh</a></div>";
                    }
                    ?>
                </div>
          </div>
        </div>

        <div class="col-lg-1 col-lg-1 col-xs-1 col-sm-1 text-center mx-auto col-1">
          <div class="owl-carouse owl-theme">
            <div class="container"><img class="img img-round" src='images/custom/myads.png'></container>
          </div>
        </div>
      </div>

      </div>
      </div>
    </section>

    <!-- ABOUT -->
    <section class="about full-screen d-lg-flex justify-content-center align-items-center" id="about">
        <div class="container">
            <div class="row">

                <div class="col-lg-7 col-md-12 col-12 d-flex align-items-center">
                    <div class="about-text">
                        <small class="small-text">Welcome to <span class="mobile-block">live exchange rates platform</span></small>
                        <h1 class="animated animated-text">
                            <span class="mr-2">We are</span>
                                <div class="animated-info">
                                    <span class="animated-item">extambaya</span>
                                    <span class="animated-item">extambaya</span>
                                    <span class="animated-item">extambaya</span>
                                </div>
                        </h1>

                        <p>We are open to contributions. If you have question or suggestion in our services, feel free to email us via the <a href="contact.php"><span class="text-warning">contact</span></a> section </p>

                        <div class="custom-btn-group mt-4">
                          <a href="index.php" class="btn custom-btn custom-btn-bg custom-btn-link">Live rate</a>
                          <a href="historical.php" class="btn custom-btn custom-btn-bg custom-btn-link">Historical</a>
                          <a href="contact.php" class="btn custom-btn custom-btn-bg custom-btn-link">Contact us</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5 col-md-12 col-12">
                    <div class="about-image svg">
                        <img src="images/undraw/undraw_software_engineer_lvl5.svg" class="img-fluid" alt="svg image">
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- FOOTER -->
     <footer class="footer py-5">
          <div class="container">
               <div class="row">

                    <div class="col-lg-12 col-12">
                        <p class="copyright-text text-center">Copyright &copy; 2019 extambaya . All rights reserved</p>
                    </div>

               </div>
          </div>
     </footer>

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/Headroom.js"></script>
    <script src="js/jQuery.headroom.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/smoothscroll.js"></script>
    <script src="js/custom.js"></script>

  </body>
</html>
