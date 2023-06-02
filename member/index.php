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
		<div class="row-full">
			<div style="margin-top: 10px">
				<div class="row">
					<?php
            $act = (isset($_GET['act']) ? $_GET['act'] : '');
            $q = (isset($_GET['q']) ? $_GET['q'] : '');
            if($act=='showbytype'){
              include('show_product_type.php');
            }else if($q!=''){
            include("show_product_q.php");
            }else if($act=='add'){
            include("member_form_add.php");
            }else if($act=='all'){
              include("show_product_all.php");
            }else{
            include('show_product.php');
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