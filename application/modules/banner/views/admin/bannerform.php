
<section class="content-header">
    <h1>
        Banner
        <small>Control panel</small>
    </h1>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <!-- right column -->
        <div class="col-md-12">
            <!-- general form elements disabled -->
            <div class="box box-warning">
                <div class="box-body">


                    <form role="form" action="<?php echo base_url('banner/admin/bannermodify');?>" method="post" id="cms_form" enctype="multipart/form-data">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" class="form-control" name="image" />
                            <?php echo form_error('image', '<div class="error">', '</div>'); ?>
                            <?php
                            if(!empty($bannerdetsingle->image))
                            {
                                ?>
                                <br /><img src="<?php echo base_url('assets/banner/uploads/thumb/'.$bannerdetsingle->image);?>" />
                                <?php
                            }
                            ?>
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control ckeditor" name="description" placeholder="Enter Description"><?php if(!empty($bannerdetsingle)) { echo $bannerdetsingle->description; } ?></textarea>
                                <?php echo form_error('description', '<div class="error">', '</div>'); ?>
                        </div>

                        <div class="form-group">
                            <input type="hidden" name="bannerid" <?php if(!empty($bannerdetsingle)) { ?> value="<?php echo $bannerdetsingle->id;?>" <?php } ?> />
                            
                            <input class="btn btn-primary" type="submit" value="Update"/>
                        </div>
                    </form>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!--/.col (right) -->
    </div>   <!-- /.row -->
</section><!-- /.content -->


        <script>
          $("document").ready(function(){
            $("#cms_form").validate({
              ignore: [],
              rules:{
                <?php if(empty($bannerdetsingle)) 
                { ?>
                    image:"required",
                <?php
                }
                ?>
                description:"required"
              },
              messages:{
                image:"Please Enter Image..!!",
                content:"Please Enter Description..!!"
              }
            });
          });
        </script>
        <style>
          .error{
            color: #dd0000;
          }
        </style>



