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

  <div class="container">
  <form action="resetpass_form_db.php" method="post" class="form-horizontal" enctype="multipart/form-data">
  <div class="form-group">
    <div class="col-sm-2 control-label">
      ชื่อผู้ใช้งาน :
    </div>
    <div class="col-sm-3">
      <input type="text" disabled name="m_user" required class="form-control" autocomplete="off" pattern="^[a-zA-Z0-9]+$" title="ภาษาอังกฤษหรือตัวเลขเท่านั้น" minlength="2" value="<?php echo $row['m_user'];?>">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
      รหัสผ่านเก่า :
    </div>
    <div class="col-sm-3">
      <input type="password" name="m_pass0" required class="form-control" >
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
        รหัสผ่านใหม่ :
    </div>
    <div class="col-sm-3"> 
      <input type="password" name="m_pass1" required class="form-control" >
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
        ยืนยันรหัสผ่านใหม่ :
    </div>
    <div class="col-sm-3"> 
      <input type="password" name="m_pass2" required class="form-control" >
    </div>
  </div>

 

  <div class="form-group">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-3">
      <input type="hidden" name="member_id" value="<?php echo $member_id; ?>" />
      <button type="submit" class="btn btn-success">แก้ไขรหัสผ่าน</button>
      <a href="member.php" class="btn btn-danger">ยกเลิก</a>
    </div>
  </div>
</form>