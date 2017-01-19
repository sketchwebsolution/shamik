
        <section class="content-header">
          <h1>
            Moderator Profile
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
                  <h3 class="box-title">Add Moderator</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="<?php echo base_url('subadmin/admin/formsubadmin');?>" method="post" enctype="multipart/form-data" name="addsubadmin" id="addsubadmin" >
                  <div class="box-body">
                    <div class="form-group">
                      <label for="fname">First Name</label>
                      <input type="text" class="form-control" id="fname" name="fname" placeholder="Enter First Name" >
                    </div>
                    <div class="form-group">
                      <label for="lname">Last Name</label>
                      <input type="text" class="form-control" id="lname" name="lname" placeholder="Enter Last Name" >
                    </div>
                    <div class="form-group">
                      <label for="username">Username</label>
                      <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username" >
                    </div>
                    <div class="form-group">
                      <label for="email">Email</label>
                      <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" >
                    </div>
                    <div class="form-group">
                      <label for="email">Password</label>
                      <input type="password" class="form-control" id="pass" name="pass" placeholder="Enter Password" >
                    </div>
                    <div class="form-group">
                      <label>Role Group</label>

                      <select class="form-control" name=group>
                       <option value="">Select</option>

                      <?php
                        foreach($list as $li)
                        {
                      ?>
                          <option value="<?php echo $li->id ?>"><?php echo $li->group_name ?></option>>
                      <?php
                        }
                      ?>
                      </select>
                    </div>
                    <div class="form-group">
                     
                      <div class="fileinput fileinput-new" data-provides="fileinput">
                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                          <img  src="<?php echo $this->config->item('upload_dir')."placeholder.png"; ?>" data-src="<?php echo $this->config->item('upload_dir')."placeholder.png"; ?>" alt="..."> -->
                        </div>
                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                        <div>
                          <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" name="profile_pic"></span>
                          <a href="javascript:void(0);" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                        </div>
                      </div>
                    </div>
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Add</button>
                  </div>
                </form>
              </div><!-- /.box -->

          </div>   <!-- /.row -->
            
        </section><!-- /.content -->
     

<script type="text/javascript">
 $('.fileinput').on('change.bs.fileinput', function () {
  
});
</script>

<script>
          $("document").ready(function(){
            $("#addsubadmin").validate({
              rules:{
                fname:"required",
                lname:"required",
                username:"required",
                pass:"required",
                email:{
                  "required":true,
                  "email":true,
                  "remote":{
                           url:"<?php echo base_url() . 'subadmin/admin/checkUnique' ?>",
                           method:"post",
                           data:{
                                 field:"email",
                                 value:function(){return $("#email").val()}
                                }
                            },
                },
               group:"required",

              },
              messages:{
                fname:"Please Enter First Name..!!",
                lname:"Please Enter Last Name..!!",
                username:"Please Enter Username..!!",
                pass:"Please Enter Password..!!",
                email:{
                  "required":"Please Enter an Email Address..!!",
                  "email":"Please Enter a Valid Email Address..!!",
                  "remote":"Email Address is already taken..!!"

                },
                group:"Please Choose a Role Group..!!",
              }
            });
          });
        </script>
        <style>
          .error{
            color: #dd0000;
          }
        </style>
