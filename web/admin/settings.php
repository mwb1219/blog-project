<?php
header("Content-Type:text/html;charset=utf-8");
include("../start.php");
include(ADM_PATH . '/start.admin.php');
$config = $db->gets("select * from settings order by sid asc ");

if($input->get('do') == 'save'){
    $v = $input->post('v',false);
    foreach ($v as $key => $value){
        $sql = "update settings set v='{$value}' where k='{$key}'";
        $db->query($sql);
    }
}



?>

<!DOCTYPE html>
<html lang="cn-CN">
    <head>
        <?php include(ADM_PATH . "/inc/header.inc.php"); ?>
        <link rel="stylesheet" type="text/css" href="<?php echo URL_PATH?>/public/simditor/styles/simditor.css" />
        <script type="text/javascript" src="<?php echo URL_PATH?>/public/simditor/scripts/module.js"></script>
        <script type="text/javascript" src="<?php echo URL_PATH?>/public/simditor/scripts/hotkeys.js"></script>
        <script type="text/javascript" src="<?php echo URL_PATH?>/public/simditor/scripts/uploader.js"></script>
        <script type="text/javascript" src="<?php echo URL_PATH?>/public/simditor/scripts/simditor.js"></script>
    </head>

    <body>
        <?php include(ADM_PATH . "/inc/nav.inc.php"); ?>
        <div class="container">
            <div class="page-header">
                <h1>基本设置
                    <small class="pull-right">
                        设置网站的功能开关
                    </small>
                </h1>
            </div>
            <div class="col-md-12" >
               
                    <div class="panel-body">
                        <form class="form-horizontal" method="post" action="<?php echo ADM_URL_PATH; ?>/settings.php?do=save">
                            <?php foreach($config as $item) :?>
                                <div class="form-group">
                                    <label for="title" class="col-sm-2 control-label"><?php echo $item['kname']?></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="v[<?php echo $item['k'];?>]" value="<?php echo $item['v'];?>" id="title" placeholder="请输入配置">
                                        <p style="margin-top:5px;" class="text-muted" >
                                            <span class="glyphicon glyphicon-question-sign"></span>
                                            <?php echo $item['intro'];?>(<?php echo $item['k'];?>)
                                        </p>
                                    </div>
                                </div>
                            <?php endforeach;?>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-default">保 存</button>
                                </div>
                            </div>
                        </form> 
                    </div>
                 

            </div>

    </body>

</html>

