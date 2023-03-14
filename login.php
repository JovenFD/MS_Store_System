<section class="ftco-section1">
	<div class="container-fluid py-3">
		<div class="login">
      <div class="card" id="card-login">
	  <div class="login-wrap p-4 p-md-5">
			<div class="d-flex align-items-center justify-content-center">
				<img src="./uploads/<?php echo $settingObj->getLogo()['path'];?>" style="border-radius: 50%;" width="90" height="90" class="d-inline-block align-text-to mb-3" />
			</div>
			<form action="route.php" method="post" class="login-form">
				<div class="form-group mb-3">
					<input type="text" style="font-size: 18px;" class="form-control rounded-left text-center" name="username" placeholder="Username" required>
				</div>
			<div class="form-group d-flex mb-3">
				<input type="password" style="font-size: 18px;" class="form-control rounded-left text-center" name="password" placeholder="Password" required>
			</div>
			<div class="form-group mb-3">
				<button type="submit" style="font-size: 18px;" class="form-control btn btn-secondary rounded submit px-3">Login</button>
				<input type="hidden" name="actionLogin" value="actionLogin" />
			</div>
			</form>
		</div>
</div>
<div class="mb-4 py-3" style="margin: auto;">
   <div class="row" >
	   <div class="col mb-4">
	   </div>
	   <div class="col mb-4">
	   <a class="text-muted" href=".">&copy; MS Store 2022.</a>
	   </div>
	   <div class="col mb-4">
	   </div>
   </div>
</div>
</div>
	</div>
</section>
