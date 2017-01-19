
        <section class="content-header">
          <h1>
            FAQs List
            <small>Control Panel</small>
          </h1>
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header">
                <input type="button" style="margin-bottom:5px;" class="btn btn-primary" value="Add Faqs" onclick="window.location.href='<?php echo site_url('admin/add-faqs');?>'" />
                  <form role="form" action="<?php echo site_url('faqs/admin/bulk_functionality');?>" method="post" name="func" id="func">
                    <select name="opt" id="opt" class="form-control" style="float:left;width:15%;margin-top:5px;" onchange="choose()">
                      <option value="">Select Action</option>
                      <option value="del">Delete</option>
                      <option value="arch">Archieve</option>
                      <option value="stat">Change Status</option>
                    </select>
                    <input type="hidden" name="chk" id="chk" value="">
                  </form>
                  <input type="button" class="btn btn-primary pull-right" value="Archive" onclick="window.location.href='<?php echo site_url('admin/faqs-archieve');?>'" />
                  
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th><input type="checkbox" name="ch" id="ch" value=""></th>
                        <th>#</th>
                        <th>Question</th>
                        <th>Answer</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      if(!empty($result))
                      {
                        $x = 0;
                       foreach($result as $row)
                       {
                         $string = word_limiter($row->faq_ans, 15);
                       ?>
                        <tr>
                          <td><input type="checkbox" class="ch1" name="chk1[]" value="<?php echo $row->id; ?>"></td>
                          <td><?php echo ++$x ; ?></td>
                          <td><?php echo $row->faq_qs;?></td>
                          <td><?php echo $string;?></td>
                          <td>
                            <?php
                            if($row->status==1)
                            {
                            ?>
                            <a href="javascript:void(0);" onclick="window.location.href='<?php echo base_url('faqs/admin/statusfaq/'.urlencode(base64_encode($row->id)));?>'"><span style="color: #00bc00;"><i class="fa fa-unlock"></i></span></a>
                            <?php
                            }
                            if($row->status==0)
                            {
                            ?>
                            <a href="javascript:void(0);" onclick="window.location.href='<?php echo base_url('faqs/admin/statusfaq/'.urlencode(base64_encode($row->id)));?>'"><span style="color: #c90000;"><i class="fa fa-lock"></i></span></a>
                            <?php
                            }
                            ?>
                          </td>
                          <td>
                            <a href="<?php echo site_url('admin/edit-faqs');?>/<?php echo urlencode(base64_encode($row->id));?>"><span><i class="fa fa-pencil"></i></span></a>&nbsp;
                            <a href="javascript:void(0);" onclick="window.location.href='<?php echo base_url('faqs/admin/deleteData/'.urlencode(base64_encode($row->id)));?>'"><span><i class="fa fa-times"></i></span></a>&nbsp;<a href="<?php echo $this->config->item('base_url');?>faqs/admin/updatearch/<?php echo urlencode(base64_encode($row->id));?>"><span><i class="fa fa-archive"></i></span></a>


                          </td>
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
                        <th>Question</th>
                        <th>Answer</th>
                        <th>Status</th>
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
      // alert(info);
    }
    if($("#opt").val()=="arch")
    {
      $( ".ch1:checked" ).each(function(i,ele){
          info.push($(this).val());
      });
      $("#chk").val(info.join(","));
    }
    if($("#opt").val()=="stat")
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