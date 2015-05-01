<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
        <title>Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link href="<?=base_url();?>/assets/css/bootstrap.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">    
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Sign In</div>
                        <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#">Forgot password?</a></div>
                    </div>     

                    <div style="padding-top:30px" class="panel-body" >
                          
                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                          <h1><?php echo lang('login_heading');?></h1>
                          <p><?php echo lang('login_subheading');?></p>
                          <div id="infoMessage"><?php echo $message;?></div>
                        </div>
                            
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
                          <div class="form-group">
                                    <div class="col-md-12 control">
                                        <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                            Don't have an account! 
                                        <a href="#" onClick="$('#loginbox').hide(); $('#signupbox').show()">
                                            Sign Up Here
                                        </a>
                                        </div>
                                    </div>
                                </div>  
                        </form>
                        </div>                     
                    </div>  
        </div>
        <div id="signupbox" style="display:none; margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="panel-title">Sign Up</div>
                            <div style="float:right; font-size: 85%; position: relative; top:-10px"><a id="signinlink" href="#" onclick="$('#signupbox').hide(); $('#loginbox').show()">Sign In</a></div>
                        </div>  
                        <div class="panel-body" >
                        <?php echo form_open("auth/create_user");?>
      <div class="col-md-12">
      <?=lang('create_user_heading');?>
      <h5><?=lang('create_user_subheading');?></h5>
      <div id="infoMessage">
      <?if($message!=""):?>
      <div class="alert alert-warning alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong>Warning!</strong>
        <?=$message;?>
      </div>
      <?endif;?>
      </div></div>
      <div class="form-group">
            <div class="col-md-2">
            <?=lang('create_user_fname_label', 'first_name');
            $first_name['class'] ='form-control'; 
            ?>
            </div>
            <div class="col-md-9">
            <?=form_input($first_name);?>
            </div>
      </div>
      <div class="form-group">
            <div class="col-md-2">
            <?=lang('create_user_lname_label', 'last_name');
            $last_name['class'] ='form-control'; 
            ?>
             </div>
            <div class="col-md-9">
            <?=form_input($last_name);?>
            </div>
      </div>
      <div class="form-group">
            <div class="col-md-2">
            <?=lang('create_user_email_label', 'email');
            $email['class'] ='form-control'; ?>
             </div>
            <div class="col-md-9">
            <?=form_input($email);?>
            </div>
      </div>
      
      <div class="form-group">
            <div class="col-md-2">
            <?=lang('create_user_password_label', 'password');
            $password['class'] ='form-control'; ?>
             </div>
            <div class="col-md-9">
            <?=form_input($password);?>
            </div>
      </div>
      <div class="form-group">
            <div class="col-md-2">
            <?=lang('create_user_password_confirm_label', 'password_confirm');
            $password_confirm['class'] ='form-control'; 
            $password_confirm['type']='password';?>
             </div>
            <div class="col-md-9">
            <?=form_input($password_confirm);?>
            </div>
      </div>  
        <div class="col-md-offset-3 col-md-9">
            <button id="btn-signup" type="submit" class="btn btn-info"><i class="icon-hand-right"></i> &nbsp Sign Up</button>
            
        </div>
      <?=form_close();?>
                                
                            </form>
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

