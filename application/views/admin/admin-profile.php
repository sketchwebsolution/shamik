
        <section class="content-header">
          <h1>
            Profile
            <small></small>
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Update Profile</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="<?php echo $this->config->item('base_url');?>admin/profupdate" method="post" enctype="multipart/form-data">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="fname">First Name</label>
                      <input type="text" class="form-control" id="fname" name="fname" placeholder="Enter First Name" value="<?php echo get_from_session('fname'); ?>">
                    </div>
                    <div class="form-group">
                      <label for="lname">Last Name</label>
                      <input type="text" class="form-control" id="lname" name="lname" placeholder="Enter Last Name" value="<?php echo get_from_session('lname'); ?>">
                    </div>
                    <div class="form-group">
                      <label for="username">Username</label>
                      <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username" value="<?php echo get_from_session('username'); ?>" readonly>
                    </div>
                    <div class="form-group">
                      <label for="email">Email</label>
                      <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" value="<?php echo get_from_session('email'); ?>" readonly>
                    </div>
                    <div class="form-group">
                     
                      <div class="fileinput fileinput-new" data-provides="fileinput">
                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                        <?php $img=get_from_session('image'); ?>
                          <img  src="<?php if(!empty($img)){ echo $this->config->item('upload_dir').get_from_session('image'); } else{ echo base_url('assets/uploads/placeholder.png');} ?>" data-src="<?php if(!empty($img)){ echo $this->config->item('upload_dir').get_from_session('image'); } else{ echo base_url('assets/uploads/placeholder.png');} ?>" alt="...">


                        </div>
                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                        <div>
                          <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" name="profile_pic"></span>
                          <a href="javascript:void(0);" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                        </div>
                      </div>
                    </div>
                    <input type="hidden" name="old-profile-pic" value="<?php echo $this->config->item('upload_dir').get_from_session('image'); ?>" id="old-profile-pic" />
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div><!-- /.box -->

          </div>   <!-- /.row -->
            
        </section><!-- /.content -->
     

<script type="text/javascript">
 $('.fileinput').on('change.bs.fileinput', function () {
  
});
</script>