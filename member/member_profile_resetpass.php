<?php 
include('../condb.php');  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี
$ID = $_GET['ID'];
$sql = "SELECT * FROM tbl_member WHERE member_id=$ID";
$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error());
$row = mysqli_fetch_array($result);
extract($row);
?>

<div class="container" style="background-color: #ececec;">
      <h2 style="font-size:larger;">แก้ไขรหัสผ่าน</h2>
</div>
    <div class="container">

<form action="member_profile_resetpass_db.php" method="post" class="form-horizontal" enctype="multipart/form-data">
<div class="d-flex justify-content-center" style="padding-top: 20px; padding-bottom: 20px">
            <div class="row">
            <input type="hidden" name="member_id" id="member_id" class="form-control" value="<?php echo $member_id;?>" readonly="readonly">
                <div style="padding-bottom: 20px;">
                    <div class="row">
                        <div class="col-sm-4 text-end">
                        ชื่อผู้ใช้งาน :
                        </div>
                        <div class="col-sm-6">
                            <input type="text" name="m_user" id="m_user" class="form-control" required value="<?php echo $row['m_user']; ?>" disabled>
                        </div>
                        
                    </div>
                </div>

                <div style="padding-bottom: 20px;">
                    <div class="row">
                        <div class="col-sm-4 text-end">
                        รหัสผ่านเก่า :
                        </div>
                        <div class="col-sm-6">           
                            <input type="password" name="m_pass0" id="m_pass0" class="form-control" required value="">
                        </div>
                    </div>
                </div>

              

                <div style="padding-bottom: 20px;">
                    <div class="row">
                        <div class="col-sm-4 text-end">
                        รหัสผ่านใหม่ :
                        </div>
                        <div class="col-sm-6">           
                            <input type="password" name="m_pass1" id="m_pass1" class="form-control" required value="">
                        </div>
                        
                    </div>
                </div>


                <div style="padding-bottom: 20px;">
                    <div class="row">
                        <div class="col-sm-4 text-end">
                        ยืนยันรหัสผ่านใหม่ :
                        </div>
                        <div class="col-sm-6">           
                        <input type="password" name="m_pass2" id="m_pass2" class="form-control" required value="">
                        </div>
                    </div>
                </div>


                <div style="padding-bottom: 10px;">
                    <div class="row">
                        <div class="col d-flex justify-content-center">
                            <input type="hidden" name="m_img2" value="<?php echo $row['m_img'];?>">
                            <input type="hidden" name="member_id" value="<?php echo $member_id; ?>" />
                            <button type="submit" class="btn btn-success" style="padding: 10px 20px 10px 20px;;">แก้ไขข้อมูล</button>
                            &nbsp;
                            <a href="member_profile.php" class="btn btn-danger" style="padding: 10px 20px 10px 20px;;">ยกเลิก</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
  <?php include('footerjs.php');?>