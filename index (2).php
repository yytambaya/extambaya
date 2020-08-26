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
  for (i = 0; i < tr.length; i++) {
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
            <a class="navbar-brand" href="index.php"><i class='uil uil-user'></i> extambaya</a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a href="about.html" class="nav-link"><span data-hover="About"><small>About me</small></span></a>
                    </li>
                    <li class="nav-item">
                        <a href="index.php" class="nav-link"><span data-hover="Live Exchange Rate">Live Exchange Rate</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="privacy.html" class="nav-link"><span data-hover="Privacy">Privacy</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="contact.php" class="nav-link"><span data-hover="Contact">Contact</span></a>
                    </li>
                </ul>

                <ul class="navbar-nav ml-lg-auto">
                    <div class="ml-lg-4">
                      <div class="color-mode d-lg-flex justify-content-center align-items-center">
                        <i class="color-mode-icon"></i>
                        Color mode
                      </div>
                    </div>
                </ul>
            </div>
        </div>
    </nav>


    <!-- Live Panel -->
    <section class="project py-5" id="project">
        <div class="container">

                <div class="row">
                  <div class="col-lg-11 text-center mx-auto col-12">

                      <div class="col-lg-8 mx-auto">

                      </div>

                      <div class="owl-carouse owl-theme">
                          <div class="container">

                             <?php
                                try{
                                  if(isset($_GET['Apply'])){
                                    $base = $_GET['base'];
                                  }
                                  else {
                                    $base = "USD";
                                  }
                                $url = "http://data.fixer.io/api/latest?access_key=9cdcc42d8b92a09543230f744627a509";
                                $data = file_get_contents($url);
                                $info = json_decode($data);
                                //print_r($info);
                                echo "Base currency: ".$info->base."</br>";
                                //echo "Last updated: ".$info->date."</br>";
                                //echo "Current base currency: ".$info->rates->USD."</br>";
                                echo "<h4 class='text-danger'>Live Currency Exchange</h4>";

                              ?>
                              <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
                              <div class="row">
                                <div class="col">
                                  <div>
                                  <input type="text" id="myInput" class="form-control" onkeyup="myFunction()" placeholder="Search"/>
                                </div>
                                </div>
                                <div class="col-md">
                                      <select class="form-control" name="base">
                                          <option value="USD">USD</option>
                                          <option value="EUR">EUR</option>
                                          <option VALUE="NGR">NGR</option>
                                      </select>
                                      <input type="submit" name="Apply" class="form-control" value="Apply">
                                </div>
                                </div>
                              </div>

                            </div>

                              <div id="scrolltable" class="container">
                              <table id="myTable" class="table table-stripped table-bordered">
                                <thead></thead>
                                <tbody >
                                  <tr class="bg-danger">
                                    <th class="text-white" >Currency</th>
                                    <th class="text-white" >Rate</th>
                                    <!--<th class="text-white" >Percentile</th>-->
                                  </tr>


                                    <?php
                                        foreach($info->rates as $key => $value){
                                      ?>
                                    <tr>
                                      <td class="text-danger" ><?php echo $key; ?></td>
                                      <td class="text-danger" ><?php echo $value; ?></td>
                                      <!--<td class="text-danger" ><?php echo ($value/$info->rates->EUR)*100;?></td>!-->
                                    </tr>
                                  <?php } ?>


                                </tbody>
                              </div>
                              </table>
                            <?php }catch(Exception $e){
                              echo "<h1>No internet connection</h1>";
                            }?>
                          </div>

                      </div>

                  </div>

                  <div class="row">
                  <div class="col-md-8">
                      <div class="container">
                        <?php

                        $url = "http://data.fixer.io/api/convert?access_key=9cdcc42d8b92a09543230f744627a509&from=GBP&to=JPY&amount=25";
                        $data = file_get_contents($url);
                        $info = json_decode($data);
                        print_r($info);
                        ?>

                      </div>
                  </div>
                  <div class="col-md-6">
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
                        <small class="small-text">Welcome to <span class="mobile-block">my portfolio website!</span></small>
                        <h1 class="animated animated-text">
                            <span class="mr-2">Hey folks, I'm</span>
                                <div class="animated-info">
                                    <span class="animated-item">LiveCurrencies</span>
                                    <span class="animated-item">LiveCurrencies</span>
                                    <span class="animated-item">LiveCurrencies</span>
                                </div>
                        </h1>

                        <p>Building a successful product is a challenge. I am highly energetic in user experience design, interfaces and web development.</p>

                        <div class="custom-btn-group mt-4">
                          <a href="#contact" class="btn custom-btn custom-btn-bg custom-btn-link">USA currency</a>
                          <a href="#contact" class="btn custom-btn custom-btn-bg custom-btn-link">Nigrian currency</a>
                          <a href="#contact" class="btn custom-btn custom-btn-bg custom-btn-link">Top currencies</a>
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
                        <p class="copyright-text text-center">Copyright &copy; 2019 LiveExchangeRate . All rights reserved</p>
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
