<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
        <title><?=$this->config->item('title'); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link href="<?=base_url();?>/assets/css/bootstrap.css" rel="stylesheet">
        <script src="<?=base_url();?>/assets/js/jquery.js"></script>
        <script src="<?=base_url();?>/assets/js/moment.js"></script>
        <script src="<?=base_url();?>/assets/js/bootstrap.js"></script>
        <script src="<?=base_url();?>/assets/js/bootstrap-datetimepicker.min.js"></script>
        <link href="<?=base_url();?>/assets/css/bootstrap-datetimepicker.css" rel="stylesheet">
        <script src="<?=base_url()?>assets/js/Chart.js"></script>
        <link href="//cdn.datatables.net/plug-ins/3cfcc339e89/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet"/>
        <script type="text/javascript" language="javascript" src="//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
        <script src="//cdn.datatables.net/plug-ins/3cfcc339e89/integration/bootstrap/3/dataTables.bootstrap.js"></script>
        <script type="text/javascript" charset="utf-8">
          $(document).ready(function() {
            $('#example').dataTable({
              "paging": false,
              "info":false,
              "scrollX":true,
              "language": {
                "search": "Buscar:"
              },
               "language": {
                "zeroRecords": "No se encontró ninguna coincidencia"
              }
            });
          } );
        </script>
<style>
    body{padding-top:70px;}
</style>
</head>
<body>
<div class="container-fluid">
  <div class="row clearfix">
    <div class="col-md-12 column">
      <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="navbar-header">
           <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Sistema</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button> <a class="navbar-brand" href="#"><?=$this->config->item('name'); ?></a>
        </div>
        
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li class="dropdown">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown">Sistema<strong class="caret"></strong></a>
              <ul class="dropdown-menu">
                <li>
                  <a href="<?=base_url()?>codegen">Codegen</a>
                </li>
                 <li>
                  <a href="<?=base_url()?>config">Configuración</a>
                </li>
                <li>
                  <a href="<?=base_url()?>querys">Querys</a>
                </li>
              </ul>
            </li>
          </ul>
          
          <ul class="nav navbar-nav navbar-right">
           
            <li class="dropdown">
              <ul class="dropdown-menu">
                <li>
                  <a href="<?=base_url()?>/auth">Mi perfil</a>
                </li>
                <li>
                  <a href="<?=base_url()?>/auth/logout">Salir</a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
        
      </nav>
    </div>
  </div>

  <div class="row clearfix">
    <div class="col-md-2 column" style="padding:0; margin:0;">
    <ul class="nav nav-tabs nav-stacked">
        <?$res = $this->controllerlist->getControllers();?>
            <?if($res != null):?>
            <?foreach($res as $row => $value):?>
            
              <li>
              <a href="<?=base_url()?><?=$row?>"><?=$row?></a>
            </li>
            <?endforeach;?>
            <?endif;?>
      </ul>
            
    </div>
    <div class="col-md-10 column">