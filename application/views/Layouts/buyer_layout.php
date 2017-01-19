<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="content-type" content="text/html" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta name="author" content="Hiberce" />
		<title><?php echo $title;?></title>
		
		<link href="<?php echo base_url('assets/front/css/style.css');?>" rel="stylesheet">
		<link href="<?php echo base_url('assets/front/css/inner-style.css');?>" rel="stylesheet">
		<link href="<?php echo base_url('assets/front/css/media.css');?>" rel="stylesheet">
		<link href="<?php echo base_url('assets/front/css/jquery-ui.css');?>" rel="stylesheet">
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="<?php echo css_url('lightbox.css');?>">
		<link rel="stylesheet" href="<?php echo css_url('jquery.mCustomScrollbar.css');?>"> <!-- Scrool Style -->
		<!--<link href="http://buzinas.github.io/simple-scrollbar/simple-scrollbar.css" rel="stylesheet"/>-->
		
		<!--<script src="js/jquery-1.11.3.min.js"></script>-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
		
		<!--<script src="js/jquery.mb.YTPlayer.js"></script>-->
		<script defer src="<?php echo js_url('bootstrap.js');?>"></script>
		<script type="text/javascript" src="<?php echo js_url('jquery-ui.js');?>"></script>
		<script> var baseurl='<?php echo base_url();?>';</script>
		<script type="text/javascript" src="<?php echo js_url('jquery.scrollify.js');?>"></script>

		<!--<script src="http://buzinas.github.io/simple-scrollbar/simple-scrollbar.min.js"></script>-->
		

		<!-- Scrollyfy Js -->
		<script src="<?php echo js_url('jquery.mCustomScrollbar.concat.min.js');?>"></script>
		<!--<script type="text/javascript" src="js/jquery.scrollify.js"></script>-->
	</head>
	
	<body>
		<header class="header" id="header">
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
					    <div class="col-sm-3 col-md-3 bdashboard_user no-padding">
					    	<div class="collapse pull-right navbar-collapse" id="bs-example-navbar-collapse-1">
	      						<ul class="nav navbar-nav full-width">
	      							<li class="dropdown">
							          <a href="#" class="dropdown-toggle" data-toggle="dropdown">

  									<?php 
  												$picname=get_from_session_front('profile_pic');
  														if (!empty($picname) && file_exists(BASEPATH . "../assets/uploads/buyers/" .$picname)) {
  									?>
                                        <img src="<?php echo base_url('assets/uploads/buyers') . '/' . $picname; ?>" alt="" class="profileimg" width="15" height="15" />
   										 <?php } else { ?>

    									<?php if (!empty($this->session->userdata('sess_social_pic'))) { ?>
                                            <img src="<?php echo $this->session->userdata('sess_social_pic'); ?>" alt="" class="profileimg" width="15" height="15" />

   									   <?php } else { ?>
                                            <img src="<?php echo image_url('buyears/bufeed-img1.png'); ?>" alt="" class="profileimg" width="15" height="15" />

                                        <?php } } ?>

							          <!-- <img src="<?php //echo image_url('business/profile-pic.png');?>" class="profileimg" /> <span class="username"> -->


							            <?php echo get_from_session_front('fname').'  '.get_from_session_front('lname');?></span><b class="pull-right"> <img src="<?php echo image_url('header-icon/bar-icon.png');?>" /></b></a> 
							          <ul class="dropdown-menu">
							          	<li class="dropdowntitle">Buyers</li>
							            <li><a href="#"><img src="<?php echo image_url('header-icon/store.png');?>" />Store</a></li>
							            <li><a href="#"><img src="<?php echo image_url('header-icon/feed.png');?>" />Feed</a></li>
							            <li><a href="#"><img src="<?php echo image_url('header-icon/profile.png');?>" />Profile</a></li>
							            <li><a href="#"><img src="<?php echo image_url('header-icon/wallet.png');?>" />Wallet</a></li>
							            <li><a href="#"><img src="<?php echo image_url('header-icon/order.png');?>" />Manage Orders</a></li>
							            <li class="dropdowntitle">Sellers</li>
							            <li class="sellerli"><a href="#">

  									<?php 
  												$picname=get_from_session_front('profile_pic');
  														if (!empty($picname) && file_exists(BASEPATH . "../assets/uploads/buyers/" .$picname)) {
  									?>
                                        <img src="<?php echo base_url('assets/uploads/buyers') . '/' . $picname; ?>" alt="" class="profileimg" width="15" height="15" />
   										 <?php } else { ?>

    									<?php if (!empty($this->session->userdata('sess_social_pic'))) { ?>
                                            <img src="<?php echo $this->session->userdata('sess_social_pic'); ?>" alt="" class="profileimg" width="15" height="15" />

   									   <?php } else { ?>
                                            <img src="<?php echo image_url('buyears/bufeed-img1.png'); ?>" alt="" class="profileimg" width="15" height="15" />

                                        <?php } } ?>
							            Switch TO the<br /> ilinkit dashboard</a></li>
							            <li><a href="#"><img src="<?php echo image_url('header-icon/add.png');?>" />Add Business Profile</a></li>
							            <li><a href="#"><img src="<?php echo image_url('header-icon/settings.png');?>" />Settings</a></li>
							            <li><a href="<?php echo site_url('logout');?>"><img src="<?php echo image_url('header-icon/onoff.png');?>" />Sign Out</a></li> 
							          </ul>
							        </li>
	      						</ul>
      						</div>
					    </div>
					    <div class="col-sm-3 col-md-4 header-search">
					        <form class="navbar-form no-padding no-margin text-center" role="search">
					        <div class="search-container mt-0">
					            <input type="text" id="search-bar" placeholder="Search For listings">
					            <a href="#"><img class="search-icon" src="<?php echo image_url('icon/search-icon.png');?>" width="24"></a>
					        </div>
					        </form>
					    </div>
					    <ul class="nav navbar-nav">
					      <li><a href="#"><img src="<?php echo image_url('icon/cart-icon.png');?>" /><span class="total-notif">1</span></a></li>
					      <li><a href="#"><img src="<?php echo image_url('icon/edit-icon.png');?>" /><span class="total-notif">1</span></a></li>
					      <li><a href="#"><img src="<?php echo image_url('icon/notifications.png');?>" /><span class="total-notif">1</span></a></li>
					      <li><a href="#"><img src="<?php echo image_url('icon/edit-icon.png');?>" /><span class="total-notif">1</span></a></li>
					      <li><a href="#"><img src="<?php echo image_url('icon/events-icon.png');?>" /><span class="total-notif">1</span></a></li>
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

			    <!-- Modal content-->
			    <div class="modal-content">
			      <button type="button" class="close" data-dismiss="modal">&times;</button>
			      <div class="modal-body">
			        <div class="login-form">
						<div class="box">
							<div class="social_btn">
								<button class="full_btn no-border themebg1 btn-facebook full-width"><img src="<?php echo image_url('icon/facebook-login.png');?>" class="fbicon" alt="facebook" title="Facebook" width="30" /> Register with Facebook</button>
							</div>

							<div class="social_btn">
								<button class="full_btn no-border themebg1 btn-twitter full-width"><img src="<?php echo image_url('icon/google-login.png');?>" class="fbicon" alt="facebook" title="Facebook" width="30" /> Register with Twitter</button>
							</div>

							<form action="#" method="post" class="lr-form">

								<div class="divider-form"></div>
								<h5 class="modal-title text-center text-uppercase">Sign In</h5>
								<div class="form-group">
									<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email Address">
								</div>
								<div class="form-group">
									<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
								</div>
								<div class="row">
								<div class="col-sm-6">
								<a href="#" class="forgot-psw thinfont themetxtcolor">Forgot Password ?</a>
								</div>
								<div class="col-sm-6 text-right changecheck">
									<input type="checkbox" class="editcheckhide" name="remember" id="remember" />&nbsp;&nbsp;&nbsp;
									<span class="edit-check"></span>
									<label for="remember" class="remember thinfont themetxtcolor">Keep me logged in</label>
								</div>
								</div>
								
								<div class="text-center logbtn">
									<button type="submit" class="xs_btn no-border themebg1 full_btn">Login</button>
								</div>
								<div class="signtxt text-center"><span class="themetxtcolor extrathinfont">Don't have an account?</span>  <a href="#">Sign up.</a></div>

								
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
								<button class="full_btn no-border themebg1 btn-facebook full-width"><img src="<?php echo image_url('icon/facebook-login.png');?>" class="fbicon" alt="facebook" title="Facebook" width="30" /> Register with Facebook</button>
							</div>

							<div class="reg_social_btn col-sm-6 mb-0">
								<button class="full_btn no-border themebg1 btn-twitter full-width"><img src="<?php echo image_url('icon/google-login.png');?>" class="fbicon" alt="facebook" title="Facebook" width="30" /> Register with Twitter</button>
							</div>
							</div>
							<form action="#" method="post" class="lr-form">

								<div class="divider-form"></div>
								<h5 class="modal-title text-center text-uppercase">SIGN UP</h5>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<input type="text" name="fname" class="form-control" id="fname" placeholder="First Name" required="" />
										</div>
									</div>
								
								
								<div class="col-sm-6">
									<div class="form-group">
										<input type="text" name="lname" class="form-control" id="lname" placeholder="Last Name" required="" />
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<input type="email" name="uemail" class="form-control" id="uemail" placeholder="Email Address" required="" />
									</div>
								</div>
								
								<div class="col-sm-6">
									<div class="form-group">
										<input type="password" name="upassword" class="form-control" id="upassword" placeholder="" required="" />
									</div>
								</div>
								<div class="changecheck">
									<div class="col-sm-1">
										<input type="checkbox" class="editcheckhide" name="conditioncheck" id="conditioncheck" />
										<span class="edit-check"></span>
									</div>
									<div class="col-sm-11">
										<label for="conditioncheck" class="condition-txt thinfont">By signing up, I agree to Hiberce’s Terms of Service, Payments Terms of Service, Privacy Policy, Guest Refund Policy, and Host Guarantee Terms.</label>
									</div>
								</div>
								<div class="text-center logbtn">
									<button type="submit" class="xs_btn no-border themebg1 full_btn">SIGN UP</button>
								</div>
								</div>
								<div class="signtxt text-center"><span class="themetxtcolor extrathinfont">Already have an account?</span><a href="#">  Sign In.</a></div>

							</form>
						</div>
					</div>
			      </div>
			      
			    </div>

			  </div>
			</div>
		</section>
		
		<!-- Modal End -->

	<?php echo $content;?>
		<!-- Footer Start -->



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
		<!--<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->
		
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
			    
			    
			    $("#rply_btn").click(function(){
			        $("#rdecline").removeClass("in");
			    });
			    $("#rply_close").click(function(){
			        $("#rdecline").addClass("in");
			    });
			    /*$('#forpsw').click(function(){
					$('#forgotpsw').modal({
						backdrop: 'static'
					});
				}); */
			    /*$('#forgotpsw').modal({
				    backdrop: 'static',   // This disable for click outside event
				    keyboard: true        // This for keyboard event
				})*/
			});
		</script>
		<!-- Business Page Script -->
		<script>
			$(document).ready(function(){
			    var h = $("img.bpol-lafeimg").height();
			    $(".bpol-right").height(h);
			});
			/*$(document).ready(function(){
			    var h = $(".describe_tab .col-md-9").height();
			    $(".rightnav_tab").height(h);
			});*/
			
			$.scrollify({
			section:".scorlify",
			//sectionName:false,
			scrollSpeed:1100,
			after:function(i) {


			/*
			if(i===2) {
				$.scrollify.setOptions({
					easing:"easeOutExpo"
				});
			}*/

			}
			});
			
			
			
		</script>
		
		<script>
		    $(function(){
			    $('#profile_image').change( function(e) {
			        
			        var img = URL.createObjectURL(e.target.files[0]);
			        $('.bp_pic').attr('src', img);
			    });
			});
		</script>

		<script>
			$( function() {
				$( "#datepicker" ).datepicker();
				$( "#datepicker1" ).datepicker();
			} );
			
			
			// Append Field
			
			$(document).ready(function() {
				var i=1;
				var j=1;
				$("#addholiday_field").click(function () {
				$("#addholi_time").append('<li><div class="col-sm-3 col-xs-12"><input type="text" class="form-control" placeholder="Holiday '+ i +'" /></div><div class="col-sm-3 col-xs-4 share_timeinput"><input type="text" class="form-control" placeholder="FORM" /></div><div class="col-sm-3 col-xs-4 share_timeinput"><input type="text" class="form-control" placeholder="UNTILL" /></div><div class="checkbox checkbox-success col-sm-3 col-xs-4"><input type="checkbox" name="checkbox" id="checkboxcpy-'+ i +'" value="1" class="styled"><label for="checkboxcpy-'+ i +'" class="control-label text-uppercase"> Closed </label></div></li>');
				i++;j++;
				});
				
			    
			});
			
			
			
			
		</script>
		
		<script>
			$(document).ready(function() {
			    // Configure/customize these variables.
			    var showChar = 100;  // How many characters are shown by default
			    var ellipsestext = "...";
			    var moretext = "Show More";
			    var lesstext = "Hide";
			    

			    $('.showmorecontent').each(function() {
			        var content = $(this).html();
			 
			        if(content.length > showChar) {
			 
			            var c = content.substr(0, showChar);
			            var h = content.substr(showChar, content.length - showChar);
			 
			            var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink themetxtcolor"><u>' + moretext + '</u></a></span>';
			 
			            $(this).html(html);
			        }
			 
			    });
			 
			    $(".morelink").click(function(){
			        if($(this).hasClass("less")) {
			            $(this).removeClass("less");
			            $(this).html(moretext);
			        } else {
			            $(this).addClass("less");
			            $(this).html(lesstext);
			        }
			        $(this).parent().prev().toggle();
			        $(this).prev().toggle();
			        return false;
			    });
			});
			
			
			// Comment show hide query inbusiness marketing add listing page
			
			$(document).ready(function(){
				$("#showcomment").hide();
			    $("#commentbox").click(function(){
			        $("#showcomment").slideToggle();
			    });
			}); 
		</script>
		
		<script type="text/javascript" src="<?php echo js_url('jquery.validate.min.js');?>"></script>
<!-- 
		<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/additional-methods.min.js"></script> -->

        <link rel="stylesheet" type="text/css" href="<?php echo css_url('jquery-confirm.min.css');?>">
        <script type="text/javascript" src="<?php echo js_url('jquery-confirm.min.js');?>"></script>
        <script type="text/javascript" src="<?php echo js_url('hiberce.js');?>"></script>
		<link rel="stylesheet" href="<?php echo css_url('hiberce.css');?>"> <!-- Scrool Style -->



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


    <style type="text/css">
    	

    </style>	
	</body>
</html>