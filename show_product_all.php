<?php
$perpage = 16;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
    } else {
    $page = 1;
    }

    $start = ($page - 1) * $perpage;


$q = $_GET['q'];
include("../condb.php");
$sql = "SELECT * FROM tbl_product as p
INNER JOIN tbl_type  as t ON p.type_id=t.type_id
WHERE p.p_status = 'เปิดการขาย'
ORDER BY p.p_id DESC LIMIT $start,$perpage";  //เรียกข้อมูลมาแสดงทั้งหมด
$result = mysqli_query($con, $sql);
?>

<div class="container">
<br>
<div class="container-fluid px-4">
<h2 class="mt-4">สินค้าทั้งหมด</h2>
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
        </div>
       
    </div>
</div>

<?php } ?>

<?php
 $sql2 = "SELECT * FROM tbl_product as p
 INNER JOIN tbl_type  as t ON p.type_id=t.type_id
 WHERE p.p_status = 'เปิดการขาย'
 ORDER BY p.p_id DESC";
 $query2 = mysqli_query($con, $sql2);
 $total_record = mysqli_num_rows($query2);
 $total_page = ceil($total_record / $perpage);
 ?>
<br>

<div class="container">
<div class="container" style="float: right; padding-top: 20px;">
    <nav aria-label="Page navigation example">
      <ul class="pagination justify-content-center">
        <li class="page-item">
            <a class="page-link" href="index.php?act=all&page=1" tabindex="-1" 
            aria-disabled="true">หน้าแรก</a></li>
        <li class="page-item <?=$page > 1 ? '': 'disabled' ?>"> 
        <a class="page-link" href="index.php?act=all&page=<?=$page-1?>" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
          </a>
          </li>
        <?php for($i=1; $i <= $total_page; $i++):?>
        <?php if($page <= 2): ?>
        <?php if($i <= 5): ?>
            <li class="page-item <?=$page == $i ? 'active' : '';?>"><a class="page-link"
            href="index.php?act=all&page=<?=$i?>"><?=$i?></a></li>
        <?php endif; ?>
        <?php elseif($page > 2): ?>
        <?php if($i <= $page+2 && $i >= $page-2): ?>
            <li class="page-item <?=$page == $i ? 'active' : '';?>"><a class="page-link"
            href="index.php?act=all&page=<?=$i?>"><?=$i?></a></li>
            <?php endif; ?>
        <?php endif; ?>
        <?php endfor;?>
        <li class="page-item <?=$page < $total_page ? '': 'disabled' ?>">
          <a class="page-link" href="index.php?act=all&page=<?=$page+1?>" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
          </a>
        </li>
        <li class="page-item"><a class="page-link" href="index.php?act=all&page=<?=$total_page?>">หน้าสุดท้าย</a>
        </li>
      </ul>
    </nav>
</div>
</div>    
       