<?php
include('h.php');
include("../condb.php");

?>
<!DOCTYPE html>

<head>
    <?php include('../boot5.php');?>
</head>

<body>
    <?php
  include('navbar.php');
  ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12" style="margin-top: 10px">
                <div class="row">
                    <?php
                    $act = (isset($_GET['act']) ? $_GET['act'] : '');
                    if($act == 'detail'){
                    include('track_form_detail.php');
                    }else if($act == 'pay'){
                        include('track_form_payment.php');
                       }else {
                     include('track_form.php');
                    }
                  ?>  
                </div>
            </div>
        </div>
    </div>

    <br><br>
  <footer>
  <?php include('../footer.php');?>
  <footer>
</body>

</html>
<?php include('script5.php');?>