<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>   <?php echo $title;?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="<?php echo $this->config->item('base_url');?>assets/admin/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo $this->config->item('base_url');?>assets/admin/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="<?php echo $this->config->item('base_url');?>assets/admin/plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />
    <!-- FONT AWESOME -->
    <link href="<?php echo $this->config->item('base_url');?>assets/font-awesome/font-awesome.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $this->config->item('base_url');?>assets/font-awesome/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Developer CSS -->
    <link href="<?php echo $this->config->item('base_url');?>assets/developer.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="login-page">


   <?php echo $content;?>
   <div style="display:block;text-align:center;">
    <?php
    if (file_exists(APPPATH."modules/language/views/language.php"))
    {
      echo langview();
    }
    ?>
    </div>

    <!-- jQuery 2.1.3 -->
    <script src="<?php echo $this->config->item('base_url');?>assets/admin/plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo $this->config->item('base_url');?>assets/admin/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="<?php echo $this->config->item('base_url');?>assets/admin/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
      
      $(document).ready(function(){
        $('.closebutn').click(function(){
          $('.overlay').fadeOut();
          $('.successmessage').fadeOut();
          $('.errormessage').fadeOut();
        });
      });
      
      $(document).ready(function(){
        $('.overlay').delay(1000).fadeOut();
        $('.successmessage').delay(1000).fadeOut();
        $('.errormessage').delay(1000).fadeOut();
      });
    </script>
    <?php
    if (file_exists(APPPATH."modules/language/views/script.php"))
    {
      echo scriptview();
    }
    ?>
  </body>
</html>