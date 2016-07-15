<?php
header("Content-Type:text/html;charset=utf-8");
include("../start.php");
include(ADM_PATH . '/start.admin.php');

switch($input->get('do')){
    case "delete":
        $auid = (int)$input->get('auid');
        if($auid < 1){
            exit('没有正确传递auid参数');
        }
        if($user['auid'] == $auid){
            exit('禁止删除自己！');
        }
        $db->query("delete from adminuser where id='{$auid}'");
        header("location:".ADM_URL_PATH."/admin.php");
        break;
}

//读取adminuser的数据
$users = $db->gets("SELECT * FROM adminuser");

?>

<!DOCTYPE html>
<html lang="cn-CN">
    <head>
        <?php include(ADM_PATH . "/inc/header.inc.php"); ?>
    </head>

    <body>
        <?php include(ADM_PATH . "/inc/nav.inc.php"); ?>
        <div class="container">
            <div class="page-header">
                <h1>管理员管理<small class="pull-right"><a href="<?php echo ADM_URL_PATH;?>/admin.add.php" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> 添加</a></small></h1>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                          <th>auid</th>
                          <th>auname</th>
                          <th>管理功能</th>
                        </tr>
                    </thead> 
                    <tbody>
                        <?php foreach($users as $item) :?>
                        <tr>
                            <td><?php echo $item['id'];?></td>
                            <td><?php echo $item['auname'];?></td>
                            <td>
                                <a href="<?php echo ADM_URL_PATH;?>/admin.add.php?auid=<?php echo $item['id']?>" class="btn btn-primary btn-xs">编辑</a>
                                <?php if($user['id'] != $item['id']): ?>
                                    <a href="<?php echo ADM_URL_PATH;?>/admin.php?do=delete&auid=<?php echo $item['id']?>" class="btn btn-danger btn-xs">删除</a>
                                <?php endif?>
                            </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-12">

            </div>
        </div>

    </body>

</html>