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
<form class="login100-form validate-form p-b-33 p-t-5" name="reset" action="./form_reset_db.php" method="POST" enctype="multipart/form-data">
			<section class="ftco-section">
				<div class="container">	
					<div class="row justify-content-center">
						<div class="col-md-6 col-lg-5">
							<div class="login-wrap p-4 p-md-5">
								<div class="icon d-flex align-items-center justify-content-center" style="background-color: #a33b63;">
									<span class="fa fa-user-o"></span>
								</div>
									<h3 class="text-center mb-4" style="color: #a33b63;">ลืมรหัสผ่าน</h3>
									<form action="#" class="login-form">
                                		<div class="col-sm-10" align="left"> อีเมล์ :</div>
											<div class="form-group">
												<input type="email" name="email" class="form-control rounded-left" placeholder="Email">
											</div>
									
											<div class="w-50">
												<a href="index.php?act=reg">กลับไปหน้าเข้าสู่ระบบ</a>
											</div>
				
											<div class="form-group">
												<button type="submit" class="btn button rounded submit p-3 px-5" style="background-color: #a33b63;">ส่งข้อมูล</button>
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
	</body>