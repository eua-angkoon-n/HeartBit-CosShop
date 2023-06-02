<?php session_start(); ?>

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
	<form class="login100-form validate-form p-b-33 p-t-5" action="cheack_login.php" method="POST">
		<section class="ftco-section">
			<div class="container">

				<div class="row justify-content-center">
					<div class="col-md-6 col-lg-5">
						<div class="login-wrap p-4 p-md-5">
							<div class="icon d-flex align-items-center justify-content-center" style="background-color: #a33b63;">
								<span class="fa fa-user-o"></span>
							</div>
							<h3 class="text-center mb-4"  style="color: #a33b63;">เข้าสู่ระบบ HeartBit CosShop</h3>
							<form action="#" class="login-form">
								<div class="form-group">
									<input type="text" name="m_user" class="form-control rounded-left"
										placeholder="Username" required value="<?php
										if (isset($_COOKIE['user_login'])) {
											echo $_COOKIE['user_login'];}
										?>">
								</div>
								<div class="form-group d-flex">
									<input type="password" name="m_pass" class="form-control rounded-left"
										id="myInput" placeholder="Password" required value="<?php
										if (isset($_COOKIE['user_password'])) {
											echo $_COOKIE['user_password'];}
										?>">
								</div>

								
								
								<div class="form-group d-flex justify-content-between">
								
										<label class="checkbox-wrap checkbox-primary" style="color: #a33b63;">จดจำฉัน
											<input type="checkbox" name="remember"
												<?php if(isset($_COOKIE['user_login'])) {?>checked <?php } ?>>
											<span class="checkmark"></span>
										</label>
									
									
									
										<label class="checkbox-wrap checkbox-primary" style="color: #a33b63;">แสดงรหัสผ่าน
											<input type="checkbox" name="show_pass" onclick="myFunction()">
											<span class="checkmark "></span>
										</label>

									
								</div>


								<div class="form-group d-flex justify-content-end">
									
										<a href="index.php?act=reset">ลืมรหัสผ่าน?</a>
								
								</div>
									

								<div class="form-group">
									<button type="submit"
										class="btn button rounded submit p-3 px-5" style="background-color: #a33b63;">เข้าสู่ระบบ</button>
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
</body>