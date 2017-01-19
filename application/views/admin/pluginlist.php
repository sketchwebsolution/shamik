
        <section class="content-header">
          <h1>
            Plugins List
            <small>Control Panel</small>
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Add New Plugin</h3>
                  <form id="uplform" action="<?php echo base_url('admin/pluginupload');?>" method="post" enctype="multipart/form-data">
                    <input type="file" name="pluginfile" id="zipfile" style="display:none;" onchange="checkfileupload()"/>
                    <input type="button" value="Upload Zip" class="btn btn-primary" id="upl" onclick="$('#zipfile').click();" />&nbsp;<span id="plugpath"></span>
                  </form>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Version</th>
                        <th>Author</th>
                        <th>Installed Date</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      if(!empty($plugindet))
                      {
                       foreach($plugindet as $pluginlist)
                       {
                       ?>
                        <tr>
                          <td style="width:15%;"><?php echo $pluginlist->name;?></td>
                          <td style="width:40%;"><?php echo $pluginlist->description;?></td>
                          <td style="width:5%;"><?php echo $pluginlist->version;?></td>
                          <td style="width:10%;"><?php echo $pluginlist->author;?></td>
                          <td style="width:15%;"><?php echo date('jS M, Y',strtotime($pluginlist->created_date));?></td>
                          <td style="width:15%;position:relative;">
                            <?php
                            $findval=array(1,2,3);
                            if(in_array($pluginlist->id, $findval))
                            {
                            ?>
                            <div class="disablediv"></div>
                            <?php
                            }
                            ?>
                            <p class="inst-btn"><span style="color: #0B9904;">Installed</span> | <a style="color: #0074A2;cursor:pointer;" <?php if(!in_array($pluginlist->id, $findval)) { ?> onclick="deleteplugin('<?php echo $pluginlist->id;?>','<?php echo $pluginlist->status;?>')" <?php } ?>>Uninstall</a></p>
                              <div class="onoffswitch">
                                  <input type="checkbox" <?php if(in_array($pluginlist->id, $findval)) { ?> disabled <?php } ?> name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch<?php echo $pluginlist->id;?>" <?php if($pluginlist->status==1) { ?> checked <?php } ?> onclick="checkstatus('<?php echo $pluginlist->id;?>','<?php echo $pluginlist->status;?>')">
                                  <label class="onoffswitch-label" for="myonoffswitch<?php echo $pluginlist->id;?>">
                                      <span class="onoffswitch-inner"></span>
                                      <span class="onoffswitch-switch"></span>
                                  </label>
                              </div>
                        </td>

                        </tr>
                        <?php
                       }
                      }
                      ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Version</th>
                        <th>Author</th>
                        <th>Installed Date</th>
                        <th>Status</th>
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
     

<style>
.onoffswitch {
    position: relative; width: 90px;
    -webkit-user-select:none; -moz-user-select:none; -ms-user-select: none;
}
.onoffswitch-checkbox {
    display: none;
}
.onoffswitch-label {
    display: block; overflow: hidden; cursor: pointer;
    border: 3px solid #ccc; border-radius: 12px;
}
.onoffswitch-inner {
    display: block; width: 200%; margin-left: -100%;
    -moz-transition: margin 0.3s ease-in 0s; -webkit-transition: margin 0.3s ease-in 0s;
    -o-transition: margin 0.3s ease-in 0s; transition: margin 0.3s ease-in 0s;
}
.onoffswitch-inner:before, .onoffswitch-inner:after {
    display: block; float: left; width: 50%; height: 20px; padding: 0; line-height: 20px;
    font-size: 14px; color: white; font-family: Trebuchet, Arial, sans-serif; font-weight: bold;
    -moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-sizing: border-box;
}
.onoffswitch-inner:before {
    content: "ON";
    padding-left: 10px;
    background-color: #0b9904; color: #FFFFFF;
}
.onoffswitch-inner:after {
    content: "OFF";
    padding-right: 10px;
    background-color: #d40505; color: #999999;
    text-align: right;
}
.onoffswitch-switch {
    display: block; width: 25px; margin: 6px;
    border-radius:8px;
    -moz-box-shadow: 1px 1px 4px #000;
    -o-box-shadow: 1px 1px 4px #000;
    -webkit-box-shadow: 1px 1px 4px #000;
    box-shadow: 1px 1px 4px #000;
    background: rgb(255,255,255); /* Old browsers */
background: -moz-linear-gradient(top, rgba(255,255,255,1) 0%, rgba(241,241,241,1) 33%, rgba(225,225,225,1) 66%, rgba(246,246,246,1) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(255,255,255,1)), color-stop(33%,rgba(241,241,241,1)), color-stop(66%,rgba(225,225,225,1)), color-stop(100%,rgba(246,246,246,1))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top, rgba(255,255,255,1) 0%,rgba(241,241,241,1) 33%,rgba(225,225,225,1) 66%,rgba(246,246,246,1) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top, rgba(255,255,255,1) 0%,rgba(241,241,241,1) 33%,rgba(225,225,225,1) 66%,rgba(246,246,246,1) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top, rgba(255,255,255,1) 0%,rgba(241,241,241,1) 33%,rgba(225,225,225,1) 66%,rgba(246,246,246,1) 100%); /* IE10+ */
background: linear-gradient(to bottom, rgba(255,255,255,1) 0%,rgba(241,241,241,1) 33%,rgba(225,225,225,1) 66%,rgba(246,246,246,1) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#f6f6f6',GradientType=0 ); /* IE6-9 */
    position: absolute; top: 0; bottom: 0; right: 53px;
    -moz-transition: all 0.3s ease-in 0s; -webkit-transition: all 0.3s ease-in 0s;
    -o-transition: all 0.3s ease-in 0s; transition: all 0.3s ease-in 0s;
    
}
.onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-inner {
    margin-left: 0;
}
.onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-switch {
    right: 0px; 
}

.disablediv
{
  background: rgba(255, 255, 255, 0.3) none repeat scroll 0 0;
  height: 100%;
  left: 0;
  position: absolute;
  top: 0;
  width: 100%;
  z-index: 99;
}
</style>
<script>
function checkfileupload()
{
  var zipfile=$('#zipfile');
  if(zipfile=="")
  {
    alert('Select zip for uploading');
  }
  else
  {
    $('#plugpath').val(zipfile);
    $('#uplform').submit();
  }
}

function deleteplugin(pluginid,status)
{
  if(status==0)
  {
    window.location.href="<?php echo base_url('admin/plugindelete');?>/"+pluginid;
  }
  else
  {
    alert('Please deactivate the plugin before uninstall');
  }
}

function checkstatus(pluginid,status)
{
 window.location.href="<?php echo base_url('admin/pluginstat');?>/"+pluginid+"/"+status; 
}
</script>