<?php 
/*<style>
body
{
	margin:0px;
	padding:0px;
	font-size:10px;
	font-family:Tahoma,Verdana,Arial;
}
a:hover
{
	color:#fff;
}

#user_registration
{
	border:1px solid #cccccc;
	margin:auto auto;
	margin-top:100px;
	width:400px;
}


#user_registration label
{
        display: block;  
	float: left; 
	width: 70px;
	margin: 0px 10px 0px 5px; 
	text-align: right; 
	line-height:1em;
	font-weight:bold;
}

#user_registration input
{
	width:250px;
}

#user_registration p
{
	clear:both;
}

#submit
{
	border:1px solid #cccccc;
	width:100px !important;
	margin:10px;
}

h1
{
	text-align:center;
}

#passwordStrength
{
	height:10px;
	display:block;
	float:left;
}

.strength0
{
	width:250px;
	background:#cccccc;
}

.strength1
{
	width:50px;
	background:#ff0000;
}

.strength2
{
	width:100px;	
	background:#ff5f5f;
}

.strength3
{
	width:150px;
	background:#56e500;
}

.strength4
{
	background:#4dcd00;
	width:200px;
}

.strength5
{
	background:#399800;
	width:250px;
}


</style>


<link rel="stylesheet" media="screen" href="<?php echo base_url('assets/front/css/bootstrap3.css'); ?>" />
<link rel="stylesheet" media="screen" href="<?php echo base_url('assets/front/js/bootstrap3.js'); ?>" />

*/ ?>
<section id="wrapper">

    <div id="page-content-wrapper">
  <form action="<?php echo base_url('front/buyerimage'); ?>" method="post" id="buyerFormImage" name="buyerFormImage" enctype='multipart/form-data'>


   <?php $path=image_url('buyears/banner4.jpg'); if (!empty($details->banner_pic) && file_exists(BASEPATH . "../assets/uploads/buyers/banners/" . $details->banner_pic)) { $path=base_url('assets/uploads/buyers/banners/'.$details->banner_pic); } ?>

        <section class="faq-banner" style="background-image: url(<?php echo $path; ?>">

            <div class="container-fluid">
                <div class="row">
                    <div class="banner-text">
                      
                            <div>
                               
                                <input type="hidden" id="old_profile_image" name="old_profile_image" value="<?php if (!empty($details->profile_pic)) {
    echo $details->profile_pic;
} ?>">
                                <input type="hidden" id="old_banner_image" name="old_banner_image" value="<?php if (!empty($details->banner_pic)) {
    echo $details->banner_pic;
} ?>">
                            </div>
                            <div class="col-sm-3 col-md-2 col-md-offset-1">



                                <div class="change_profile_pic">
                                    <?php if (!empty($details->profile_pic) && file_exists(BASEPATH . "../assets/uploads/buyers/" . $details->profile_pic)) { ?>
                                        <img src="<?php echo base_url('assets/uploads/buyers') . '/' . $details->profile_pic; ?>" alt="" class="bp_pic img-circle img-responsive" width="101" height="101" />
                                    <?php } else { ?>

    <?php if (!empty($this->session->userdata('sess_social_pic'))) {
        ?>
                                            <img src="<?php echo $this->session->userdata('sess_social_pic'); ?>" alt="" class="bp_pic img-circle img-responsive" width="101" height="101" />

        <?php } else {
        ?>
                                            <img src="<?php echo image_url('buyears/bufeed-img1.png'); ?>" alt="" class="bp_pic img-circle img-responsive" width="101" height="101" />

                                        <?php } ?>

<?php } ?>
                                    <div class="input-file text-center">
                                        <span class="upload_pic_btn" style="border-radius: 0;">Edit</span>
                                        <input type="file" id="profile_image" name="bp_pic">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-9">
                                <div class="bp_dtls">
                                    <h2 class="text-uppercase heading2 mt-0 whitecolor text-left"><?php if (!empty($details->fname)) {
    echo $details->fname;
} ?> <?php if (!empty($details->lname)) {
    echo $details->lname;
} ?>
                                    </h2>
                                    <h5 class="heading4 whitecolor text-left"><?php if (!empty($details->address)) {
    echo "From " . $details->address;
} ?></h5>
                                    <button class="no-border themebg1 text-uppercase text-left full_btn">Save Changes</button>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </section>


         <section class="business-pronav">
            <div class="text-center profile_banner_img_change">
                <input type="file" name="bp_pic_banner" class="bannerimg_file" id="banner_image"/>
                <a href="#">Edit Banner Image</a>
            </div>
        </section>

       </form>

        <section class="buy_acc_dtls">
            <div class="col-sm-12 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
<?php /*if (empty($details->facebook_id) && empty($details->google_id)) { */ ?>
                    <h2 class="heading2 mb-40"><span class="text-uppercase">My Account</span> <small class="pull-right heading4"><?php echo userProfileCompleteData(); ?> % Complete</small></h2>

<?php /* } */?>



                <div class="row">


                        <div class="myaccstep1">

                        <?php if (empty($details->facebook_id) && empty($details->google_id)) { ?>

                            <form action="<?php echo base_url('front/basicinfo'); ?>" method="post" class="lr-form" id="buyerBasicForm" name="buyerBasicForm">
                                <div class="form-group col-sm-6">
                                    <label for="mnumber">Mobile Number<span class="mendatarymark">*</span></label>
                                    <input type="text" class="form-control" name="mnumber" id="mnumber" placeholder="+27 82 570 9950" value="<?php if (!empty($details->mobile)) {
        echo $details->mobile;
    } ?>"/>
                                </div>

                                <div class="form-group col-sm-6">
                                    <label for="emailadd">Email Address<span class="mendatarymark">*</span></label>
                                    <input type="email" class="form-control" name="emailadd" id="emailadd" placeholder="emma.watson@gmail.com" value="<?php if (!empty($details->email)) {echo $details->email;} ?>"/>
                                </div>

                                <div class="form-group col-sm-6">
                                    <label for="psw">Password<span class="mendatarymark">*</span><span> (Can Only be Changed once a day)</span></label>
                                    <input type="password" class="form-control" name="psw" id="psw" placeholder="**************"  onkeyup="passwordStrength(this.value)"/>
                                </div>

                                <div class="form-group col-sm-6">
                                    <label for="conpsw">Confirm Password<span class="mendatarymark">*</span></label>
                                    <input type="password" class="form-control" name="conpsw" id="conpsw" placeholder="**************" />
                                </div>

                                <div class="form-group col-sm-6">
                                    <p>
                                       <label for="passwordStrength">Password strength</label>
                                    <div id="passwordDescription">Password not entered</div>
                                    <div id="passwordStrength" class="strength0"></div>
                                    </p>
                                </div>



                                <div class="form-group col-sm-6 text-right">
                                    <input type="submit" value="change password" class="no-border themebg1 text-uppercase full_btn" />
                                </div>
                            </form>

                                    <?php }else{ ?>
							  <form action="<?php echo base_url('front/basicinfosocial'); ?>" method="post" class="lr-form" id="buyerBasicFormSocial" name="buyerBasicFormSocial">


 								<div class="form-group col-sm-6">
                                    <label for="mnumber">Mobile Number<span class="mendatarymark">*</span></label>
                                    <input type="text" class="form-control" name="mnumber" id="mnumber" placeholder="+27 82 570 9950" value="<?php if (!empty($details->mobile)) {echo $details->mobile;} ?>"/>
                                </div>

                                <div class="form-group col-sm-6">
                                    <label for="emailadd">Email Address<span class="mendatarymark">*</span></label>
                                    <input type="email" class="form-control" name="emailadd" id="emailadd" placeholder="emma.watson@gmail.com" value="<?php if (!empty($details->email)) {echo $details->email;} ?>"  readonly="readonly"/>
                                </div>



                                <div class="form-group col-sm-6 text-right">
                                    <input type="submit" value="SAVE CHANGES" class="no-border themebg1 text-uppercase full_btn" />
                                </div>
							  </form>

                                    <?php  } ?>

                        </div>

                    <form action="<?php echo base_url('front/personalinfo'); ?>" method="post" class="lr-form" id="buyerProfileForm" name="buyerProfileForm">

                        <div class="myaccstep2">

                            <div class="col-sm-12">
                                    <!-- <h2 class="heading2 mb-40"><span class="text-uppercase">PERSONAL INFORMATION</span></h2> -->
                                <h2 class="heading2 mb-40"><span class="text-uppercase">PERSONAL INFORMATION</span>
<?php if (!empty($details->facebook_id) && !empty($details->google_id)) { ?>
                                        <small class="pull-right heading4">
    <?php echo userProfileCompleteData(); ?> % Complete
                                        </small>
<?php } ?>
                                </h2>


                            </div>


                            <div class="form-group col-sm-6">
                                <label for="fname">Name<span class="mendatarymark">*</span></label>
                                <input type="text" class="form-control" name="fname" id="fname" placeholder="Emma" value="<?php if (!empty($details->fname)) {
    echo $details->fname;
} ?>"/>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="sname">Surname<span class="mendatarymark">*</span></label>
                                <input type="text" class="form-control" name="sname" id="sname" placeholder="Watson" value="<?php if (!empty($details->lname)) {
    echo $details->lname;
} ?>"/>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="jtitle">Job Title</label>
                                <input type="text" class="form-control" name="jtitle" id="jtitle" placeholder="Designer "  value="<?php if (!empty($details->job_title)) {
    echo $details->job_title;
} ?>"/>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="employer">Employer</label>
                                <input type="text" class="form-control" name="employer" id="employer" placeholder="Apple California"  value="<?php if (!empty($details->employer)) {
    echo $details->employer;
} ?>"/>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="sex">Gender</label>
                                <select class="form-control" name="sex" id="sex">
                                    <option value=''>PLEASE SELECT</option>
                                    <option value='M' <?php if (!empty($details->gender) && $details->gender == 'M') {
    echo'selected="selected"';
} ?>>Male</option>
                                    <option  value='F' <?php if (!empty($details->gender) && $details->gender == 'F') {
    echo'selected="selected"';
} ?>>Female</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="datepicker">Date of Birth</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><img src="<?php echo image_url('icon/date-icon.png'); ?>" width="20"></span>
                                    <input type="text" class="form-control" name="dob" id="datepicker" placeholder="12/05/1998"  value="<?php if (!empty($details->dob)) {
    echo date("m/d/Y", strtotime($details->dob));
} ?>"/>
                                </div>
                            </div>

                            <div class="form-group col-sm-6">
                                <label for="sattent">School Attended</label>
                                <input type="text" class="form-control" placeholder="School Attended" name="satent" id="sattent" value="<?php if (!empty($details->highest_edu_from)) {
    echo $details->highest_edu_from;
} ?>"/>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="datepicker1">Year of Study Completion</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><img src="<?php echo image_url('icon/date-icon.png'); ?>" width="20"></span>
                                    <input type="text" class="form-control" name="yr_of_pasing" id="datepicker1" placeholder="12/05/1998" value="<?php if (!empty($details->year_of_passing)) {
    echo date("m/d/Y", strtotime($details->year_of_passing));
} ?>"/>
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="education">Education</label>
                                <select class="form-control" id="education" name="education">
                                    <option value=''>PLEASE SELECT</option>

                                    <option value='S' <?php if (!empty($details->highest_education) && $details->highest_education == 'S') {
    echo'selected="selected"';
} ?>>School</option>
                                    <option value='C' <?php if (!empty($details->highest_education) && $details->highest_education == 'C') {
    echo'selected="selected"';
} ?>>College</option>
                                    <option value='U' <?php if (!empty($details->highest_education) && $details->highest_education == 'U') {
    echo'selected="selected"';
} ?>>University</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="relation">Relationship Status</label>
                                <select class="form-control" id="relation" name="relation">
                                    <option value=''>PLEASE SELECT</option>

                                    <option value='S' <?php if (!empty($details->relationship_status) && $details->relationship_status == 'S') {
    echo'selected="selected"';
} ?>>Single</option>
                                    <option value='M' <?php if (!empty($details->relationship_status) && $details->relationship_status == 'M') {
    echo'selected="selected"';
} ?>>Married</option>
                                    <option value='E' <?php if (!empty($details->relationship_status) && $details->relationship_status == 'E') {
    echo'selected="selected"';
} ?>>Engaged</option>
                                    <option value='W' <?php if (!empty($details->relationship_status) & $details->relationship_status == 'W') {
    echo'selected="selected"';
} ?>>Widow</option>
                                </select>
                            </div>

                        </div>


                        <div class="myaccstep3">
                            <div class="col-sm-12">
                                <h2 class="heading2 mb-40"><span class="text-uppercase">MY INTERESTS</span></h2>

                            </div>

<?php
if (!empty($interests)) {
    $i = 0;
    foreach ($interests as $row) {
        ?>

                                    <div class="form-group col-sm-4">
                                        <div class="checkbox checkbox-success">
                                            <input type="checkbox" name="checkbox[]" id="checkbox-<?php echo $i; ?>" value="<?php echo $row->id; ?>" class="styled" <?php if (!empty($buyerinterests) && in_array($row->id, $buyerinterests)) {
            echo "checked='checked'";
        } ?> />
                                            <label for="checkbox-<?php echo $i; ?>" class="control-label"> <?php echo $row->interest; ?> </label>
                                        </div>
                                    </div>

        <?php $i++;
    }
} ?>


                        </div>
                        <div class="myaccstep3">
                            <div class="col-sm-12">
                                <h2 class="heading2 mb-40"><span class="text-uppercase">ADDRESS DETAILS</span></h2>
                            </div>

                            <div class="form-group col-sm-6">
                                <label for="addressser">Search for your Address<span class="mendatarymark">*</span></label>
                                <!-- <input type="text" class="form-control" name="addressser" id="addressser" placeholder="Centurion" /> -->
                                <input type="text" class="form-control" name="autocomplete" id="autocomplete" placeholder="Centurion" value="<?php if (!empty($details->address)) {
    echo $details->address;
} ?>" />
                            </div>
                            <div class="col-sm-12">

                                <div id="map"></div>
                            </div>
                        </div>
                           <div class="form-group col-sm-6">
                                <label for="addr">Address 2*</label>
                                <input type="text" class="form-control" name="street_number" id="street_number" placeholder="Address 2"  value="<?php if (!empty($details->address2)) { echo $details->address2;} ?>"/>
                            </div>
                        
                          <div class="form-group col-sm-6">
                                <label for="stat">State/ Province*</label>
                                <input type="text" class="form-control" name="administrative_area_level_1" id="administrative_area_level_1" placeholder="State/ Province"  value="<?php if (!empty($details->state)) { echo $details->state;} ?>"/>
                            </div>
                       
                        
                          <div class="form-group col-sm-6">
                                <label for="cou">Country*</label>
                                <input type="text" class="form-control" name="country" id="country" placeholder="Country"  value=" <?php if (!empty($details->country)) { echo $details->country;} ?>"/>
                            </div>
                          <div class="form-group col-sm-6">
                                <label for="zp">Zip/ Postal code*</label>
                                <input type="text" class="form-control" name="postal_code" id="postal_code" placeholder="Zip/ Postal code"  value="<?php if (!empty($details->zip)) { echo $details->zip;} ?>"/>
                            </div>
                        <div class="col-sm-6">
                            <h5 class="heading4"><?php echo userProfileCompleteData(); ?>% complete</h5>
                        </div>
                        <div class="col-sm-6 text-right">
                            <input type="submit" value="SAVE CHANGES" class="no-border themebg1 text-uppercase full_btn">
                        </div>

                    </form>

                </div>

        </section>
    </div>

    <!-- SIDE BAR -->
    <div id="sidebar-wrapper" class="leftsidebar" >
        <nav id="spy" class="sidebar-nav">
            <div class="online_list">
                <form class="ui-filterable">
                    <input id="filterUser" name="filterUser" class="form-control" placeholder="FIND CONNECTION">
                </form>
                <h2 class="chatlisttitle heading4 text-uppercase">
                    <img src="<?php echo image_url('sidebar-icon/icon1.png'); ?>" />
                    <span>CONNECTIONS</span>
                </h2>
                <h4 class="chatlist-cat-title text-uppercase">
                    <img src="<?php echo image_url('sidebar-icon/icon2.png'); ?>" />
                    <span>FRIENDS</span>
                </h4>
                <ul class="nav onlinesearchnav">
                    <li class="sidebar-brand">
                        <a href="#">
                            <img src="<?php echo image_url('sidebar-icon/pro-pic1.jpg'); ?>" width="36" class="img-circle" alt="ISAAC NEWTOWN" />
                            <span class="chatname">ISAAC NEWTOWN</span><br />
                            <span class="chatlocation">California</span>
                            <span class="online status"></span>
                        </a>
                    </li>
                    <li class="sidebar-brand">
                        <a href="#">
                            <img src="<?php echo image_url('sidebar-icon/pro-pic2.jpg'); ?>" width="36" class="img-circle" alt="ISAAC NEWTOWN" />
                            <span class="chatname">ISAAC NEWTOWN</span><br />
                            <span class="chatlocation">California</span>
                            <span class="away status"></span>
                        </a>
                    </li>
                    <li class="sidebar-brand">
                        <a href="#">
                            <img src="<?php echo image_url('sidebar-icon/pro-pic3.jpg'); ?>" width="36" class="img-circle" alt="ISAAC NEWTOWN" />
                            <span class="chatname">ISAAC NEWTOWN</span><br />
                            <span class="chatlocation">California</span>
                            <span class="away status"></span>
                        </a>
                    </li>
                    <li class="sidebar-brand" data-toggle="collapse" data-target="#chat">
                        <a href="javascript:void(0);">
                            <img src="<?php echo image_url('sidebar-icon/pro-pic4.jpg'); ?>" width="36" class="img-circle" alt="ISAAC NEWTOWN" />
                            <span class="chatname">ISAAC NEWTOWN</span><br />
                            <span class="chatlocation">California</span>
                            <span class="dnd status"></span>
                        </a>
                    </li>
                    <li class="sidebar-brand">
                        <a href="#">
                            <img src="<?php echo image_url('sidebar-icon/pro-pic5.jpg'); ?>" width="36" class="img-circle" alt="ISAAC NEWTOWN" />
                            <span class="chatname">ISAAC NEWTOWN</span><br />
                            <span class="chatlocation">California</span>
                            <span class="offline status"></span>
                        </a>
                    </li>
                    <li class="sidebar-brand">
                        <a href="#">
                            <img src="<?php echo image_url('sidebar-icon/pro-pic6.jpg'); ?>" width="36" class="img-circle" alt="ISAAC NEWTOWN" />
                            <span class="chatname">ISAAC NEWTOWN</span><br />
                            <span class="chatlocation">California</span>
                            <span class="offline status"></span>
                        </a>
                    </li>
                </ul>

                <div class="clearfix"></div>
                <h4 class="chatlist-cat-title text-uppercase">
                    <img src="<?php echo image_url('sidebar-icon/icon1.png'); ?>" />
                    <span>BUSINESS CONNECTIONS</span>
                </h4>
                <ul class="nav onlinesearchnav">
                    <li class="sidebar-brand">
                        <a href="#">
                            <img src="<?php echo image_url('sidebar-icon/pro-pic1.jpg'); ?>" width="36" class="img-circle" alt="ISAAC NEWTOWN" />
                            <span class="chatname">ISAAC NEWTOWN</span><br />
                            <span class="chatlocation">California</span>
                            <span class="online status"></span>
                        </a>
                    </li>
                    <li class="sidebar-brand">
                        <a href="#">
                            <img src="<?php echo image_url('sidebar-icon/pro-pic2.jpg'); ?>" width="36" class="img-circle" alt="ISAAC NEWTOWN" />
                            <span class="chatname">ISAAC NEWTOWN</span><br />
                            <span class="chatlocation">California</span>
                            <span class="away status"></span>
                        </a>
                    </li>
                    <li class="sidebar-brand">
                        <a href="#">
                            <img src="<?php echo image_url('sidebar-icon/pro-pic3.jpg'); ?>" width="36" class="img-circle" alt="ISAAC NEWTOWN" />
                            <span class="chatname">ISAAC NEWTOWN</span><br />
                            <span class="chatlocation">California</span>
                            <span class="away status"></span>
                        </a>
                    </li>
                </ul>

            </div>
        </nav>

    </div>
    <!-- Chat Section -->

    <div class="chathistory collapse" id="chat">
        <div class="chathis_msg">
            <div class="send_msg">
                <span class="themetxtcolor">You: Hey Isaac How are you?</span>
            </div>
            <div class="recive_msg text-right">
                <span class="normalxtcolor">Isaac: Hey Isaac How are you?</span>
            </div>
            <div class="send_msg">
                <span class="themetxtcolor">You: Hey Isaac How are you?</span>
            </div>
            <div class="recive_msg text-right">
                <span class="normalxtcolor">Isaac: Hey Isaac How are you?</span>
            </div>
            <div class="send_msg">
                <span class="themetxtcolor">You: Hey Isaac How are you?</span>
            </div>
            <div class="recive_msg text-right">
                <span class="normalxtcolor">Isaac: Hey Isaac How are you?</span>
            </div>
        </div>
        <div class="commentbox">
            <form class="commentform" action="#" method="post">
                <div class="">
                    <div class="input-group">
                        <input type="text" class="form-control" name="name" id="name"  placeholder="Write Isaac a message..."/>
                        <span class="input-group-addon">
                            <a href="#"><img src="<?php echo image_url('buyears/smile.png'); ?>" alt="Smile" width="20" /></a>
                            <!--<input type="file" name="attachfile" />-->
                            <span class="fileimg fa fa-image"></span>
                        </span>

                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Chat Section End -->


    <a id="menu-toggle" href="javascript:void(0);" class="toggle">
        <img src="<?php echo image_url('buyears/sidebar-arrow.png'); ?>" />
    </a>

    <!-- SIDE BAR -->




</section>

<style type="text/css">

    #map{height:500px;width:100%;}
</style>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD_rltYmZkUvHeJq_cLlnl0bMf7yhWcxa8&signed_in=true&libraries=places&callback=initAutocomplete" async defer></script>

<script type="text/javascript">

                                    var placeSearch, autocompletes;
                                    var componentForm1 = {
                                        street_number: 'short_name',
                                        route: 'long_name',
                                        locality: 'long_name',
                                        administrative_area_level_1: 'short_name',
                                        country: 'long_name',
                                        postal_code: 'short_name'
                                    };

                                    function initAutocomplete() {
                                        initMap(1.4854, 103.7618);
                                        // Create the autocomplete object, restricting the search to geographical
                                        // location types.
                                        autocomplete = new google.maps.places.Autocomplete(
                                                /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
                                                {types: ['geocode']});

                                        // When the user selects an address from the dropdown, populate the address
                                        // fields in the form.
                                        autocomplete.addListener('place_changed', fillInAddress);

                                    }

// [START region_fillform]
                                    function fillInAddress() {
                                        // Get the place details from the autocomplete object.
                                        var place = autocomplete.getPlace();
                                        var lat = place.geometry.location.lat();
                                        var lng = place.geometry.location.lng();
                                        initMap(lat, lng);

                                        for (var component in componentForm1) {
                                            document.getElementById(component).value = '';
                                            document.getElementById(component).disabled = false;
                                        }
                                        document.getElementById('lat').value = lat;
                                        document.getElementById('lng').value = lng;
                                        // Get each component of the address from the place details
                                        // and fill the corresponding field on the form.
                                        for (var i = 0; i < place.address_components.length; i++) {
                                            var addressType = place.address_components[i].types[0];

                                            if (componentForm[addressType]) {
                                                var val = place.address_components[i][componentForm[addressType]];
                                                if (addressType == street_number)
                                                {
                                                    addressType = street_number1;
                                                }
                                                if (addressType == route)
                                                {
                                                    addressType = route1;
                                                }
                                                if (addressType == locality)
                                                {
                                                    addressType = locality1;
                                                }
                                                if (addressType == administrative_area_level_1)
                                                {
                                                    addressType = administrative_area_level_11;
                                                }
                                                if (addressType == country)
                                                {
                                                    addressType = country1;
                                                    $("#country").val(country1);
                                                }
                                                if (addressType == postal_code)
                                                {
                                                    addressType = postal_code1;
                                                    $("#zip").val(postal_code1);

                                                }
                                                document.getElementById(addressType).value = val;
                                            }
                                        }
                                    }
// [END region_fillform]

// [START region_geolocation]
// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
                                    function geolocate() {
                                        if (navigator.geolocation) {
                                            navigator.geolocation.getCurrentPosition(function (position) {
                                                var geolocation = {
                                                    lat: position.coords.latitude,
                                                    lng: position.coords.longitude
                                                };

                                                var circle = new google.maps.Circle({
                                                    center: geolocation,
                                                    radius: position.coords.accuracy
                                                });
                                                autocomplete.setBounds(circle.getBounds());
                                            });
                                        }
                                    }
// [END region_geolocation]
                                    var map;
                                    var infowindow;

                                    function initMap(lat, lng) {
                                        var myLatLng = {lat: lat, lng: lng};

                                        var map = new google.maps.Map(document.getElementById('map'), {
                                            zoom: 16,
                                            center: myLatLng
                                        });

                                        var marker = new google.maps.Marker({
                                            position: myLatLng,
                                            map: map
                                        });
                                    }
</script>


<script>
    $("#menu-toggle").click(function (e) {
        e.preventDefault();
        $("#wrapper").toggleClass("active");
        //alert(1);
    });

    /*$(document).ready(function(){
     var h = $( window ).height();
     $("#sidebar-wrapper").height(h);
     });*/


    jQuery("#filterUser").keyup(function () {
        var filter = jQuery(this).val();
        jQuery(".onlinesearchnav li").each(function () {
            if (jQuery(this).text().search(new RegExp(filter, "i")) < 0) {
                jQuery(this).hide();
            } else {
                jQuery(this).show();
            }
        });
    });



// scrolling side bar

    $(function () {

        var msie6 = $.browser == 'msie' && $.browser.version < 7;

        if (!msie6 && $('.leftsidebar').offset() != null) {
            var top = $('.leftsidebar').offset().top - parseFloat($('.leftsidebar').css('margin-top').replace(/auto/, 0));
            var height = $('.leftsidebar').height();
            var winHeight = $(window).height();
            var footerTop = $('#footer').offset().top - parseFloat($('#footer').css('margin-top').replace(/auto/, 0));
            var gap = 7;
            $(window).scroll(function (event) {
                // what the y position of the scroll is
                var y = $(this).scrollTop();

                // whether that's below the form
                if (y + winHeight >= top + height + gap && y + winHeight <= footerTop) {
                    // if so, ad the fixed class
                    $('.leftsidebar').addClass('leftsidebarfixed').css('top', winHeight - height - gap + 'px');
                } else if (y + winHeight > footerTop) {
                    // if so, ad the fixed class
                    $('.leftsidebar').addClass('leftsidebarfixed').css('top', footerTop - height - y - gap + 'px');
                } else
                {
                    // otherwise remove it
                    $('.leftsidebar').removeClass('leftsidebarfixed').css('top', '74px');
                }
            });
        }
    });





</script>

<?php if (!empty($this->session->userdata('sess_social_pic')) && empty($details->profile_pic)) { ?>

    <style type="text/css">

        .change_profile_pic .input-file span ,.change_profile_pic .input-file #profile_image ,.bp_dtls button{display:none;}
    </style>
<?php } ?>

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