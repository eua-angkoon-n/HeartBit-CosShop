<h2 class="mt-4">จัดการคำสั่งซื้อ</h2>
<?php 
 if(@$_GET['do']=='success'){
    echo '<script type="text/javascript">
          swal("", "ทำรายการสำเร็จ !!", "success");
          </script>';
    echo '<meta http-equiv="refresh" content="1;url=product.php" />';

  }else if(@$_GET['do']=='finish'){
    echo '<script type="text/javascript">
          swal("", "แก้ไขสำเร็จ !!", "success");
          </script>';
    echo '<meta http-equiv="refresh" content="1;url=product.php" />';
  }

$query = " SELECT * FROM tbl_order
WHERE order_status = '2'
ORDER BY order_id DESC" or die("Error:" . mysqli_error());
$result = mysqli_query($con, $query);
echo ' <table id="example1" class="table table-bordered table-striped">';
  echo "<thead>";
    echo "<tr class=''>
        <th width='5%'  class='hidden-xs'>เลขที่การสั่ง</th>
        <th width='15%' class='hidden-xs'>ผู้สั่งซื้อ</th>
        <th width='30%' class='hidden-xs'>ที่อยู่จัดส่ง</th>
        <th width='8%' class='hidden-xs'>ราคาสุทธิ</th>
        <th width='8%' class='hidden-xs'>ยอดคงเหลือ</th>
        <th width='10%' class='hidden-xs'>สถานะการสั่งซื้อ</th>  
        <th width='10%' class='hidden-xs'>สถานะการจัดส่ง</th>
        <th width='7%' class='hidden-xs'>รายละเอียด</th>
    </tr>";
  echo "</thead>";


  while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
    echo "<td  class='hidden-xs'>" .$row["order_id"] .  "</td> "; //เลขที่การสั่ง

    echo "<td class='hidden-xs'> ชื่อ ". $row["order_name"] . //ผู้สั่งซื้อ เบอร์
    "</td>";

    echo "<td> " .$row["order_address"] .
    "<br>เบอร์โทรศัพท์ : " .$row["order_tel"]. //ที่อยู่จัดส่ง
      "</td class='hidden-xs'> ";

    echo "<td class='hidden-xs'>" .$row["order_price_total"] ." บาท"."</td> "; //ราคาสุทธิ

    echo "<td>".$row["order_price_second"] ." บาท". //ยอดคงเหลือ
      "</td> ";

      echo "<td class='hidden-xs' align='center'>"; //สถานะการสั่งซื้อ
      if ($row["order_status"] == '1') {
        echo "<span class='label label-default'>รอตรวจสอบ</span>";
      }elseif($row["order_status"] == '2') {
        echo "<span class='label label-primary'>ชำระค่ามัดจำแล้ว</span>";
      }elseif($row["order_status"] == '3') {
        echo "<span class='label label-warning'>รอชำระยอดคงเหลือ</span>";
      } elseif($row["order_status"] == '4') {
        echo "<span class='label label-success'>ชำระเงินครบแล้ว</span>";
      } elseif($row["order_status"] == '5') {
        echo "<span class='label label-danger'>ยกเลิกการสั่งซื้อ</span>";
      } 
    "</td> ";

      echo "<td class='hidden-xs' align='center'>"; //สถานะการจัดส่ง
      if ($row["order_deliver"] == '0') {
        echo "<span class='label label-default'>รอสั่งสินค้า</span>";
      }elseif($row["order_deliver"] == '1') {
        echo "<span class='label label-primary'>สั่งสินค้าแล้ว</span>";
      }elseif($row["order_deliver"] == '2') {
        echo "<span class='label label-info'>พัสดุกำลังเดินทางเข้าประเทศ</span>";
      } elseif($row["order_deliver"] == '3') {
        echo "<span class='label label-warning'>พัสดุเข้าโกดังในประเทศ</span>";
      } elseif($row["order_deliver"] == '4') {
        echo "<span class='label label-warning'>พัสดุรอจัดส่ง</span>";
      } elseif($row["order_deliver"] == '5') {
        echo "<span class='label label-success'>พัสดุกำลังจัดส่ง</span>";
      } elseif($row["order_deliver"] == '6') {
        echo "<span class='label label-success'>จัดส่งสำเร็จ</span>";
      } elseif($row["order_deliver"] == '7') {
        echo "<span class='label label-danger'>ยกเลิก</span>";
      } 
     "</td> ";

        echo "<td><a href='order.php?act=edit&ID=$row[order_id]' type='button' class='btn btn-primary'>ดูรายละเอียด</a>

    </td> ";
    
  }
echo "</table>";
mysqli_close($con);
?>