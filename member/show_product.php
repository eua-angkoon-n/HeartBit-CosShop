<?php
include('../banner.php');
$q = $_GET['q'];
include("condb.php");
$sql = "SELECT * FROM tbl_product as p
INNER JOIN tbl_type  as t ON p.type_id=t.type_id
WHERE p.p_status = 'เปิดการขาย'
ORDER BY p.p_view DESC LIMIT 8";  //เรียกข้อมูลมาแสดงทั้งหมด
$result = mysqli_query($con, $sql);
?>

<div class="container">

<br>
<div class="container-fluid px-4">
<h2 class="mt-4">สินค้าแนะนำ</h2>
</div>
<br>
    <div class="row">
<?php
while($row_prd = mysqli_fetch_array($result)){
?>

        <div class="col-sm-3" align="center" style="padding-bottom: 20px;">
            <div class="card border-Light mb-1" style="width: 16.5rem;">
            <br>
            <img class="card-img-top">
            <a href="prd.php?id=<?php echo $row_prd[0]; ?>"> <?php echo"<img src='../p_img/".$row_prd['p_img']."'width='200' height='200'>";?></a>
            <div class="card-body">
                <a href="prd.php?id=<?php echo $row_prd[0]; ?>"><b> <?php echo $row_prd["p_name"];?></b> </a>
                <br>
                ราคา <font color=""> <?php echo $row_prd["p_price_total"];?></font> บาท
                <br>
                <?php if ($row_prd["p_deposit"] != '0') { ?>
                     <font color="#a33b63">(จองมัดจำ)</font>
                <?php } else { ?>
                    <font color="#0b626a">(จ่ายรอบเดียว)</font>
                    <?php }?>
                    <br><br>
                <button type="button" class="btn btn-info btn-sm">
                    <a href="prd.php?id=<?php echo $row_prd[0]; ?>" style="color:white">รายละเอียด</a>
                </button>
                <button type="button" class="btn btn-success btn-sm">
                    <a href="order.php?p_id=<?php echo $row_prd["p_id"] ?>" style="color:white">ใส่ตะกร้า</a>
                </button>
            </div>
            <br>
        </div>
    </div>
<?php } ?>

</div>

<br>
<div class="container">
  <div class="d-flex justify-content-center">
    <a href="index.php?act=all" class="btn btn-secondary">ดูสินค้าทั้งหมด</a>
  </div>
</div>
  <br>