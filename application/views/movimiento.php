<!DOCTYPE html>
<html>
<head>
<?php include "head.php"; ?>
<?php 
foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
</head>
<body>
    <div id="wrapper">
        <?php include "menu.php";?>
        <div id="page-wrapper" class="gray-bg">
            <?php include "top.php"; ?>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h1>Movimiento</h>
                        </div>
                        <div class="ibox-title">
                            <div style='height:20px;'></div>  
                            <div style="padding: 10px">
                                <?php echo $output; ?>
                            </div>
                            <?php foreach($js_files as $file): ?>
                                <script src="<?php echo $file; ?>"></script>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "footer.php"; ?>                               
</body>
</html>
