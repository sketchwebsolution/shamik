
        <section class="content-header">
          <h1>
            Contact Us Archieve
            <small>Control Panel</small>
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12 col-xs-12">
              <div class="box">
                <div class="box-header">
                  <!--<h3 class="box-title">User List</h3>-->
                  <form role="form" action="<?php echo site_url('contactus/admin/bulk_functionality');?>" method="post" name="func" id="func">
                    <select name="opt" id="opt" class="form-control" style="float:left;width:15%;" onchange="choose()">
                      <option value="">Select Action</option>
                      <option value="del">Delete</option>
                      <option value="res">Restore</option>
                    </select>
                    <input type="hidden" name="chk" id="chk" value="">
                  </form>
                  <input type="button" class="btn btn-primary pull-right" value="Back" onclick="window.location.href='<?php echo site_url('admin/contact-us');?>'" />
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th><input type="checkbox" name="ch" id="ch" value=""></th>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>

                        <th>Date</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      if(!empty($list))
                      {
                        $x = 0;
                       foreach($list as $contact)
                       {
                              $cls = "";
                              if($contact->reply_status == 1)
                                  $cls = "active";

                          
                       ?>
                        <tr class="<?= $cls; ?>">
                          <td><input type="checkbox" class="ch1" name="chk1[]" value="<?php echo $contact->id; ?>"></td>
                          <td><?php echo ++$x ; ?></td>
                          <td><?php echo stripslashes($contact->name) ; ?></td>
                          <td><?php echo stripslashes($contact->email);?></td>

                          <td><?php echo date('jS M Y h:i:s A',strtotime($contact->creation_date));?></td>
                          <td><?php if($contact->reply_status == 0){ ?><a href="<?php echo $this->config->item('base_url');?>admin/reply-contact.html/<?php echo urlencode(base64_encode($contact->id));?>"><span><i class="fa fa-reply"></i></span></a> <?php } else { ?> <a href="<?php echo $this->config->item('base_url');?>admin/reply-view.html/<?php echo urlencode(base64_encode($contact->id));?>"><span><i class="fa fa-eye"></i></span></a> <?php } ?>&nbsp;<a href="<?php echo $this->config->item('base_url');?>admin/delete-contact.html/<?php echo urlencode(base64_encode($contact->id));?>"><span><i class="fa fa-times"></i></span></a>&nbsp;<a href="<?php echo $this->config->item('base_url');?>contactus/admin/updateres/<?php echo urlencode(base64_encode($contact->id));?>"><span><i class="fa fa-fast-backward"></i></span></a></td>
                        </tr>
                        <?php
                       }
                      }
                      ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th></th>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>

                        <th>Date</th>
                        <th>Action</th>
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->

<script type="text/javascript">
  
  function choose()
  {
    var info=[];
    if($("#opt").val()=="del")
    {
      $( ".ch1:checked" ).each(function(i,ele){
          info.push($(this).val());
      });
      $("#chk").val(info.join(","));
    }
    if($("#opt").val()=="res")
    {
      $( ".ch1:checked" ).each(function(i,ele){
          info.push($(this).val());
      });
      $("#chk").val(info.join(","));
    }
    if($.trim($("#chk").val()))
    {
      $("#func").submit();
    }
    else
    {
      alert("You Need To Check Something");
    }
  }

  $(".ch1").change(function(){
      if($( ".ch1").not(':checked').length==0)
      {
        $("#ch").prop("checked",true);
      }
      else
      {
        $("#ch").prop("checked",false);
      }
  });

  $("#ch").change(function(){
     var ele = $("#example1").find('tbody').find('input[type="checkbox"]');
     if($(this).is(':checked'))
     {
        ele.prop("checked",true);
     }
     else
     {
        ele.prop("checked",false);
     }
  });
  
  
</script>     