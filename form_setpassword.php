<style>
            .center {
                text-align: center;
                width: 100%;
            }
			.button {
  				background-color: #4CAF50;
  				color: white;}
				
        </style>


<form action="form_setpassword_db.php" method="post">
    <section class="ftco-section">
        <input type="hidden" name="login">
            <div class="container">
                <div class="row justify-content-center">
						<div class="col-md-6 col-lg-5">
							<div class="login-wrap p-4 p-md-5">
								<div class="icon d-flex align-items-center justify-content-center" style="background-color: #a33b63;">
									<span class="fa fa-user-o"></span>
                                </div>
                                <h3 class="text-center mb-4" style="color: #a33b63;">ตั้งค่ารหัสผ่านใหม่</h3>
                                    <input type="hidden" value="<?php echo $_GET['m']; ?>" name="m_id">
                                    <input type="hidden" value="<?php echo $_GET['u']; ?>" name="u">
                                    <input type="hidden" value="<?php echo $_GET['p']; ?>" name="p">

                                    <form action="#" class="login-form">
                                        <div class="col-sm-10" align="">รหัสผ่านใหม่ :</div>
									        <div class="form-group">
										        <input type="password" name="pass" class="form-control rounded-left" placeholder="กรอกรหัสผ่าน (6-100 ตัวอักษร)"
                                                minlength="6" maxlength="100" required id="myInput">
									        </div>

                                        <div class="form-group d-flex justify-content-end">
                                            <label class="checkbox-wrap checkbox-primary" style="color: #a33b63;">แสดงรหัสผ่าน
											    <input type="checkbox" name="show_pass" onclick="myFunction()">
											    <span class="checkmark "></span>
										    </label>
                                        </div>
                                      
                                        <div class="col-sm-10" align="">ยืนยันรหัสผ่านใหม่ :</div>
									        <div class="form-group">
										        <input type="password" name="c_pass" class="form-control rounded-left" placeholder="กรอกรหัสผ่าน (6-100 ตัวอักษร)"
                                                minlength="6" maxlength="100" required id="myInput2">
									       
                                        <div class="form-group d-flex justify-content-end">
                                            <label class="checkbox-wrap checkbox-primary" style="color: #a33b63;">แสดงรหัสผ่าน
											    <input type="checkbox" name="show_pass2" onclick="myFunction2()">
											    <span class="checkmark "></span>
										    </label>
                                        </div>

                                        </div>
									    <div class="form-group">
										    <button type="submit" class="btn button rounded submit p-3 px-5" name="set_password" style="background-color: #a33b63;">ส่งข้อมูล</button>
									    </div>
								    </form>
                            </div>
                        </div>
                </div>
            </div>
    </section>
</form>
<script src="login/js/jquery.min.js"></script>
	<script src="login/js/popper.js"></script>
	<script src="login/js/bootstrap.min.js"></script>
	<script src="login/js/main.js"></script>

	<script>
	function myFunction() {
 		 var x = document.getElementById("myInput");
  		if (x.type === "password") {
    		x.type = "text";
  	} else {
    	x.type = "password";
  		}
	}
</script>
<script>
	function myFunction2() {
 		 var x = document.getElementById("myInput2");
  		if (x.type === "password") {
    		x.type = "text";
  	} else {
    	x.type = "password";
  		}
	}
</script>