<section class="ftco-section">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-7 col-lg-5">
				<div class="login-wrap p-4 p-md-5">
			<div class="d-flex align-items-center justify-content-center">
				<img src="css/account.png" style="border-radius: 50%;" width="90" height="90" class="d-inline-block align-text-to mb-3" />
			</div>
			<form action="route.php" method="post" class="login-form">
				<div class="form-group">
					<input type="text" class="form-control rounded-left text-center" name="username" placeholder="Username" required>
				</div>
			<div class="form-group d-flex">
				<input type="password" class="form-control rounded-left text-center" name="password" placeholder="Password" required>
			</div>
			<div class="form-group">
				<button type="submit" class="form-control btn btn-secondary rounded submit px-3">Login</button>
				<input type="hidden" name="actionLogin" value="actionLogin" />
			</div>
			</form>
		</div>
			</div>
		</div>
	</div>
</section>
