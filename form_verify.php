<style>
            .center {
                text-align: center;
                width: 100%;
            }
			.button {
  				background-color: #4CAF50;
  				color: white;}
				
        </style>


<form action="form_verify_db.php" method="post">
    <section class="ftco-section">
        <input type="hidden" name="login">
            <div class="container">
                <div class="row justify-content-center">
						<div class="col-md-6 col-lg-5">
							<div class="login-wrap p-4 p-md-5">
								<div class="icon d-flex align-items-center justify-content-center" style="background-color: #a33b63;">
									<span class="fa fa-user-o"></span>
                                </div>
                                <h3 class="text-center mb-4" style="color: #a33b63;">ยืนยันการสมัครสมาชิก</h3>
                                    <input type="hidden" value="<?php echo $_GET['u']; ?>" name="u">
                                    <input type="hidden" value="<?php echo $_GET['p']; ?>" name="p">
                                    <input type="hidden" value="<?php echo $_GET['e']; ?>" name="e">

                                    <form action="#" class="login-form">
                                        

									    <div class="form-group">
										    <button type="submit" class="btn button rounded submit p-3 px-5" name="verify" style="background-color: #a33b63;">กดเพื่อยืนยันการสมัครสมาชิก</button>
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
