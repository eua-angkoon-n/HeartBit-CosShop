<?php require_once('condb.php');
$query_typeprd = "SELECT * FROM tbl_type ORDER BY type_id ASC";
$typeprd =mysqli_query($con, $query_typeprd) or die ("Error in query: $query_typeprd " . mysqli_error());
// echo($query_typeprd);
// exit();
$row_typeprd = mysqli_fetch_assoc($typeprd);
$totalRows_typeprd = mysqli_num_rows($typeprd);
?>

<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #FEE9D1;">
    <a class="navbar-brand" href="index.php"><span style="color:#a33b63 ;">HeartBit</span><span
            style="color:#a685a8 ;">CS</span></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">หน้าแรก<span class="sr-only">(current)</span></a>
            </li>


            <li class="nav-item dropdown active">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    ประเภทสินค้า
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <?php 
                    
                    do { 
                        
                        ?>
                    <a href="index.php?act=showbytype&type_id=<?php echo $row_typeprd['type_id'];?>"
                        class="dropdown-item">
                        <?php echo $row_typeprd['type_name']; ?></a>
                    <?php } while ($row_typeprd = mysqli_fetch_assoc($typeprd)); ?>
                </div>
            </li>

            <li class="nav-item active">             
                    <a class="nav-link" href="https://www.facebook.com/HeartBitCosShop" target="_blank"
                        >ติดต่อสอบถาม</a>
            </li>
        </ul>


        <form class="form-inline my-2 my-lg-0">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php?act=reg" role="button">เข้าสู่ระบบ</a>
                </li>

                <?php
            if ($member_id!='') {
            
            } else {
            ?>
                <li class="nav-item active">
                    <a class="nav-link" href="index.php?act=add" role="button">สมัครสมาชิก</a>
                </li>
                <?php } ?>


                <?php
            if ($member_id!='') {
            ?>
                <li class="nav-item active">
                    <a class="nav-link" href="logout.php" role="button"
                        onclick="return confirm('คุณต้องการออกจากระบบหรือไม่ ?')">ออกจากระบบ</a>
                </li>
                <?php } ?>

           

            <form class="form-inline my-2 my-lg-0" name="q" action="index.php" method="GET">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="q">
                <button class="btn btn-success my-2 my-sm-0" type="submit">ค้นหา</button>
            </form>
            </ul>
        </form>
        <div>
</nav>