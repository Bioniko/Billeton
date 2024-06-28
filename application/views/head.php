<?php session_start();?>
<?php 
if($_SESSION['Usuario'] == NULL){
  header("Location: ".base_url()."index.php/Inicio");
}
// Establecer la configuración regional a español
setlocale(LC_TIME, 'es_ES.UTF-8');
?>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Billeton</title>
<link rel="icon" href="<?php echo base_url();?>Tema/Static_Full_Version/img/profile_small.png" type="image/png">
<link href="<?php echo base_url();?>Tema/Static_Full_Version/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>Tema/Static_Full_Version/font-awesome/css/font-awesome.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="<?php echo base_url();?>Tema/Static_Full_Version/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>Tema/Static_Full_Version/css/animate.css" rel="stylesheet">
<link href="<?php echo base_url();?>Tema/Static_Full_Version/css/style.css" rel="stylesheet">
<link href="<?php echo base_url();?>Tema/Static_Full_Version/css/plugins/dropzone/basic.css" rel="stylesheet">
<link href="<?php echo base_url();?>Tema/Static_Full_Version/css/plugins/dropzone/dropzone.css" rel="stylesheet">
<link href="<?php echo base_url();?>Tema/Static_Full_Version/css/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>Tema/Static_Full_Version/css/plugins/codemirror/codemirror.css" rel="stylesheet">
<link href="<?php echo base_url();?>Tema/Static_Full_Version/css/style.css" rel="stylesheet">

<!-- ESTO ES PARA TEXTAREAEDITOR -->
<link href="<?php echo base_url();?>Tema/Static_Full_Version/css/plugins/summernote/summernote.css" rel="stylesheet">
<link href="<?php echo base_url();?>Tema/Static_Full_Version/css/plugins/summernote/summernote-bs3.css" rel="stylesheet">

<!-- para textarea -->
<link href="<?php echo base_url();?>Tema/Static_Full_Version/css/plugins/bootstrap-markdown/bootstrap-markdown.min.css" rel="stylesheet">
