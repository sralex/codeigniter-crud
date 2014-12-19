<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
        <title>Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link href="<?=base_url();?>/assets/css/bootstrap.css" rel="stylesheet">
        <style type="text/css">
            .modal-footer {   border-top: 0px; }
            .modal-dialog { width: 400px;}

        </style>
    </head>
    <body>
<div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h1><?php echo lang('login_heading');?></h1>
          <p><?php echo lang('login_subheading');?></p>
          <div id="infoMessage"><?php echo $message;?></div>
      </div>
      <div class="modal-body">
          <?$class['class']='form col-md-12 center-block';?>
          <?=form_open("auth/login",$class);?>
            <div class="form-group">
              <?php echo lang('login_identity_label', 'identity');
              $identity['class']="form-control";?>
              <?php echo form_input($identity);?>
            </div>
            <div class="form-group">
              <?php echo lang('login_password_label', 'password');
               $password['class']="form-control";?>
              <?php echo form_input($password);?>
            </div>
            <?php echo lang('login_remember_label', 'remember');?>
            <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
            <div class="form-group">
            <input type="submit" class="btn btn-primary pull-right" value="Entrar"/>
            </div>
          </form>
      </div>
      <div class="modal-footer">
      </div>
  </div>
  </div>
</div>
<script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type='text/javascript' src="./assets/js/bootstrap.min.js"></script>
        <script type='text/javascript'>        
        $(document).ready(function() {
        });
        </script>
    </body>
</html>