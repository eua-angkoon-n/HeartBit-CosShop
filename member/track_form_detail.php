<?php
$ids = $_GET['id'];
$sql = "SELECT * FROM tbl_order as o, tbl_order_detail as d, tbl_product as p 
WHERE d.order_id=o.order_id AND d.p_id=p.p_id AND o.order_id='$ids' ORDER BY d.p_id";
$result = mysqli_query($con,$sql);
$sum_total = 0;

$sql_stat = "SELECT * FROM tbl_order
WHERE order_id = '$ids'"; 
$result_stat = mysqli_query($con,$sql_stat);
$row_stat = mysqli_fetch_array($result_stat);

$status = $row_stat['order_status'];
$deliver = $row_stat['order_deliver'];

if($status == '1'){
    $status = 'รอตรวจสอบ';
    ?><?php
} else if($status == '2'){
    $status = 'ชำระค่ามัดจำแล้ว';
}else if($status == '3'){
    $status = 'รอชำระยอดคงเหลือ';
}else if($status == '4'){
    $status = 'ชำระเงินครบแล้ว';
}else if($status == '5'){
    $status = 'ยกเลิกการสั่งซื้อ';
}

if($deliver == '0'){
    $deliver = 'รอตรวจสอบ';
} else if($deliver == '1'){
    $deliver = 'สั่งสินค้าแล้ว';
}else if($deliver == '2'){
    $deliver = 'พัสดุกำลังเดินทางเข้าประเทศ';
}else if($deliver == '3'){
    $deliver = 'พัสดุเข้าโกดังในประเทศ';
}else if($deliver == '4'){
    $deliver = 'พัสดุรอจัดส่ง';
}else if($deliver == '5'){
    $deliver = 'พัสดุกำลังจัดส่ง';
}else if($deliver == '6'){
    $deliver = 'จัดส่งสำเร็จ';
}else if($deliver == '7'){
    $deliver = 'ยกเลิก';
}
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">รายงานการสั่งซื้อสินค้า</h1>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            แสดงรายการสินค้า
        </div>
        <br>
        <div style="padding-left: 15px;">
            <a href="track.php" class="btn btn-outline-success btn-sm">กลับ</a>
        </div>
        <div class="card-body">
            <b>เลขที่ใบสั้งซื้อ : <?=$ids?></b> &nbsp;
            <b>สถานะการจัดส่ง : <?php echo $deliver?></b> 
            <b>เลขที่พัสดุ : <b class="text-danger"><?php echo $row_stat['order_parcel']?></b> </b> 
            <br><br>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ลำดับที่</th>
                        <th>รูปภาพ</th>
                        <th>ชื่อสินค้า</th>
                        <th>ราคา</th>
                        <th>จำนวน</th>
                        <th>ราคารวมสุทธิ</th>
                        <th>ราคามัดจำรวม</th>
                        <th>ยอดคงเหลือ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $i = 1;
                    while($row=mysqli_fetch_array($result)){
                        $date = $row['order_date'];
                        $sum_total = $row['order_price_total'];
                        $sum_first = $row['order_price_first'];
                        $sum_second = $row['order_price_second'];
                        $name = $row['order_name'];
                        $address = $row['order_address'];
                        $tel = $row['order_tel'];
                        $img1 = $row['order_img1'];
                        $img2 = $row['order_img2'];
                        $pimg = $row['p_img'];
                        $first = $row['order_total_first'];
                        $second = $row['order_total_second'];
                        
                    ?>
                    <tr>
                        <td><?=$i?></td>
                        <td><img src="../p_img/<?php echo $pimg?>" alt="" width="80px" class="border"></td>
                        <td><?=$row['p_name']?></td>
                        <td><?=$row['order_detail_price']?> บาท</td>
                        <td><?=$row['detail_qty']?></td>
                        <td><?=$row['order_total']?> บาท</td>
                        <td><?=$first?> บาท</td>
                        <td><?=$second?> บาท</td>
                    </tr>
                    <?php $i++; } ?>
                </tbody>
            </table>
            <b>ราคารวมสุทธิ <b style='color:blue'><?=$sum_total?></b> บาท</b>
            <br>
            <b>ยอดมัดจำ <b style='color:green'> <?=$sum_first?></b> บาท </b>
            <?php
                if($sum_second != '0'){
                    ?>
                    <br>
                    <b>ยอดคงเหลือ <b style='color:red'> <?=$sum_second?> </b>บาท <b style='color:red'>**กรุณาชำระเมื่อสถานะการสั่งซื้อเป็น <b style='color:orange'>"รอชำระยอดคงเหลือ"</b>**</b></b>

                <?php 
                }
            ?>

            <br><br>
            <b>วันที่สั่งซื้อ : <?=$date?></b>
            <br>
            <b>ชื่อผู้สั่งซื้อ : <?=$name?></b>
            <br>
            <b>ที่อยู่จัดส่ง : <?=$address?></b>
            <br>
            <b>เบอร์โทรศัพท์ : <?=$tel?></b>
            <br>
            <b>หลักฐานการชำระเงิน : <br><img src="../member/b_img/<?php echo $img1;?>" width="200px"></b>
            <?php
                if($img2 != '0'){
                    ?>
                    <br>
                    <b>หลักฐานการชำระยอดคงเหลือ : <br><img src="../member/b_img/<?php echo $img2;?>" width="200px"></b>

                <?php 
                }
            ?>
        </div>
    </div>
</div>