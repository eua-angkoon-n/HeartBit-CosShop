<?php
$perpage =  15;
if(isset($_GET['pagen'])){
    $page = $_GET['pagen'];
}else{
    $page = 1;
}
$member_id = $_SESSION['member_id'];

$start = ($page - 1) * $perpage;

$sql = "SELECT * FROM tbl_order 
WHERE member_id = $member_id 
ORDER BY order_id DESC LIMIT $start,$perpage";
$result = mysqli_query($con,$sql);

?>


<br>
<div class="container-fluid px-4">
<h2 class="mt-4">ติดตามสถานะสินค้า</h2>
</div>
<br>

<div class="container-fluid px-10">
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            แสดงประวัติการสั่งซื้อ
        </div>
        
        <div class="card-body">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>เลขที่การสั่ง</th>
                        <th>ชื่อผู้สั่งซื้อ</th>
                        <th>ที่อยู่จัดส่ง</th>
                        <th>เบอร์โทรศัพท์</th>
                        <th>ราคาสุทธิ</th>
                        <th>ยอดคงเหลือ</th>
                        <th>วันที่สั่งซื้อ</th>
                        <th>สถานะการสั่งซื้อ</th>
                        <th>สถานะการจัดส่ง</th>
                        <th>รายละเอียด</th>
                    </tr>
                </thead>
                <?php
                while ($row = mysqli_fetch_array($result)) {
                    $status = $row['order_status'];
                    $deliver = $row['order_deliver'];
                ?>
                <tbody>
                    <tr>
                        <td>
                            <? echo $row['order_id']?>
                        </td>
                        <td>
                            <?
                                echo mb_strimwidth($row['order_name'], 0, 10, "...");
                                ?>
                        </td>
                        <td>
                            <? 
                                echo mb_strimwidth($row['order_address'], 0, 10, "...");
                            ?>

                        </td>
                        <td>
                            <? echo $row['order_tel']?>
                        </td>
                        <td>
                            <? echo number_format($row['order_price_total'])?> บาท
                        </td>
                        <td>
                            <? echo number_format($row['order_price_second'])?> บาท
                        </td>
                        <td>
                            <? echo $row['order_date']?>
                        </td>
                        <td>
                            <?php
                            if ($status == 1) {
                                echo "<b>รอตรวจสอบ</b>";
                            } elseif ($status == 2) {
                                echo "<b style='color:blue'>ชำระค่ามัดจำแล้ว</b>";
                            } elseif ($status == 3) {
                                echo "<b style='color:orange'>รอชำระยอดคงเหลือ</b>";
                                ?>
                            <br>
                            <a href="track.php?act=pay&id=<?= $row['order_id'] ?>" class="btn btn-warning btn-sm" onclick="">ชำระยอดคงเหลือ</a>
                            <?php

                            } elseif ($status == 4) {
                                echo "<b style='color:green'>ชำระเงินครบแล้ว</b>";
                            } elseif ($status == 5) {
                                echo "<b style='color:red'>ยกเลิกการสั่งซื้อ</b>";
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            if ($deliver == 0) {
                                echo "<b>รอสั่งสินค้า</b>";
                            } elseif ($deliver == 1) {
                                echo "<b style='color:blue'>สั่งสินค้าแล้ว</b>";
                            } elseif ($deliver == 2) {
                                echo "<b style='color:blue'>พัสดุกำลังเดินทางเข้าประเทศ</b>";
                            } elseif ($deliver == 3) {
                                echo "<b style='color:orange'>พัสดุเข้าโกดังในประเทศ</b>";
                            } elseif ($deliver == 4) {
                                echo "<b style='color:orange'>พัสดุรอจัดส่ง</b>";
                            } elseif ($deliver == 5) {
                                echo "<b style='color:green'>พัสดุกำลังจัดส่ง</b>";
                            }elseif ($deliver == 6) {
                                echo "<b style='color:green'>จัดส่งสำเร็จ</b>";
                            }elseif ($deliver == 7) {
                                echo "<b style='color:red'>ยกเลิก</b>";
                            }
                            ?>
                        </td>
                        <td colspan="2">
                            <a href="track.php?act=detail&id=<?= $row['order_id'] ?>" class="btn btn-primary btn-sm"
                                onclick="">ดูรายละเอียด</a>
                        </td>
                    </tr>
                    <?php }
                    ?>
                </tbody>
            </table>

            <?php
            $sql2 = "SELECT * FROM tbl_order 
            WHERE member_id = $member_id 
            ORDER BY order_date DESC";
            
            $query2 = mysqli_query($con, $sql2);
            $total_record = mysqli_num_rows($query2);
            $total_page = ceil($total_record / $perpage);
            ?>


            <div style="float: right;">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="track.php?page=1" tabindex="-1"
                                aria-disabled="true">หน้าแรก</a></li>
                        <li class="page-item <?=$page > 1 ? '': 'disabled' ?>">
                            <a class="page-link" href="track.php?page=<?=$page-1?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <?php for($i=1; $i <= $total_page; $i++):?>
                        <?php if($pagen <= 2): ?>
                        <?php if($i <= 5): ?>
                        <li class="page-item <?=$page == $i ? 'active' : '';?>"><a class="page-link"
                                href="track.php?page=<?=$i?>"><?=$i?></a></li>
                        <?php endif; ?>
                        <?php elseif($page > 2): ?>
                        <?php if($i <= $page+2 && $i >= $page-2): ?>
                        <li class="page-item <?=$pagen == $i ? 'active' : '';?>"><a class="page-link"
                                href="track.php?page=<?=$i?>"><?=$i?></a></li>
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php endfor;?>
                        <li class="page-item <?=$page < $total_page ? '': 'disabled' ?>">
                            <a class="page-link" href="track.php?page=<?=$page+1?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                        <li class="page-item"><a class="page-link"
                                href="track.php?page=<?=$page_total?>">หน้าสุดท้าย</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>