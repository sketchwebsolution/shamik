  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<section class="content-header">
    <h1>
        Faq
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

                    <form role="form" action="<?php echo base_url('faqs/admin/faqmodify');?>" method="post" id="faq_form" enctype="multipart/form-data">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Faq Question</label>
                            <input type="text" class="form-control" name="faq_qs" id="faq_qs" placeholder="Enter Faq Question" <?php if(!empty($result)) { ?> value="<?php echo $result->faq_qs;?>" <?php } ?> />
                        </div>


                        <div class="form-group">
                            <label>Faq Answer</label>
                            <textarea class="form-control ckeditor" name="faq_ans" placeholder="Enter Faq Answer"><?php if(!empty($result)) { echo $result->faq_ans; } ?></textarea>
                        </div>

                          

                   

                        <div class="form-group">
                            <input type="hidden" name="faqid" <?php if(!empty($result)) { ?> value="<?php echo $result->id;?>" <?php } ?> />
                            <input class="btn btn-primary" type="submit" value="Submit"/>
                        </div>
                    </form>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!--/.col (right) -->
    </div>   <!-- /.row -->
</section><!-- /.content -->

<?php if(empty($result)) { ?>
        <script>
       var path="<?php echo base_url('faqs/admin/checkUnique');?>";
          $("document").ready(function(){
             $("#faq_form").validate({
              rules:{

                faq_qs: {
			          required : true,
			          remote : {
			            url : path,
			            method: "post",
			            data:{
			              field: "faq_qs",
			              value : function(){ return $("#faq_qs").val(); } 
			            }   
			          }
			        },

                faq_ans:"required",
              },
              messages:{
                faq_qs:{ required :"Please Enter Faq Question!!",remote :" This Question Already Entered"},
                faq_ans:"Please Enter  Faq Answer",
              }
            });
            
          });

   
  
  
  
        </script>

        <?php  } else { ?>


 <script>
          $("document").ready(function(){
             $("#faq_form").validate({
              rules:{

                faq_qs:"required",
                faq_ans:"required",
              },
              messages:{
                faq_ans:"Please Enter  Faq Answer",
                faq_qs:"Please Enter  Faq Question",

              }
            });
            
          });

   
  
  
  
        </script>

        <?php } ?>
        <style>
          .error{
            color: #dd0000;
          }
 #result{
        width: 100%;padding-top: 50px;font-size: 22px;letter-spacing: 1px;line-height: 25px;color: #999    
    }

    
        </style>



