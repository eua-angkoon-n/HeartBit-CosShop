<?php
$ids = $_GET['id'];
$sql = "SELECT * FROM tbl_order as o, tbl_order_detail as d, tbl_product as p 
WHERE d.order_id=o.order_id AND d.p_id=p.p_id AND o.order_id='$ids' ORDER BY d.p_id";
$result = mysqli_query($con,$sql);
$sum_total = 0;
?>
<div class="container-fluid px-4">
    <h1 class="mt-4">ชำระยอดคงเหลือ</h1>
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
            <b>เลขที่ใบสั้งซื้อ : <?=$ids?></b> <br>
            <table class="table table-striped table-hover">
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
                    <b>ยอดคงเหลือ <b style='color:red'> <?=$sum_second?> </b>บาท <b style='color:red'>**กรุณาชำระเมื่อสถานะการสั่งซื้อเป็น "รอชำระยอดคงเหลือ"**</b></b>

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
            <b>หลักฐานการชำระค่ามัดจำ : <br><img src="../member/b_img/<?php echo $img1;?>" width="200px"></b>
            <br>
            
            <div class="row d-flex justify-content-center">
                    <div class="col-md-11">
                        <p style="color: red; font-size:24px;">ช่องทางการชำระเงิน <i class='bx bxs-package'
                                style="font-size:32px;"></i></p>
                                
                    </div>
                </div>

                <div class="row d-flex justify-content-center">
                    <div class="col-md-11">
                        <table class="table table-striped table-hover">
                                    <tr>
                                        <th>รูปภาพ</th>
                                        <th>ชื่อธนาคาร</th>
                                        <th>เลขที่บัญชี</th>
                                        <th>ประเภท/สาขา</th>
                                        <th>ชื่อบัญชี</th>
                                    </tr>
                <?php
                $sqlb = "SELECT * FROM tbl_bank ORDER BY b_id ASC";
                $bank = mysqli_query($con, $sqlb);

                while ($row_b = mysqli_fetch_array($bank)) {

                    ?>
                                    <tr>
                                        <td><img src="../b_logo/<?=$row_b['b_logo']?>" alt="" width="80px" class="border"></td>
                                        <td><?php echo $row_b['b_name']?></td>
                                        <td><?php echo $row_b['b_number']?></td>
                                        <td><?php echo $row_b['b_type']?>/<?php echo $row_b['bn_name']?></td>
                                        <td><?php echo $row_b['b_owner']?></td>
                                    </tr>
                <?php
                }
                ?>
                </table>
                    </div>
                </div>

            <br>
            <b>ชำระยอดคงเหลือ : </b>
            <br>
            <b>กรุณาชำระเงินจำนวน <b style='color:red'><?=$sum_second?></b> บาท</b>

            <form name="form1" method="post" action="track_form_payment_db.php" enctype="multipart/form-data">
            <input type="file" name="b_img2" required class="form-control"/>
                            <img id="blah" src="#" alt="" width="250" class="img-rounded"/ style="margin-top: 10px;">
                            <br>
                            <div style="text-align:right">
                                <button type="submit" class="btn btn-dark"
                                    id="checkout-button-1">บันทึก</button>
                                    <input type="hidden" value="<?php echo $ids?>" name="id">
                            </div>
        </form>

        </div>
    </div>
</div>