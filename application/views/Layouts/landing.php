<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="content-type" content="text/html" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta name="author" content="Hiberce" />
		<title><?php  echo $title;?></title>
		
		<link href="<?php echo css_url('style.css');?>" rel="stylesheet">
		<link href="<?php echo css_url('media.css');?>" rel="stylesheet">
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="<?php echo css_url('lightbox.css');?>">

		<!--<script src="js/jquery-1.11.3.min.js"></script>-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
		
		<!--<script src="js/jquery.mb.YTPlayer.js"></script>-->
		<script defer src="<?php echo js_url('bootstrap.js');?>"></script>
		<script src="<?php echo js_url('lightbox.js');?>"></script>
		<link rel="stylesheet" href="<?php echo css_url('hiberce.css');?>">
		<script> var baseurl='<?php echo base_url();?>';</script>

	</head>

	<body>
		<header class="header">
			<div class="container-fluid">
				<div class="row">
					<nav class="navbar navbar-inverse">
					  <div class="container-fluid">
					    
					    <div class="navbar-header">
					      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					        <span class="icon-bar"></span>
					        <span class="icon-bar"></span>
					        <span class="icon-bar"></span>
					      </button>
					      <a class="navbar-brand" href="index.php"><img src="<?php echo image_url('logo.png');?>" class="img-responsive" /></a>
					    </div>
					    <div class="collapse navbar-collapse" id="myNavbar">
					    <ul class="nav navbar-nav navbar-right">
					      <li><a href="#"><img src="<?php echo image_url('icon/cart-icon.png');?>" /></a></li>
					      <li><a href="#"><img src="<?php echo image_url('icon/edit-icon.png');?>" /></a></li>
					      <li><a href="#">Start Selling</a></li>
					      <?php if(empty($this->session->userdata('sess_userdtl'))){ ?>
					      <li><a href="javascript:void(0);" data-toggle="modal" data-target="#login">Sign In</a></li>
					      <li><a href="javascript:void(0);" data-toggle="modal" data-target="#signup">Sign Up</a></li>
					      <?php } else{?>
					         <li><a href="#" ><?php echo get_from_session_front('fname').'  '.get_from_session_front('lname');?> ( Profile <?php echo userProfileCompleteData(); ?> % Complete )</a></li>
   							 <li><a href="<?php echo site_url('logout');?>" >Log Out</a></li>
					      <?php } ?>
					    </ul>
					    </div>
					  </div>
					</nav>
				</div>
			</div>
		</header>
		<!-- Modal Start -->
		
		<section class="popupmodal">
			<div id="login" class="modal fade" role="dialog">
			  <div class="modal-dialog">
 				<?php  $em=get_cookie("hiberceemail"); $pwd=get_cookie("hibercepassword"); ?>
			    <!-- Modal content-->
			    <div class="modal-content">
			      <button type="button" class="close" data-dismiss="modal">&times;</button>
			      <div class="modal-body">
			        <div class="login-form">
						<div class="box">
							<div class="social_btn">
								<button class="full_btn no-border themebg1 btn-facebook full-width" onclick="window.location.href='<?php echo site_url('facebook-login');?>'"><img src="<?php echo image_url('icon/facebook-login.png');?>" class="fbicon" alt="facebook" title="Facebook" width="30" /> Sign in Facebook</button>
							</div>

							<div class="social_btn">
								<button class="full_btn no-border themebg1 btn-twitter full-width"    onclick="window.location.href='<?php echo base_url()."googleplusLogin/" ?>'"><img src="<?php echo image_url('icon/google-login.png');?>" class="fbicon" alt="facebook" title="Facebook" width="30" /> Sign in Google</button>
							</div>

							<form action="<?php echo site_url('login');?>" method="post" class="lr-form" id="formSignIn" name="formSignIn">

								<div class="divider-form"></div>
								<h5 class="modal-title text-center text-uppercase">Sign In</h5>
								<div class="form-group">
									<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email Address" name="semail" value='<?php if(!empty($em)){echo $em;}?>'>
								</div>
								<div class="form-group">
									<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="spassword" value='<?php if(!empty($pwd)){ echo $pwd;}?>'>
								</div>
								<div class="row">
								<div class="col-sm-6">
								<a href="javascript:void(0);" data-toggle="modal" data-target="#forgotpsw" class="forgot-psw thinfont themetxtcolor" id="forpsw">Forgot Password ?</a>
								</div>
								<div class="col-sm-6 text-right">
									<label class="changecheck no-margin">
									<input type="checkbox" class="editcheckhide" name="remember" id="remember" <?php if(!empty($em) && !empty($pwd)){ echo "checked='checked'"; }?> />&nbsp;&nbsp;&nbsp;
									<span></span>
									</label>
									<label for="remember" class="remember thinfont no-margin themetxtcolor">Keep me logged in</label>
								</div>
								</div>
								
								<div class="text-center logbtn">
									<button type="submit" class="xs_btn no-border themebg1 full_btn">Login</button>
								</div>
								<div class="signtxt text-center"><span class="themetxtcolor extrathinfont">Don't have an account?</span>  <a href="#" onclick="showModalData('signup','login');">Sign up.</a></div>

								
							</form>
						</div>
					</div>
			      </div>
			      
			    </div>

			  </div>
			</div>


			<div id="signup" class="modal fade" role="dialog">
			  <div class="modal-dialog">

			    <!-- Modal content-->
			    <div class="modal-content">
			      <button type="button" class="close" data-dismiss="modal">&times;</button>
			      <div class="modal-body">
			        <div class="login-form">
						<div class="box">
							
							<div class="row">
							<div class="reg_social_btn col-sm-6 mb-0">
								<button class="full_btn no-border themebg1 btn-facebook full-width"  onclick="window.location.href='<?php echo site_url('facebook-login');?>'"><img src="<?php echo image_url('icon/facebook-login.png');?>" class="fbicon" alt="facebook" title="Facebook" width="30" /> Register with Facebook</button>
							</div>

							<div class="reg_social_btn col-sm-6 mb-0">
								<button class="full_btn no-border themebg1 btn-twitter full-width"  onclick="window.location.href='<?php echo base_url()."googleplusLogin/" ?>'"><img src="<?php echo image_url('icon/google-login.png');?>" class="fbicon" alt="facebook" title="Facebook" width="30" /> Register with Google</button>
							</div>
							</div>
							<form action="<?php echo site_url('signup');?>" method="post" class="lr-form" id="signupForm" name="signupForm">

								<div class="divider-form"></div>
								<h5 class="modal-title text-center text-uppercase">SIGN UP</h5>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<input type="text" name="fname" class="form-control" id="fname" placeholder="First Name"  />
										</div>
									</div>
								
								
								<div class="col-sm-6">
									<div class="form-group">
										<input type="text" name="lname" class="form-control" id="lname" placeholder="Last Name"  />
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<input type="email" name="uemail" class="form-control" id="uemail" placeholder="Email Address" />
									</div>
								</div>
								
								<div class="col-sm-6">
									<div class="form-group">
										<input type="password" name="upassword" class="form-control" id="upassword" placeholder="Password" onkeyup="passwordStrength(this.value)" />
									</div>
								</div>
                                                                    
                                                                    <div class="form-group col-sm-6">
                                                                        <p>
                                                                        <label for="passwordStrength">Password strength</label>
                                                                        <div id="passwordDescription">Password not entered</div>
                                                                        <div id="passwordStrength" class="strength0"></div>
                                                                        </p>
                                                                    </div>
								<div class='clearfix'></div> <!-- Clearfix div added on 20/12/2016 previously no div is added -->
								<div>
									<div class="col-sm-1">
										<label class="changecheck">
										<input type="checkbox" class="editcheckhide checkbox" name="conditioncheck" id="conditioncheck" />
										<span></span>
										</label>
									</div>
									<div class="col-sm-11">
										<label for="conditioncheck" class="condition-txt thinfont">By clicking sign up you do not only agree to have a great time but that you accept our <a href="<?php echo site_url('terms-and-conditions');?>">terms and conditions</a> and <a href="<?php echo site_url('privacy-policy');?>">privacy policy</a>.</label>
									</div>
								</div>
								<div class="text-center logbtn">
									<button type="submit" class="xs_btn no-border themebg1 full_btn">SIGN UP</button>
								</div>
								</div>
								<div class="signtxt text-center"><span class="themetxtcolor extrathinfont">Already have an account?</span><a href="#" onclick="showModalData('login','signup');">  Sign In.</a></div>

							</form>
						</div>
					</div>
			      </div>
			      
			    </div>

			  </div>
			</div>

			<div id="forgotpsw" class="modal fade" role="dialog">
			  <div class="modal-dialog">

			    <!-- Modal content-->
			    <div class="modal-content">
			      <button type="button" class="close" id="closeforgot" data-dismiss="modal">&times;</button>
			      <div class="modal-body">
			        <div class="login-form">
						<div class="box">
							<form action="<?php echo site_url('forgot-password');?>" method="post" class="lr-form" id="formForgotPwd" name="formForgotPwd">
								<h5 class="modal-title text-center text-uppercase">FORGOT PASSWORD</h5>
								<p class="modal-para text-center">Enter the email address you specified<br>when creating your Hiberce account</p>
								<div class="row">
								<div class="col-sm-12">
									<div class="form-group">
										<input type="text" name="ufemail" class="form-control emph" id="ufemail" placeholder="Email Address"  />
									</div>
									
                                        <div class="or-divider">
					                        <hr> <span>Or</span>
					                        <hr>
                    					</div> 

									<div class="form-group">
										<input type="text" name="ufmobile" class="form-control emph" id="ufmobile" placeholder="Mobile Number"  />

									</div>

									<div class="form-group">
									<div class="row">
										
										<div class="col-sm-8">
										<input type="text" class="form-control" autocomplete="off" name="userCaptcha" placeholder="Enter Captcha Text" value="<?php if(!empty($userCaptcha)){ echo $userCaptcha;} ?>" id="userCaptcha"/>
										</div>	
										<div class="col-sm-4">
										<?php echo $captcha['image']; ?> 
										<a href="#url" class="reload-captcha"><span>
										<i class="fa fa-refresh" aria-hidden="true"></i></span></a>
										</div>	
										
									</div>
													
									
                                

								   </div>
								</div>
								<div class="text-center logbtn">
									<button type="submit" class="xs_btn no-border themebg1 full_btn" id="resettext">SEND RESET LINK</button>
								</div>
								</div>
							</form>
						</div>
					</div>
			      </div>
			      
			    </div>

			  </div>
			</div>




			<div id="recoverpsw" class="modal fade" role="dialog">
			  <div class="modal-dialog">

			    <!-- Modal content-->
			    <div class="modal-content">
			      <button type="button" class="close" id="closeforgot" data-dismiss="modal">&times;</button>
			      <div class="modal-body">
			        <div class="login-form">
						<div class="box">
							<form action="<?php echo site_url('reset-password');?>" method="post" class="lr-form" id="recoverfrompsw" name="recoverfrompsw">
								<h5 class="modal-title text-center text-uppercase">RESET PASSWORD</h5>
								<p class="modal-para text-center">Enter the UUID or OTP  you get<br>when resetting your Hiberce account Password</p>
								<div class="row">
								<div class="col-sm-12">
									<div class="form-group">
										<input type="text" name="temppwd" class="form-control emph" id="temppwd" placeholder="One Time Password Or OTP"  />
									</div>
									
                                        
									<div class="form-group">
										<input type="password" name="password1" class="form-control emph" id="password1" placeholder="New Password"  />
									</div>


									<div class="form-group">
										<input type="password" name="password2" class="form-control emph" id="password2" placeholder="Confirm Password"  />
									</div>

								
								</div>
								<div class="text-center logbtn">
									<button type="submit" class="xs_btn no-border themebg1 full_btn" id="resettext">SEND RESET LINK</button>
								</div>
								</div>
							</form>
						</div>
					</div>
			      </div>
			      
			    </div>

			  </div>
			</div>
			

		</section>
		
		<!-- Modal End -->



<!-- END OF HEADER -->


      


      	<!-- Banner Start -->
		
		<section class="banner-section"  data-vidbg-bg="mp4: <?php echo media_url('Front_end_video.mp4');?>, webm: <?php echo media_url('Front_end_video.webm');?>, poster: <?php echo media_url('banner.jpg');?>" data-vidbg-options="loop: true, muted: true, overlay: false">
			<div class="container">
				<div class="row">
					<div class="banner-text text-center">
						<h1 class="text-uppercase whitecolor">Lifestyle at your Fingertips</h1>
						<h4 class="text-center whitecolor">Buy or sell, we don't care, just have fun!</h4>
						<div class="col-sm-6 col-sm-offset-3">
						<!--<form action="" method="post" id="header-search" class="searchform">
							<div class="form-group">
					            <div class="input-group input-group-md">
					            <input type="text" class="form-control" id="username" placeholder="Search For listing">
					            <span  class = "input-group-addon themetxtcolor" id = "usericon"><i class = "fa fa-search"></i></span>
					            </div>
					          </div>
						</form>-->
						<form class="search-container">
						    <input type="text" id="search-bar" placeholder="Search for listings">
						    <a href="#"><img class="search-icon" src="<?php echo image_url('icon/search-icon.png');?>" width="24"></a>
					  	</form>
							
						</div>
					</div>
				</div>
			</div>
		</section>
		
		<!-- Banner End -->
		
		<!-- Banner Bottom Start -->
		
		<section class="catgory-search">
			<div class="container">
				<div class="row">
					<ul class="nav nav-tabs nav-justified" role="tablist">
				        <li>
					        <a href="#">
						        <img src="<?php echo image_url('icon/producta-icon.png');?>" />
						        <span class="text-uppercase whitecolor">Products</span>
					        </a>
				        </li>
				        <li>
					        <a href="#">
						        <img src="<?php echo image_url('icon/services-icon.png');?>" />
						        <span class="text-uppercase whitecolor">Services</span>
					        </a>
				        </li>
				        <li>
					        <a href="#">
						        <img src="<?php echo image_url('icon/events-icon.png');?>" />
						        <span class="text-uppercase whitecolor">Events</span>
					        </a>
				        </li>
				        <li>
					        <a href="#">
						        <img src="<?php echo image_url('icon/away-icon.png');?>" />
						        <span class="text-uppercase whitecolor">Get Away</span>
					        </a>
				        </li>
				    </ul>
				</div>
			</div>
		</section>
		
		<!-- Banner Bottom End -->





		<!-- PAGE CONTENT-->
        <?php echo $content;?>
		<!-- PAGE CONTENT-->


       <!-- START OF FOOTER-->


		<footer class="footer" id="footer">
			<div class="container">
				<div class="row">
					<div class="col-sm-8">
						<div class="footer-widget row">
							<div class="col-sm-6">
								<div class="footer-top">
									<img src="<?php echo image_url('logo.png');?>" alt="Logo" title="Hiberce" class="img-responsive" />
								</div>
								<div class="ft-widget-bot">
								<ul>
									<li><a href="#"><span>About Us</span></a></li>
									<li><a href="#"><span>List Your Business</span></a></li>
								</ul>
							</div>
							</div>
							
							<div class="col-sm-6">
								<div class="footer-top" style="margin-bottom: 40px;">
									<h4 class="footer-title themetxtcolor text-uppercase">Get Help</h4>
								</div>
								<div class="ft-widget-bot">
								<ul>
									<li><a href="#"><span>Help Centre</span></a></li>
									<li><a href="#"><span>Legal Centre</span></a></li>
								</ul>
							</div>
							</div>
						</div>
						
						<div class="clearfix"></div>
						
						<div class="fsocial-media row">
							<div class="col-sm-12">
								<div class="footer-top">
									<h4 class="footer-title themetxtcolor text-uppercase">Share & follow</h4>
								</div>
								<?php 
								$arrinfos[]='fb_link';
								$arrinfos[]='gp_link';
								$arrinfos[]='tw_link';
								$arrinfos[]='youtube_link';
								$arrinfos[]='pin_link';								
								$arrinfos[]='siteemail';								
                                $infos=getArraySettingsInfo($arrinfos);


								?>
								<a href="<?php if(!empty($infos[1])){echo $infos[1]['svalue']; }?>" target="_blank"><img src="<?php echo image_url('icon/fb.png');?>" alt="facebook" title="Facebook" width="42" /></a>
								<a href="<?php if(!empty($infos[3])){echo $infos[3]['svalue']; }?>" target="_blank"><img src="<?php echo image_url('icon/googleplus.png');?>" alt="googleplus" title="Googleplus" width="42" /></a>
								<a href="<?php if(!empty($infos[2])){echo $infos[2]['svalue']; }?>" target="_blank"><img src="<?php echo image_url('icon/twitter.png');?>" alt="twitter" title="Twitter" width="42" /></a>
								<a href="<?php if(!empty($infos[5])){echo $infos[5]['svalue']; }?>"><img src="<?php echo image_url('icon/youtube.png');?>" alt="youtube" title="Youtube" width="42" /></a>
								<a href="<?php if(!empty($infos[4])){echo $infos[4]['svalue']; }?>"><img src="<?php echo image_url('icon/pinterest.png');?>" alt="pinterest" title="Pinterest" width="42" /></a>
								<a href="mailto:<?php if(!empty($infos[0])){echo $infos[0]['svalue']; }?>" target="_blank"><img src="<?php echo image_url('icon/messages.png');?>" alt="Email" title="Email" width="42" /></a>
							</div>
						</div>
						
					</div>
					<div class="col-sm-4">
						<div class="newsletter">
							<h4 class="new_title no-margin text-uppercase">Sign up for latest updates & sales</h4>
							<form class="newsletterform text-center">
								<input type="email" class="form-control" placeholder="info@hiberce.com" required="" />
								<label class="newlabel"><input type="checkbox" /> ACCEPT HIBERCE TERMS AND CONDITIONS</label>
							</form>
							
							<div class="trademark text-center">
								<img src="<?php echo image_url('icon/footer_verified_seller.png');?>" />
								
								<h5 class="trademarktxt">Trade assurance for all purchases</h5>
							</div>
						</div>
					</div>
					
					<div class="clearfix"></div>
					<div class="col-sm-12">
					<div class="footerserrch">
						<div class="row">
						<div class="col-sm-9">
							<form class="contry-search" accept="#" method="post">
								<div class="footerselect">
									<!--<span>Country:</span>-->
									<select class="form-control">
										<option>Country: Argentina</option>
										<option>UK</option>
										<option>USA</option>
										<option>India</option>
									</select>
								</div>
								<div class="footerselect">
									<!--<span>Language:</span>-->
									<select class="form-control">
										<option>Language: English</option>
										<option>franchise</option>
										<option>Germani</option>
									</select>
								</div>
								<div class="footerselect">
									<!--<span>Currency:</span>-->
									<select class="form-control">
										<option>Currency: US Dollers ($)</option>
										<option>US Dollers ($)</option>
										<option>US Dollers ($)</option>
									</select>
								</div>
							</form>
						</div>
						<div class="col-sm-3">
							<span class="copyright">&copy; 2016 Hiberce.com All Rights Reserved</span>
						</div>
						</div>
					</div>
					</div>
					
				</div>
			</div>
		</footer>
		
		<section class="footer-bottom">
			<div class="container">
				<div class="">
					<img src="<?php echo image_url('footer-icon.jpg');?>" class="img-responsive" />
				</div>
			</div>
		</section>
		
		<!-- Footer End -->
		
		
		<!-- Custom Script -->
		
		<!--<script src="js/custom.js"></script>-->
		<script src="<?php echo js_url('lightbox.js');?>"></script>
		<script type="text/javascript">
		    jQuery(function($){
		          $('.section-second').vidbg({
		              'mp4': 'media/Front_end_video.mp4',
		              'webm': 'media/Front_end_video.webm',
		              'poster': 'media/banner.jpg',
		          }, {
		            // Options
		            muted: true,
		            loop: true,
					overlay: true,
		            overlayColor: '#03A9F4',
		            overlayAlpha: 0.8,
		          });
		      });
		</script>
		<script src="<?php echo js_url('vidbg.min.js');?>"></script>
		
		
		<script>
			$(document).ready(function(){
			    $("#forpsw").click(function(){
			        $("#login").removeClass("in");
			    });
			    $("#closeforgot").click(function(){
			        $("#login").addClass("in");
			    });
			   
			});
		</script>
		<!-- Business Page Script -->
		<script>
			$(document).ready(function(){
			    var h = $("img.bpol-lafeimg").height();
			    $(".bpol-right").height(h);
			});
			
			
			$.scrollify({
			section:".scorlify",
			//sectionName:false,
			scrollSpeed:1100,
			after:function(i) {


			

		}
	});
			
			
			
		</script>
		
		<script type="text/javascript" src="<?php echo js_url('jquery.validate.min.js');?>"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo css_url('jquery-confirm.min.css');?>">
        <script type="text/javascript" src="<?php echo js_url('jquery-confirm.min.js');?>"></script>
        <script type="text/javascript" src="<?php echo js_url('hiberce.js');?>"></script>



    <?php

	   $errormessage=(empty($this->session->flashdata('errormessage')))? '':$this->session->flashdata('errormessage'); 
	   $successmessage=(empty($this->session->flashdata('successmessage')))? '':$this->session->flashdata('successmessage');
	   $registermessage=(empty($this->session->flashdata('registermessage')))? '':$this->session->flashdata('registermessage');
      if($errormessage)
      {
      ?>
      <script type="text/javascript">
      	

      	$(function(){
			$.alert({
			icon: 'fa fa-exclamation-circle',
		    title: 'Warning',
		    content: '<?php echo $errormessage;?>',
	    	autoClose: 'confirm|3000',
			confirmButtonClass: 'btn-info'
		});

      	});
      </script>
      <?php
      }
      if($successmessage)
      {
      ?>
       <script type="text/javascript">
      	$(function(){
			$.alert({
			icon: 'fa fa-exclamation-circle',
		    title: 'Notification',
		    content: '<?php echo $successmessage;?>',
	    	autoClose: 'confirm|3000',
			confirmButtonClass: 'btn-info'
		});

      	});
      </script>
      <?php
      }
      ?>

      <?php
     
      if($registermessage)
      {
      ?>
       <script type="text/javascript">
      	$(function(){
			$.alert({
			icon: 'fa fa-exclamation-circle',
		    title: 'Notification',
		    content: '<?php echo $registermessage;?>',
	    	autoClose: 'confirm|3000',
			confirmButtonClass: 'btn-info',
			// onClose: function () {
   //              $("#login").modal('show');
        
   //         }
		});

      	});
      </script>
      <?php
      }
      ?>


    <?php if(!empty($this->session->userdata('sess_recoverlink'))) { echo $this->session->userdata('sess_recoverlink');?>

     <script type="text/javascript">
     	
     	$(function(){

     		$("#recoverpsw").modal('show');
     	})
     </script>

    <?php } ?>

	</body>
</html>

<!-- END OF FOOTER -->

<script>
    function passwordStrength(password)
    {
        var desc = new Array();
        desc[0] = "Very Weak";
        desc[1] = "Weak";
        desc[2] = "Better";
        desc[3] = "Medium";
        desc[4] = "Strong";
        desc[5] = "Strongest";

        var score = 0;

        //if password bigger than 6 give 1 point
        if (password.length > 6)
            score++;

        //if password has both lower and uppercase characters give 1 point	
        if ((password.match(/[a-z]/)) && (password.match(/[A-Z]/)))
            score++;

        //if password has at least one number give 1 point
        if (password.match(/\d+/))
            score++;

        //if password has at least one special caracther give 1 point
        if (password.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/))
            score++;

        //if password bigger than 12 give another 1 point
        if (password.length > 12)
            score++;

        document.getElementById("passwordDescription").innerHTML = desc[score];
        document.getElementById("passwordStrength").className = "strength" + score;
    }
</script>
