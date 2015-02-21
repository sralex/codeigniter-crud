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
        <script src="http://malsup.github.io/jquery.form.js"></script>
        <link rel="stylesheet" href="https://datatables.net/release-datatables/extensions/TableTools/css/dataTables.tableTools.css">
        <script src="https://datatables.net/release-datatables/extensions/TableTools/js/dataTables.tableTools.js"></script>
        <style type="text/css">
        body{
          background-color: #F0F0F0  ;
          padding-top:70px;
        }
        .dropdown:hover .dropdown-menu {
    display: block;
 }
        </style>
        <script type="text/javascript" charset="utf-8">
          $(document).on("ready",function() {
            var url = $(location).attr('href').slice(1).split('#');
            var controller_name = url[1];
             llamaModulo(controller_name);
            $(".modulo").on('click',function(){
            llamaModulo($(this).attr("href").slice(1));
            });

            $(document).on("click",'.get_action',function(){
              console.log($(this).parent().html() );
                var action = $(this).data('action');
                var id = $(this).attr('data-id');
                var url = $(location).attr('href').slice(1).split('#');
                var controller_name = url[1];
                var target_result = $(this).data('result');
                var update = $(this).data('update');
                $.ajax({
                  url:"<?=base_url()?>index.php/"+controller_name+"/"+action+"/"+id,success:function(result){
                  console.log(result+"en->");
                  console.log(target_result);
                  $(target_result).empty();
                  $(target_result).html(result);
                  llamaModulo(update);
                }});
            });
            $(document).on("click",'.delete_action',function(){
               
                var url = $(location).attr('href').slice(1).split('#');
                var controller_name = url[1];
                $('#btn_delete').attr('data-id',$(this).attr('data-id')).attr('data-update',controller_name);
                console.log($('#btn_delete').parent().html());
            });
            $(document).on("click",'.refresh',function(){
                    var url = $(location).attr('href').slice(1).split('#');
                    var controller_name = url[1];
                    llamaModulo(controller_name);
            });
             $(document).on("submit",'#module_form',function(){
              var url = $(location).attr('href').slice(1).split('#');
              var controller_name = url[1];
              var frm = $(this);
              console.log("module_form"+frm);
                $.ajax({
                  url:frm.attr('action'),
                  data:frm.serialize(),
                  type: frm.attr('method'),
                  success:function(result){
                      var url = $(location).attr('href').slice(1).split('#');
                      var controller_name = url[1];
                      $('#module_modal').modal('hide');
                      llamaModulo(controller_name);
                  }});
                return false;
              });
             $(window).on('hashchange', function(e){
               var url = $(location).attr('href').slice(1).split('#');
               var controller_name = url[1];
               llamaModulo(controller_name);
              });
          });
          //menu
          function llamaModulo(modulo){
             $.ajax({
              url:"<?=base_url()?>index.php/"+modulo+"/",success:function(result){
                $("#contenido_modulos").html(result);
                  $('#example').dataTable({
                   //"paging": false,
                  "scrollX":true,
                  "language": {
                  "zeroRecords": "No se encontró ninguna coincidencia",
                  "search": "Buscar:",
                  "info": "Mostrando pagina _PAGE_ de _PAGES_ de _TOTAL_ registros",
                  "infoFiltered": " - filtrado de _MAX_ registros"
                    }
                  });
              }});
          }
        </script>
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
                  <a href="<?=base_url()?>auth">Usuarios</a>
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
          <ul class="nav navbar-nav">
            <li class="dropdown">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown">Modulos<strong class="caret"></strong></a>
              <ul class="dropdown-menu">
                  <?$res = $this->controllerlist->getControllers();?>
                    <?if($res != null):?>
                    <?foreach($res as $row => $value):?>
                    <li>
                      <a class="modulo" id="<?=$row?>_module" href="#<?=$row?>"><?=$row?></a>
                    </li>
                    <?endforeach;?>
                    <?endif;?>
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
    <div class="col-md-12 column" id="contenido_modulos" >