
        <section class="content-header">
          <h1>
            Banner Archieve
            <small>Control Panel</small>
          </h1>
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <!--<h3 class="box-title">banner Pages List</h3>-->
                  <form role="form" action="<?php echo site_url('banner/admin/bulk_functionality');?>" method="post" name="func" id="func">
                    <select name="opt" id="opt" class="form-control" style="float:left;width:15%;" onchange="choose()">
                      <option value="">Select Action</option>
                      <option value="del">Delete</option>
                      <option value="res">Restore</option>
                      <option value="stat">Change Status</option>
                    </select>
                    <input type="hidden" name="chk" id="chk" value="">

                   </form>
                  <input type="button" class="btn btn-primary pull-right" value="Back" onclick="window.location.href='<?php echo site_url('admin/banner');?>'" />
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th><input type="checkbox" name="ch" id="ch" value=""></th>
                        <th>#</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      if(!empty($list))
                      {
                        $x = 0;
                       foreach($list as $bannerlist)
                       {
                       ?>
                        <tr>
                          <td><input type="checkbox" class="ch1" name="chk1[]" value="<?php echo $bannerlist->id; ?>"></td>
                          <td><?php echo ++$x ; ?></td>
                          <td><img src="<?php echo base_url('assets/banner/uploads/thumb/'.$bannerlist->image);?>" /></td>
                          <td>
                            <?php
                            if($bannerlist->status==1)
                            {
                            ?>
                            <a href="javascript:void(0);" onclick="window.location.href='<?php echo base_url('banner/admin/statusbanner/'.urlencode(base64_encode($bannerlist->id)));?>'"><span style="color: #00bc00;"><i class="fa fa-unlock"></i></span></a>
                            <?php
                            }
                            if($bannerlist->status==0)
                            {
                            ?>
                            <a href="javascript:void(0);" onclick="window.location.href='<?php echo base_url('banner/admin/statusbanner/'.urlencode(base64_encode($bannerlist->id)));?>'"><span style="color: #c90000;"><i class="fa fa-lock"></i></span></a>
                            <?php
                            }
                            ?>
                          </td>
                          <td>
                            <a href="<?php echo site_url('admin/edit-banner');?>/<?php echo urlencode(base64_encode($bannerlist->id));?>"><span><i class="fa fa-pencil"></i></span></a>&nbsp;
                            <a href="javascript:void(0);" onclick="window.location.href='<?php echo base_url('banner/admin/deletebanner/'.urlencode(base64_encode($bannerlist->id)));?>'"><span><i class="fa fa-times"></i></span></a>&nbsp;<a href="<?php echo $this->config->item('base_url');?>banner/admin/updateres/<?php echo urlencode(base64_encode($bannerlist->id));?>"><span><i class="fa fa-fast-backward"></i></span></a>


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
                        <th>Image</th>
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
    }
    if($("#opt").val()=="res")
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