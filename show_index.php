<?php include "banner.php" ?>
<div class="container">
<br>
<div class="row">
    <?php 
    $sql = "SELECT * FROM product WHERE pro_amount > 0 ORDER BY pro_id LIMIT 8";
    $result = mysqli_query($conn,$sql);
    ?>
    <div class="d-flex justify-content-center flex-wrap gap-2">
      <?php while($row=mysqli_fetch_array($result)){ ?>
      <div class="card" style="width: 16rem;">
        <img src="./img/product/<?=$row['pro_img']?>" class="card-img-top" style="height: 250px;" alt="...">
        <div class="card-body">
          <label class="card-title"><div class="pro-name"><p><?php echo $row['pro_name']; ?></p></div></label>
          <p class="card-text text-end">ราคา: <?php echo number_format($row['pro_price']); ?> บาท</p>
          <div class="text-center"><a class="btn btn-outline-primary text-center"
              href="?page=show_product_detail.php&id=<?=$row['pro_id']?>">รายละเอียดสินค้า</a></div>
        </div>
      </div>
      <?php } ?>
    </div>
  </div>
  <br>
  <div class="d-flex justify-content-center">
    <a href="?page=show_product.php" class="btn btn-secondary">ดูสินค้าทั้งหมด</a>
  </div>
  <br>
</div>