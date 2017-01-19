  <div class="login-box">
      <div class="login-logo">
        <a href="<?php echo $this->config->item('base_url');?>admin"><b><img src="<?php echo base_url('assets/images/'.getsitename(true));?>" width="150" /></b></a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <form action="<?php echo $this->config->item('base_url');?>admin/checklogin" method="post">
          <div class="form-group has-feedback">
            <input type="text" name="email" class="form-control" placeholder="Email"/>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" name="password" class="form-control" placeholder="Password"/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">    
              <div class="checkbox icheck">
                <label>
                  <input type="checkbox" name="checkon" value="1"> Remember Me
                </label>
              </div>                        
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div><!-- /.col -->
          </div>
        </form>

        <a href="<?php echo site_url('admin/forget-password');?>">I forgot my password</a><br>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->