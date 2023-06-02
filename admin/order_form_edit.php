<?php 
if(@$_GET['do']=='finish'){
    echo '<script type="text/javascript">
          swal("", "แก้ไขสำเร็จ !!", "success");
          </script>';
    echo '<meta http-equiv="refresh" content="1;url=member_profile.php" />';

  }
$ids = $_GET['ID'];
$sql = "SELECT * FROM tbl_order as o, tbl_order_detail as d, tbl_product as p 
WHERE d.order_id=o.order_id AND d.p_id=p.p_id AND o.order_id='$ids' ORDER BY d.p_id";
$result = mysqli_query($con, $sql);

$sql_stat = "SELECT * FROM tbl_order 
WHERE order_id='$ids' ORDER BY order_id";
$result_stat = mysqli_query($con, $sql_stat);
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
<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<style>
    #myImg {
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
    }

    #myImg2 {
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
    }

    #myImg:hover {
        opacity: 0.7;
    }

    #myImg2:hover {
        opacity: 0.7;
    }

    /* The Modal (background) */
    .modal {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 1;
        /* Sit on top */
        padding-top: 100px;
        /* Location of the box */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgb(0, 0, 0);
        /* Fallback color */
        background-color: rgba(0, 0, 0, 0.9);
        /* Black w/ opacity */
    }

    .modal2 {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 1;
        /* Sit on top */
        padding-top: 100px;
        /* Location of the box */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgb(0, 0, 0);
        /* Fallback color */
        background-color: rgba(0, 0, 0, 0.9);
        /* Black w/ opacity */
    }

    /* Modal Content (image) */
    .modal-content {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
    }

    .modal-content2 {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
    }

    /* Caption of Modal Image */
    #caption {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
        text-align: center;
        color: #ccc;
        padding: 10px 0;
        height: 150px;
    }

    #caption2 {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
        text-align: center;
        color: #ccc;
        padding: 10px 0;
        height: 150px;
    }

    /* Add Animation */
    .modal-content,
    #caption {
        animation-name: zoom;
        animation-duration: 0.6s;
    }

    @keyframes zoom {
        from {
            transform: scale(0.1)
        }

        to {
            transform: scale(1)
        }
    }

    .modal-content2,
    #caption2 {
        animation-name: zoom;
        animation-duration: 0.6s;
    }

    @keyframes zoom {
        from {
            transform: scale(0.1)
        }

        to {
            transform: scale(1)
        }
    }

    /* The Close Button */
    .close {
        position: absolute;
        top: 60px;
        right: 35px;
        color: #f1f1f1;
        font-size: 40px;
        font-weight: bold;
        transition: 0.3s;
    }



    .close:hover,
    .close:focus {
        color: #bbb;
        text-decoration: none;
        cursor: pointer;
    }

    .close2 {
        position: absolute;
        top: 60px;
        right: 35px;
        color: #f1f1f1;
        font-size: 40px;
        font-weight: bold;
        transition: 0.3s;
    }



    .close2:hover,
    .close2:focus {
        color: #bbb;
        text-decoration: none;
        cursor: pointer;
    }

    /* 100% Image Width on Smaller Screens */
    @media only screen and (max-width: 700px) {
        .modal-content {
            width: 100%;
        }
    }

    @media only screen and (max-width: 700px) {
        .modal-content2 {
            width: 100%;
        }
    }
</style>

<form action="order_form_edit_db.php" method="post" class="form-inline" enctype="multipart/form-data">
<div class="container-fluid px-6">
    <h2 class="mt-4">คำสั่งซื้อที่ <?=$ids?></h2>

    <div class="form-group">
            <label>สถานะการสั่งซื้อ</label>
            <select name="order_status" class="form-control" required>
                <option value="<?php echo $row_stat['order_status'];?>">
                    <?php echo $status;?>
                </option>
                <option value="1" class='text text-default'>รอตรวจสอบ</option>
                <option value="2" class='text text-primary'>ชำระค่ามัดจำแล้ว</option>
                <option value="3" class='text text-warning'>รอชำระยอดคงเหลือ</option>
                <option value="4" class='text text-success'>ชำระเงินครบแล้ว</option>
                <option value="5" class='text text-danger'>ยกเลิกการสั่งซื้อ</option>
            </select>
    </div>
    &nbsp;&nbsp;

    <div class="form-group">
        <label>สถานะการจัดส่ง</label>
            <select name="order_deliver" class="form-control" required>
                <option value="<?php echo $row_stat['order_deliver'];?>">
                    <?php echo $deliver;?>
                </option>
                <option value="0" class='text text-default'>รอสั่งสินค้า</option>
                <option value="1" class='text text-primary'>สั่งสินค้าแล้ว</option>
                <option value="2" class='text text-info'>พัสดุกำลังเดินทางเข้าประเทศ</option>
                <option value="3" class='text text-warning'>พัสดุเข้าโกดังในประเทศ</option>
                <option value="4" class='text text-warning'>พัสดุรอจัดส่ง</option>
                <option value="5" class='text text-success'>พัสดุกำลังจัดส่ง</option>
                <option value="6" class='text text-success'>จัดส่งสำเร็จ</option>
                <option value="7" class='text text-danger'>ยกเลิก</option>
            </select>
        
    </div>
    &nbsp;&nbsp;
    <div class="form-group">
        <label>เลขพัสดุ</label>
        <input type="text" class="form-control" id="order_parcel" name="order_parcel" value="-">
    </div>
    &nbsp;&nbsp;
    <button type="submit" class="btn btn-success" onclick="return confirm('ต้องการบันทึกสถานะสินค้าหรือไม่ ?');">บันทึก</button>
    <input type="hidden" class="form-control" name="order_id" value="<?php echo $row_stat['order_id']?>">
</form>


    <div class="card mb-4">
        <div class="card-header">
        </div>
        <br>
        <div class="card-body">
            <br>
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

            <?php
                if($sum_second != '0'){
                    ?>
            <b>ยอดมัดจำ <b style='color:green'> <?=$sum_first?></b> บาท </b>
            <br>
            <b>ยอดคงเหลือ <b style='color:red'> <?=$sum_second?> </b>บาท <b style='color:red'></b></b>

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

            <b>หลักฐานการชำระค่ามัดจำ : <br>

                <?php echo"<img src='../member/b_img/".$img1."'width='20%' id='myImg' >";?>
                <div id="myModal" class="modal">
                    <span class="close">&times;</span>
                    <img class="modal-content" id="img01">
                    <div id="caption"></div>
                </div>
            </b>
            <?php
                if($img2 != '0'){
                    ?>
            <br>
            <b>หลักฐานการชำระยอดคงเหลือ : <br>
                <?php echo"<img src='../member/b_img/".$img2."'width='20%' id='myImg2' >";?>
                <div id="myModal2" class="modal">
                    <span class="close2">&times;</span>
                    <img class="modal-content" id="img02">
                    <div id="caption2"></div>
                </div>


            </b>
            <script>
                var modal2 = document.getElementById('myModal2');
                var img2 = document.getElementById('myImg2');
                var modalImg2 = document.getElementById("img02");
                var captionText2 = document.getElementById("caption2");
                img2.onclick = function () {
                    modal2.style.display = "block";
                    modalImg2.src = this.src;
                    captionText2.innerHTML = this.alt;
                }
                var span2 = document.getElementsByClassName("close2")[0];

                span2.onclick = function () {
                    modal2.style.display = "none";
                }
            </script>

            <?php 
                }
            ?>
        </div>
    </div>
</div>
<script>
    // Get the modal
    var modal = document.getElementById('myModal');


    // Get the image and insert it inside the modal - use its "alt" text as a caption
    var img = document.getElementById('myImg');


    var modalImg = document.getElementById("img01");

    var captionText = document.getElementById("caption");


    img.onclick = function () {
        modal.style.display = "block";
        modalImg.src = this.src;
        captionText.innerHTML = this.alt;
    }



    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];


    // When the user clicks on <span> (x), close the modal

    span.onclick = function () {
        modal.style.display = "none";
    }
</script>