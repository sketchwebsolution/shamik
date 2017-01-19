
    <div class="login-box">
      <div class="login-logo">
        <a href="<?php echo $this->config->item('base_url');?>admin"><b><img src="<?php echo base_url('assets/images/'.getsitename(true));?>" width="150" /></b></a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Put your Email to get the Password</p>
        <form action="<?php echo site_url('admin/checkemail');?>" method="post">
          <div class="form-group has-feedback">
            <input type="text" name="email" class="form-control" placeholder="Email"/>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Submit</button>
            </div><!-- /.col -->
          </div>
        </form>

        <a href="<?php echo base_url('admin');?>">I want to Login</a><br>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
    
    <?php
    $errormessage=$this->session->flashdata('errormessage');
    $successmessage=$this->session->flashdata('successmessage');
    if(!empty($errormessage) or !empty($successmessage))
    {
    ?>
    <div class="overlay"></div>
    <?php
    }
    ?>
    
    <?php
    if($errormessage)
    {
    ?>
    <div class="errormessage">
      <span><i class="fa fa-warning"></i></span>
      <div><?php echo $errormessage;?></div>
      <span class="closebutn"><i class="fa fa-close"></i></span>
    </div>
    <?php
    }
    if($successmessage)
    {
    ?>
    <div class="successmessage">
      <span><i class="fa fa-check-circle"></i></span>
      <div><?php echo $successmessage;?></div>
      <span class="closebutn"><i class="fa fa-close"></i></span>
    </div>
    <?php
    }
    ?>

   