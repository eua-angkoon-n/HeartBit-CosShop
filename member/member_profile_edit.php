<?php 
if(@$_GET['do']=='finish'){
    echo '<script type="text/javascript">
          swal("", "แก้ไขสำเร็จ !!", "success");
          </script>';
    echo '<meta http-equiv="refresh" content="1;url=member_profile.php" />';

  }

$sql = "SELECT * FROM tbl_member WHERE member_id=$member_id";
$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error());
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
<h2 class="mt-4">ข้อมูลส่วนตัว</h2>
</div>
<br>

<div class="container">
<form action="member_profile_edit_db.php" method="post" class="form-horizontal" enctype="multipart/form-data">
<div class="d-flex justify-content-center" style="padding-top: 20px; padding-bottom: 20px">
            <div class="row">

            <div style="padding-bottom: 20px;">
                    <div class="row">
                        <div class="col-sm-4 text-end">
                        ชื่อผู้ใช้งาน :
                        </div>
                        <div class="col-sm-6">
                            <input type="text" name="m_name" required disabled class="form-control" value="<?php echo $row['m_user'];?>">
                        </div>
                        <div class="col d-flex justify-content-center">
                            <a href='member_profile.php?act=reset&ID=<?php echo $row['member_id']?>' class="btn btn-success" style="padding: 10px 20px 10px 20px;;" >แก้ไขรหัสผ่าน</a>
                        </div>
                    </div>
                </div>

                <div style="padding-bottom: 20px;">
                    <div class="row">
                        <div class="col-sm-4 text-end">
                        ชื่อ-นามสกุล :
                        </div>
                        <div class="col-sm-6">
                            <input type="text" name="m_name" required class="form-control" value="<?php echo $row['m_name'];?>">
                        </div>
                    </div>
                </div>

                

                <div style="padding-bottom: 20px;">
                    <div class="row">
                        <div class="col-sm-4 text-end">
                        เบอร์โทร :
                        </div>
                        <div class="col-sm-6">           
                            <input type="text" name="m_tel" required class="form-control" value="<?php echo $row['m_tel'];?>">
                        </div>
                    </div>
                </div>

                <div style="padding-bottom: 20px;">
                    <div class="row">
                        <div class="col-sm-4 text-end">
                        อีเมล์ :
                        </div>
                        <div class="col-sm-6">           
                          <input type="email" name="m_email" required class="form-control" value="<?php echo $row['m_email'];?>">
                        </div>
                    </div>
                </div>

                <div style="padding-bottom: 20px;">
                    <div class="row">
                        <div class="col-sm-4 text-end">
                        ที่อยู่ :
                        </div>
                        <div class="col-sm-6">           
                        <textarea name="m_address" class="form-control rounded-left" id="m_address"
                                required><?php echo $row['m_address'];?></textarea>
                        </div>
                    </div>
                </div>

                <div style="padding-bottom: 20px;">
                    <div class="row">
                        <div class="col-sm-4 text-end">
                        รูปภาพ :
                        </div>
                        <div class="col-sm-6">           
                          ภาพเก่า <br>
                          <img src="../m_img/<?php echo $row['m_img'];?>" width="200px">
                           <br>
                            <input type="file" name="m_img"  class="form-control" accept="image/*" onchange="readURL(this);"/>
                            <img id="blah" src="#" alt="" width="250" class="img-rounded"/ style="margin-top: 10px;">
                        </div>
                    </div>
                </div>

                <div style="padding-bottom: 10px;">
                    <div class="row">
                        <div class="col d-flex justify-content-center">
                            <input type="hidden" name="m_img2" value="<?php echo $row['m_img'];?>">
                            <input type="hidden" name="member_id" value="<?php echo $member_id; ?>" />
                            <button type="submit" class="btn btn-success" style="padding: 10px 20px 10px 20px;;" onclick="return confirm('ยืนยันการแก้ไขข้อมูล');">แก้ไขข้อมูล</button>
                            &nbsp;
                            <a href="index.php" class="btn btn-danger" style="padding: 10px 20px 10px 20px;;" onclick="return confirm('ต้องการยกเลิกการแก้ไขหรือไม่');">ยกเลิก</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>


