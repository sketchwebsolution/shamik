
<!-- Cms Header Start -->
	
	<section class="tac_heade">
		<div class="header-breadcam">
			<img src="<?php echo image_url('cms/tac-img.jpg');?>" alt="Terms And Condition" title="Terms and condition" class="img-responsive" />
			<div class="headercontent text-center text-uppercase">
				<h1 class="heading1">THE BORING STUFF</h1>
				<h2 class="heading2">FIND ALL OUR LEGAL INFO HERE.</h2>
			</div>
		</div>
	</section>
	
	<section class="tac_nav">
		<div class="container">
		
			<ul class="haeding3 text-uppercase tac_list">
				<li><a href="<?php echo site_url('terms-and-conditions');?>" <?php if($this->uri->segment(1)=='terms-and-conditions'){ echo 'class="active"';} ?> >TERMS & CONDITIONS</a></li>
				<li><a href="<?php echo site_url('privacy-policy');?>"  <?php if($this->uri->segment(1)=='privacy-policy'){ echo 'class="active"';} ?>>PRIVACY POLICY</a></li>
			</ul>
		</div>
	</section>
	
	<section class="page-content text-justify">
		<div class="container">
			<div class="row">
				  <?php echo html_entity_decode($cms->content, ENT_QUOTES, 'utf-8'); ?>
			</div>
		</div>
	</section>
	
	<!-- Cms Header End -->	