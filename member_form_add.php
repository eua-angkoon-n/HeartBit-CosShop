<style>
            .center {
                text-align: center;
                width: 100%;
            }
			.button {
  				background-color: #4CAF50;
  				color: white;}
				
        </style>




<body>
    <form name="register" action="member_form_add_db.php" method="POST" enctype="multipart/form-data"
        class="login100-form validate-form p-b-33 p-t-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="login-wrap p-4 p-md-5">
                    <div class="icon d-flex align-items-center justify-content-center" style="background-color: #a33b63;">
                        <span class="fa fa-user-o"></span>
                    </div>
                    <h3 class="text-center mb-4" style="color: #a33b63;">สมัครสมาชิก</h3>
                    <form action="#" class="login-form">
                        <div class="col-sm-10" align="">ชื่อผู้ใช้งาน :<font color="red">*</font></div>
                        <div class="form-group">
                            <input type="text" name="m_user" class="form-control rounded-left" placeholder="Username"
                                required>
                        </div>

                        <div class="col-sm-10" align="">รหัสผ่าน :<font color="red">*</font></div>
                        <div class="form-group d-flex">
                            <input type="password" name="m_pass" class="form-control rounded-left"
                            placeholder="กรอกรหัสผ่าน (6 ตัวอักษรขี้นไป)"
                                                minlength="6" maxlength="100" required id="m_pass">
                        </div>

                        <div class="form-group d-flex justify-content-end">
                        <label class="checkbox-wrap checkbox-primary"  style="color: #a33b63;">แสดงรหัสผ่าน
											<input type="checkbox" name="show_pass" onclick="myFunction1()">
											<span class="checkmark "></span>
						</label>
                        </div>

                        <div class="col-sm-10" align="">ยืนยันรหัสผ่าน :<font color="red">*</font></div>
                        <div class="form-group d-flex">
                            <input type="password" name="c_pass" class="form-control rounded-left"
                            placeholder="กรอกรหัสผ่าน (6 ตัวอักษรขี้นไป)"
                                                minlength="6" maxlength="100" id="c_pass" required>
                        </div>

                        <div class="form-group d-flex justify-content-end">
                        <label class="checkbox-wrap checkbox-primary"  style="color: #a33b63;">แสดงรหัสผ่าน
											<input type="checkbox" name="show_pass" onclick="myFunction2()">
											<span class="checkmark "></span>
						</label>
                        </div>

                        <div class="col-sm-10" align="">ชื่อ-สกุล :<font color="red">*</font></div>
                        <div class="form-group d-flex">
                            <input type="text" name="m_name" class="form-control rounded-left"
                                placeholder="ภาษาภาษาไทย" id="m_name" required>
                        </div>

                        <div class="col-sm-10" align="">อีเมล์ :<font color="red">*</font></div>
                        <div class="form-group d-flex">
                            <input type="email" name="m_email" class="form-control rounded-left"
                                placeholder="อีเมล์" id="m_email" required>
                        </div>

                        <div class="col-sm-10" align="">เบอร์โทรศัพท์ :<font color="red">*</font></div>
                        <div class="form-group d-flex">
                            <input type="text" name="m_tel" class="form-control rounded-left"
                                placeholder="ตัวเลขเท่านั้น" id="m_tel" required maxlength="10" pattern="^[0-9]+$"
                                title="ตัวเลขเท่านั้น">
                        </div>

                        <div class="col-sm-10" align="">ที่อยู่ :<font color="red">*</font> <br><font color="red">** หมายเหตุ: กรุณากรอกที่อยู่จริง ** </font></div>
                        <div class="form-group d-flex">
                            <textarea name="m_address" class="form-control rounded-left" id="m_address"
                                required></textarea>
                        </div>
            
                            
                        

                        <div class="col-sm-10" align="">รูปภาพโปรไฟล์ :<font color="red">*</font></div>
                        <div class="form-group d-flex">
                            <input type="file" name="m_img" class="form-control rounded-left" id="card_img">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn button rounded submit p-3 px-5"
                                id="btn" style="background-color: #a33b63;">สมัครสมาชิก</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>
<br><br><br><br>
<script src="login/js/jquery.min.js"></script>
<script src="login/js/popper.js"></script>
<script src="login/js/bootstrap.min.js"></script>
<script src="login/js/main.js"></script>
<script>
	function myFunction1() {
 		 var x = document.getElementById("m_pass");
  		if (x.type === "password") {
    		x.type = "text";
  	} else {
    	x.type = "password";
  		}
	}
</script>
<script>
	function myFunction2() {
 		 var x = document.getElementById("c_pass");
  		if (x.type === "password") {
    		x.type = "text";
  	} else {
    	x.type = "password";
  		}
	}
</script>
</body>