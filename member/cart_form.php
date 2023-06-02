<?php
if(@$_GET['do']=='finish'){
    echo '<script type="text/javascript">
          swal("", "แก้ไขสำเร็จ !!", "success");
          </script>';
    echo '<meta http-equiv="refresh" content="1;url=member_profile.php" />';
}
    $sql = "SELECT * FROM tbl_member WHERE member_id=$member_id";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);


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

<br>
<div class="container-fluid px-4">
<h2 class="mt-4">ตะกร้าสินค้า</h2>
</div>
<br>

<form name="form1" method="post" action="cart_save.php" enctype="multipart/form-data">
    <div class="container">
        <br>
        <div class="row d-flex justify-content-center">
            <div class="col-md-11">
                <table class="table table-striped table-hover">
                    <tr>
                        <th>ลำดับที่</th>
                        <th>รูปภาพ</th>
                        <th>ชื่อสินค้า</th>
                        <th>ราคา</th>
                        <th class="text text-center">จำนวน</th>
                        <th>ราคารวม</th>
                        <th>ราคามัดจำรวม</th>
                        <th>ลบรายการ</th>
                    </tr>
                    <?php
                    $total = 0;
                    $sum_price = 0;
                    $m = 1;

                    for($i=0;$i<=(int)$_SESSION["intLine"];$i++)
                    {
                        if($_SESSION["strProductID"][$i] != ""){
                            $strSQL = "SELECT * FROM tbl_product WHERE p_id = '".$_SESSION["strProductID"][$i]."' ";
                            $objQuery = mysqli_query($con, $strSQL);
                            $objResult = mysqli_fetch_array($objQuery);

                            $_SESSION["price_total"] = $objResult['p_price_total'];
                            $_SESSION["price_f"] = $objResult['p_deposit_first'];
                            $_SESSION["price_s"] = $objResult['p_deposit_second'];

                            $total = $_SESSION["strQty"][$i];

                            $sum_total = $total*$objResult['p_price_total'];
                            $sum_first = $total*$objResult['p_deposit_first'];
                            $sum_second = $total*$objResult['p_deposit_second'];

                            $sum_price = $sum_price + $sum_total;
                            $sum_pricef = $sum_pricef + $sum_first;
                            $sum_prices = $sum_prices + $sum_second;

                            $_SESSION["order_price_total"] = $sum_price;
                            $_SESSION["order_price_first"] = $sum_pricef;
                            $_SESSION["order_price_second"] = $sum_prices;
                          
                        ?>
                    <tr>
                        <td><?=$m?></td>
                        <td><img src="../p_img/<?=$objResult['p_img']?>" alt="" width="80px" class="border"></td>
                        <td><?php echo $objResult["p_name"];?></td>
                        <td><?php echo $objResult["p_price_total"];?></td>
                        <td class="text-center">
                            
                            <?php if($_SESSION["strQty"][$i] > 1){ ?>
                            <a href="cart_reduce.php?p_id=<?php echo $objResult['p_id']?>" type="button"
                                class="btn btn-outline-secondary">-</a>
                            <?php } ?>
                        


                        <?php echo $_SESSION["strQty"][$i];?>
                    
                            <?php if($_SESSION["strQty"][$i]){ ?>
                            <a href="cart_add.php?p_id=<?php echo $objResult['p_id']?>" type="button"
                                class="btn btn-outline-secondary">+</a>
                            <?php } ?>
                            
                    
                    
                    
                        </td>
                        <td><?php echo number_format($sum_total,2);?></td>
                        <td>
                            
                            <?php 
                            if($objResult["p_deposit"] == '0'){
                                echo '0';
                            }else{
                                echo number_format($sum_first,2);?> (<?php echo $objResult["p_deposit"];?>%) 
                            <?php } ?>
                        
                        </td>
                        <td><div style="text-align:center">
                        <a href="cart_del.php?Line=<?php echo $i;?>" class="btn btn-danger btn-sm">ลบ</a>
                        </div></td>
                    </tr>
                    <?php
                    $m=$m+1;
                        }
                    }
                    ?>
                  
                    <tr>
                        <td>รวมเป็นเงินทั้งหมด</td>
                        <td></td>
                        <td></td>
                        <td class="text-end">ราคารวม</td>
                        <td class="text-end"><?php echo number_format($sum_price, 2); ?></td>
                        <td>บาท</td>
                        <td></td>
                        <td></td>
                    
                    </tr>
                    <tr>
                        <td>จำนวนเงินที่ต้องจ่ายในปัจจุบัน</td>
                        <td></td>
                        <td></td>
                        <td class="text-end">ราคารวม</td>
                            <td class="text-end"><?php
                            if (number_format($sum_pricef, 2) != '0') {
                                echo number_format($sum_pricef, 2);
                            }else {
                                echo '0';
                            }
                            ?></td>
                            <td>บาท</td>
                            <td></td>
                            <td></td>
                    </tr>


                </table>
            
                <br><br>
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
                <h6 align="center"><span style="color: red;">**หมายเหตุ : หากมีการชำระสินค้าแบบจ่ายมัดจำ จะสามารถจ่ายยอดค่าคงเหลือได้ เมื่อหลังจากพัสดุเข้าในประเทศ**</span></h6>
                    </div>
                </div>


                <br><br>
                <div class="row d-flex justify-content-center">
                    <div class="col-md-11">
                        <p style="color: red; font-size:24px;">กรอกที่อยู่จัดส่ง <i class='bx bxs-package'
                                style="font-size:32px;"></i></p>
                    </div>
                </div>
             
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-11 bg-detail">
                            <input type="hidden" name="member_id" value="<?php echo $_SESSION['member_id'] ?>">
                            ชื่อ-นามสกุล:
                            <input type="text" name="order_name" class="form-control" required
                                value="<?php echo $row['m_name'] ?>">
                            ที่อยู่จัดส่งสินค้า:
                            <textarea name="order_address" id="" cols="30" rows="5" class="form-control" required
                                ><?php echo $row['m_address'] ?></textarea>
                            เบอร์โทรศัพท์:
                            <input type="text" name="order_tel" class="form-control" maxlength="10"
                                onkeypress="return isNumberKey(event)" required value="<?php echo $row['m_tel'] ?>">
                            อีเมล:
                            <input type="email" name="order_email" class="form-control" required value="<?php echo $row['m_email'] ?>">
                            รูปภาพหลักฐานการโอนเงิน <br>
                            จำนวน<span style="color: blue;"> <?php echo number_format($sum_pricef,2); ?></span> บาท
                        
                            <input type="file" name="b_img" required class="form-control"/>
                            <img id="blah" src="#" alt="" width="250" class="img-rounded"/ style="margin-top: 10px;">
                            <br>
                            <div style="text-align:right">
                                <button type="submit" class="btn btn-dark"
                                    id="checkout-button-1">ยืนยันการสั่งซื้อ</button>
                                <input type="text" value="1" name="order" hidden>
                            </div>
                        </div>
                    </div>
                </form>
           
            

