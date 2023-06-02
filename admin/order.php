<?php include('h.php');?>
<body class="hold-transition skin-purple sidebar-mini">
  <div class="wrapper">
    <!-- Main Header -->
    <?php include('menutop.php');?>
        <?php include('menu_l.php');?>
    <div class="content-wrapper">
      <section class="content-header">
        <h1>
        <i class="glyphicon glyphicon-check hidden-xs"></i> <span class="hidden-xs">ข้อมูลรายงาน</span> 
        <br>
        <a href="order.php" class="btn btn-default btn-sm">ทั้งหมด</a>
        <a href="order.php?act=1" class="btn btn-default btn-sm">รอตรวจสอบ</a>
        <a href="order.php?act=2" class="btn btn-primary btn-sm">ชำระค่ามัดจำแล้ว</a>
        <a href="order.php?act=3" class="btn btn-warning btn-sm">รอชำระยอดคงเหลือ</a>
        <a href="order.php?act=4" class="btn btn-success btn-sm">ชำระเงินครบแล้ว</a>
        <a href="order.php?act=5" class="btn btn-danger btn-sm">ยกเลิกการสั่งซื้อ</a>
        </h1>
      </section>
      <section class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="box">
              <div class="row">
                <div class="col-sm-12">
                  <div class="box-body">
                    <?php
                    $act = (isset($_GET['act']) ? $_GET['act'] : '');
                    if($act == 'edit'){
                        include('order_form_edit.php');
                    }else if($act == '1'){
                      include('order_list_1.php');
                    }else if($act == '2'){
                      include('order_list_2.php');
                    }else if($act == '3'){
                      include('order_list_3.php');
                    }else if($act == '4'){
                      include('order_list_4.php');
                    }else if($act == '5'){
                      include('order_list_5.php');
                    }else if($act == 'report'){
                      include('order_summary.php');
                    }else {
                        include('order_list.php');
                    }
                  ?>                   
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </body>
  </html>

  <?php include('footerjs.php');?>



