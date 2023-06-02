<?php
$ddt1=@$_POST['dt1'];
$ddt2=@$_POST['dt2'];
$add_date = date('Y/m/d', strtotime($ddt2."+1 days"));

if(($ddt1 != "")&&($ddt2 != "")){
    $to = "ค้นหาจากวันที่ $ddt1 ถึง $ddt2";
    $sql = "SELECT * FROM tbl_order WHERE order_status = '4' AND order_date BETWEEN '$ddt1' AND '$add_date' order BY order_date DESC";
}else{
    $sql = "SELECT * FROM tbl_order WHERE order_status = '4' order BY order_date DESC";
}
$result = mysqli_query($con,$sql);


?>
<div class="container-fluid px-4">
    <h2 class="mt-4">สรุปยอดขาย</h2>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            แสดงข้อมูลยอดขาย
        </div>
        <br>
            <form action="order.php?act=report" method="post">
                <div class="row" style="padding-left: 15px; padding-right: 15px;">
                    <div class="col-sm-2">
                        <input type="date" name="dt1" class="form-control">
                    </div>
                    <div class="col-sm-1 text-center">
                        <h5>ถึง</h5>
                    </div>
                    <div class="col-sm-2">
                        <input type="date" name="dt2" class="form-control">
                    </div>
                    <div class="col-sm-2">
                        <button type="submit" class="btn btn-outline-primary">ค้นหา</button>
                    </div>
                    <div class="col-sm-4 text-right">
                        <button type="button" class="btn btn-outline-secondary" onclick="window.print();">พิมพ์ใบสรุป</button>
                    </div>
                </div>
            </form>
        <br>
        <div style="padding-left: 15px;">
            <?php echo $to ?>
        </div>
        <div class="card-body">

            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>เลขที่การสั่ง</th>
                        <th>ผู้สั่งซื้อ</th>
                        <th>ที่อยู่จัดส่ง</th>
                        <th>ราคารวมสุทธิ</th>
                        <th>วันที่สั่งซื้อ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $total_sum = 0;
                                        while($row=mysqli_fetch_array($result)){
                                            $status = $row['order_status'];
                                            $total_sum = $total_sum+$row['order_price_total'];
                                        ?>
                    <tr>
                        <td>
                            <?php echo $row['order_id']?>
                        </td>
                        <td>
                            <?php echo $row['order_name']?>
                        </td>
                        <td>
                            <?php echo nl2br($row['order_address'])?>
                            <br>
                            เบอร์โทรศัพท์<?php echo $row['order_tel']?>
                        </td>
                        <td>
                            <?php echo $row['order_price_total']?>
                        </td>
                        <td>
                            <?php echo $row['order_date']?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="text-right">
                <h4>ยอดเงินรวมทั้งหมด <?php echo number_format($total_sum); ?> บาท</h4>
            </div>
            
        </div>
    </div>
    <?php

$html = ob_get_contents();      
$mpdf->WriteHTML($html);        
$mpdf->Output('Report.pdf');  
ob_end_flush();                 
?>

<a href="Report.pdf"><button class="btn btn-primary">Export PDF</button> </a>
</div>
