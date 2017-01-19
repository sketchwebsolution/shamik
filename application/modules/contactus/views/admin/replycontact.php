
        <section class="content-header">
          <h1>
            Contact Us Reply
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
                  <form role="form" action="<?php echo $this->config->item('base_url');?>admin/updatecontact" method="post" id="reply_contact" name="reply_contact">
                    <!-- text input -->
                    <div class="form-group">
                      <label>Meesage</label>
                      <textarea readonly class="form-control" name="query" placeholder="Query..."><?php if(!empty($contact->query)) { echo html_entity_decode($contact->query,ENT_QUOTES,'utf-8'); } ?></textarea>
                    </div>

                    <div class="form-group">
                      <label>Reply</label>
                      <textarea class="form-control" name="reply" placeholder="Enter Reply to the query above"></textarea>
                    </div>
                    
                    <div class="form-group">
                      <input class="btn btn-primary" type="submit" value="Reply"/>
                    </div>
                    <input type="hidden" value="<?php echo !empty($contact->id)?urlencode(base64_encode($contact->id)):'';?>" name="id" />
                    <input type="hidden" value="<?php echo !empty($contact->email)?urlencode(base64_encode($contact->email)):'';?>" name="email" />
                  </form>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!--/.col (right) -->
          </div>   <!-- /.row -->
        </section><!-- /.content -->

        <script>
          $("document").ready(function(){
            $("#reply_contact").validate({
              rules:{
                reply:"required"
              },
              messages:{
                reply:"Please Enter Reply..!!",
              }
            });
          });
        </script>
        <style>
          .error{
            color: #dd0000;
          }
        </style>
    