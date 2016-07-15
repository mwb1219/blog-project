<?php
header("Content-Type:text/html;charset=utf-8");
include("../start.php");
include(ADM_PATH . '/start.admin.php');

$auid = (int) $input->get("auid");
$item = array(
    'id' =>'',
    'auname' => '',
    'passwd' => ''
);
if($auid > 0){
    $item = $db->get("select * from adminuser where id='{$auid}'");
    if(!$item){
        exit("没有找到这个用户！");
    }
}



//读取adminuser的数据
//$users = $db->gets("SELECT * FROM adminuser");
if($input->get('do') == 'save'){
    $auid = trim($input->post('auid'));
    $auname = trim($input->post('auname'));
    $passwd = trim($input->post('passwd'));
    
    if($auid < 1){
        if(empty($auname) || empty($passwd)){
            exit("用戶名和密码不能为空！");
        }
        $usercheck = $db->get("select * from adminuser where auname = '{$auname}'");
        if(is_array($usercheck)){
            exit("账号已经存在");
        }
    }
    if($auid < 1){
        $passwd = md5($passwd);
        $sql = "insert into adminuser (auname,passwd) values('{$auname}','{$passwd}')";
    }else{
        if(!empty($passwd)){
            $passwd = md5($passwd);
            $sql = "update adminuser set auname = '{$auname}', passwd = '{$passwd}' where id = {$auid}";
        }else{
            $sql = "update adminuser set auname = '{$auname}' where id = {$auid}";
        }
    }
    $db->query($sql);
    header("location:".ADM_URL_PATH."/admin.php");
    exit;
}

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
                <h1>管理员管理
                    <small class="pull-right">
                        <a href="<?php echo ADM_URL_PATH; ?>/admin.php" class="btn btn-primary"><span class="glyphicon glyphicon-chevron-left"></span> 返回</a>
                    </small>
                </h1>
            </div>
            <div class="col-md-offset-3 col-md-6" >
               
                    <div class="panel-body">
                        <form class="form-horizontal" method="post" action="<?php echo ADM_URL_PATH; ?>/admin.add.php?do=save">
                            <div class="form-group">
                                <label for="auname" class="col-sm-2 control-label">用户</label>
                                <input type="hidden" name="auid" value="<?php echo $item['id']?>"/>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="auname" value="<?php echo $item['auname']?>" id="auname" placeholder="请输入用户名">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="passwd" class="col-sm-2 control-label">密码</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" name="passwd" id="passwd" placeholder="请输入密码">
                                </div>
                            </div>
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