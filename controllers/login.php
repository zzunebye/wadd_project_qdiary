<html>
<head>
	<meta charset="utf-8">
	<title>Customer Login</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<link href="styleLogin.css" rel="stylesheet"/>
	<link href="partner.css" rel="stylesheet"/>
	<script src="jlogin.js"></script>
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	<script>
	$(document).ready(function(){
		$('#login-form').on('submit',function(e){
			var response = grecaptcha.getResponse();
			if(response.length == 0) {
				alert('Error: \n please validate the Captcha test');
				e.preventDefault();
			}
		});
	});
	</script>
	<!------ Include the above in your HEAD tag ---------->
</head>
<body>
<?php
	//$servicePublicKey = openssl_pkey_get_public(file_get_contents($_SERVER['DOCUMENT_ROOT']."/ServerPublicKey .pem"));
	
?>

<!--<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3" style="text-align: center;">
			<h1>Customer</h1>
		</div>
	</div>
</div>-->
<br/><br/><br/>
<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<p style="font-size:40px;">Consumer</p>
			</div>
		</div>
    	<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-login">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-6">
								<a href="#" class="active" id="login-form-link">Login</a>
							</div>
							<div class="col-xs-6">
								<a href="#" id="register-form-link">Register</a>
							</div>
						</div>
						<hr>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form id="login-form" action="checkLogin.php" method="post" role="form" style="display: block;">
									<font style="font-size:30px;">Sign in with your Email and Password</font></br></br>
									<div class="form-group">
										<font style="font-size:20px;">Email:</font>
										<input type="email" name="LEmail" id="LEmail" tabindex="1" class="form-control" placeholder="Email" value="" required>
									</div>
									<div class="form-group">
										<font style="font-size:20px;">Password:</font>
										<input type="password" id="LPassword" tabindex="2" class="form-control" placeholder="Password" onchange="encrpyPassword(this);" value="" required>
										<input type="hidden" name="eNLPassword" id="eNLPassword" value="" >
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<p><div class="g-recaptcha" data-sitekey="6LdEi7MaAAAAAB0VgxMYKo-YKc0yReMxqEj-J2g9"></div></p>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
											</div>
										</div>
									</div>
								</form>
								<form id="register-form" action="register.php" method="post" role="form" style="display: none;">
									<font style="font-size:30px;">FulFill the below content</font> </br></br>
									<div class="form-group">
										<font style="font-size:20px;">Email:</font>
										<input type="email" id="REmail" name="REmail" tabindex="1" class="form-control" placeholder="e.g. ting2341@gmail.com" value=""  onchange="checkEmail();" required />
										<div id="REmailNote" style="display:none" class="text-danger"><span class="glyphicon glyphicon-remove"></span>Invalid email.</div>
										<div id="REmailEmpty" style="display:none" class="text-danger"><span class="glyphicon glyphicon-remove"></span>Empty Email.</div>
									</div>
									<div class="form-group">
										<font style="font-size:20px;">Name:</font>
										<input type="text"  id="RName" name="RName" tabindex="2" class="form-control" placeholder="e.g.CHAN Tai Man" value="" onchange="checkName();" required />
										<div id="RNameEmpty" style="display:none" class="text-danger"><span class="glyphicon glyphicon-remove"></span>Empty Name.</div>
									</div>
									<div class="form-group">
										<font style="font-size:20px;">HKID no.:</font>
										<input type="text" id="RHkid" tabindex="3" class="form-control" placeholder="e.g. Y1234560" onchange="checkHKID();" required />
										<input type="hidden" id="EnRHkid" name="EnRHkid" value="" />
										<div id="RHKIDNote" style="display:none" class="text-danger"><span class="glyphicon glyphicon-remove"></span>Invalid HKID no.</div>
										<div id="RHKIDEmpty" style="display:none" class="text-danger"><span class="glyphicon glyphicon-remove"></span>Empty HKID no.</div>
									</div>
									<div class="form-group">
										<font style="font-size:20px;">Password:</font>
										<input type="password" id="RPassword" tabindex="4" class="form-control" placeholder="Password" onchange="checkPassword();" pattern="(?=.*\d)(?=.*[a-z])(?=.*?[!@#$%^&*+`~'=?\|\]\[\(\)\-<>/])(?=.*[a-z])(?=.*[A-Z]).{8,}" required > 
										<input type="hidden" id="EnRPassword" name="EnRPassword" value="" />
										<div id="passRule" style="display:none; font-size:15px;" >
											<div id="RPasswordLength" class="text-danger"><span class="glyphicon glyphicon-remove">At least 8 or more characters</div><br/>
											<div id="RPasswordNumber" class="text-danger"><span class="glyphicon glyphicon-remove">Number (e.g. 0-9)</div><br/>
											<div id="RPasswordUpperLetter"  class="text-danger"><span class="glyphicon glyphicon-remove">Uppercase letter (e.g. A-Z)</div><br/>
											<div id="RPasswordLowerLetter"  class="text-danger"><span class="glyphicon glyphicon-remove">Lowercase letter (e.g. a-z)</div><br/>
											<div id="RPasswordSpecail"  class="text-danger"><span class="glyphicon glyphicon-remove">Special character (e.g. !@#$%^&...)</div><br/>
											<div id="RPasswordDictWord"  class="text-danger"><span class="glyphicon glyphicon-remove">Not contain dictionary words</div>
										</div>
										<div id="RPasswordEmpty" style="display:none" class="text-danger"><span class="glyphicon glyphicon-remove"></span>Empty Password.</div>
									</div>
									<div class="form-group">
										<font style="font-size:20px;">Confirm Password:</font>
										<input type="password" id="confirm-password" tabindex="5" class="form-control" placeholder="Confirm Password" onchange="checkConfirmPassword();" required />
										<div id="RCPasswordNote" style="display:none" class="text-danger"><span class="glyphicon glyphicon-remove"></span>The confirm password must be equal the password!</div>
										<div id="RCPasswordEmpty" style="display:none" class="text-danger"><span class="glyphicon glyphicon-remove"></span>Empty Confirm Password.</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="hidden" id="checkNumber" name="checkNumber" value="" />
												<input type="submit" id="register-submit" tabindex="6" class="form-control btn btn-register" value="Register Now" disabled />
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
		<br/><br/><br/> <br/><br/><br/><br/><br/>
		<input type="hidden" id="privateKeyPem" value="<?php echo (isset($_POST['privateKeyPem']))?$_POST['privateKeyPem']:'';?>" />
	 <footer class="text-center text-lg-start" style="height: 25vh; display: flex; flex-direction: column; background-color: rgba(211, 211, 211, 0.4); align-items: center; font-weight: 200; overflow: hidden;">
        <h4 class="partnerTitle">Partners</h4>
        <div class="partnerLogo">
            <div class="welcome" id="logo"></div>
            <div class="hktv" id="logo"></div>
            <div class="uselect" id="logo"></div>
            <div class="park" id="logo"></div>
        </div>
    </footer>
	<script>
		if(document.getElementById("privateKeyPem").value !== ""){
			localStorage.setItem('privateKeyPem', document.getElementById("privateKeyPem").value);
			document.getElementById("privateKeyPem").value = "";
		}
	</script>
</body>
</html>