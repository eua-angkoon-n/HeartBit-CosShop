<?php
$sql = "SELECT COUNT(order_id) AS order_no FROM tbl_order WHERE order_status='1'";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_array($result);

$sql2 = "SELECT COUNT(order_id) AS order_no FROM tbl_order WHERE order_status='2'";
$result2 = mysqli_query($con,$sql2);
$row2 = mysqli_fetch_array($result2);

$sql3 = "SELECT COUNT(order_id) AS order_no FROM tbl_order WHERE order_status='4'";
$result3 = mysqli_query($con,$sql3);
$row3 = mysqli_fetch_array($result3);

$sql4 = "SELECT * FROM tbl_currency ORDER BY currency_id DESC LIMIT 1";
$result4 = mysqli_query($con,$sql4);
$row4 = mysqli_fetch_array($result4);
?>
<style>

body{
    
    background:#FAFAFA;
}
.order-card {
    color: #fff;
}

.bg-c-blue {
    background: linear-gradient(45deg,#4099ff,#73b4ff);
}

.bg-c-green {
    background: linear-gradient(45deg,#2ed8b6,#59e0c5);
}

.bg-c-yellow {
    background: linear-gradient(45deg,#FFB64D,#ffcb80);
}

.bg-c-pink {
    background: linear-gradient(45deg,#FF5370,#ff869a);
}


.card {
    border-radius: 5px;
    -webkit-box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
    box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
    border: none;
    margin-bottom: 30px;
    -webkit-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out;
}

.card .card-block {
    padding: 25px;
}

.order-card i {
    font-size: 26px;
}

.f-left {
    float: left;
}

.f-right {
    float: right;
}

a:link {
  color: white;
}

/* visited link */
a:visited {
  color: white;
}

/* mouse over link */
a:hover {
  color: grey;
}

/* selected link */
a:active {
  color: white;
}

</style>

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

<div class="container-fluid px-4">
    
    <div class="row">

        <div class="col-md-4 col-xl-6">
            <div class="card bg-c-pink order-card">
                <div class="card-block">
                    <h3 class="m-b-20">คำสั่งซื้อ (รอตรวจสอบ)</h3>
                    <h2 class="text-right"><i class="fa fa-credit-card f-left"></i><span><?php echo $row['order_no'] ?> รายการ</span></h2>
                    <a href="order.php?act=1"class="link-light">ดูรายละเอียด</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-xl-6" >
            <div class="card bg-c-yellow order-card">
                <div class="card-block">
                    <h3 class="m-b-20">คำสั่งซื้อ (ชำระค่ามัดจำแล้ว)</h3>
                    <h2 class="text-right"><i class="fa fa-refresh f-left"></i><span><?php echo $row2['order_no'] ?> รายการ</span></h2>
                    <a href="order.php?act=2"class="link-light">ดูรายละเอียด</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-xl-6">
            <div class="card bg-c-green order-card">
                <div class="card-block">
                    <h3 class="m-b-20">คำสั่งซื้อ (ชำระเงินครบแล้ว)</h3>
                    <h2 class="text-right"><i class="fa fa-rocket f-left"></i><span><?php echo $row3['order_no'] ?> รายการ</span></h2>
                    <a href="order.php?act=4"class="link-light">ดูรายละเอียด</a>
                </div>
            </div>
        </div>
    
        <div class="col-md-4 col-xl-6">
            <div class="card bg-c-blue order-card">
                <div class="card-block">
                    <h3 class="m-b-20">อัตราแลกเปลี่ยนค่าเงินหยวนปัจจุบัน</h3>
                        <h2 class="text-right"><span>1¥ = <?php echo number_format($row4['currency_rate'],2) ?>฿</span></h2>
                        <div>
                            <a href="product.php?act=update"class="link-light col-sm-5">อัพเดตอัตราแลกเปลี่ยน</a>
                                <div class="text-right">อัพเดตเมื่อ <?php echo $row4['date_update'] ?>
                                </div>
                        </div>
                </div>
            </div>
        </div>


    </div>
</div>

<br>
<?php include "product_list.php" ?>

    
        
      

