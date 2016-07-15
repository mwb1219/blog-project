<?php
header('Content-Type:text/html;charset=utf-8');
include("../start.php");
define("NOT_LOGIN", 1);
include(ADM_PATH.'/start.admin.php');

if($input->get('do') == 'checkuser'){
    $auname = $input->post('username');
    $passwd = md5($input->post('password'));
    var_dump($auname, md5($passwd));
    
    $sql = "select * from adminuser where auname='$auname' and passwd='$passwd' limit 1";
    $row = $db->get($sql);
    if(!$row){
        exit("账号或密码错误，不能登录");
    }else{
        $_SESSION['auid'] = $row['id'];
        header("location:index.php");
    }
}

if($input->get('do') == 'out'){
    $_SESSION['auid'] = 0;
    header("location:".ADM_URL_PATH."/login.php");
}
?>
<!DOCTYPE html>
<html lang="cn-CN">
    <head>
        <meta content="text/html" charset="utf-8">
        <title>管理员登录</title>
        <link rel="stylesheet" href="<?php echo URL_PATH;?>/public/bootstrap/css/bootstrap.min.css">
        <script src="<?php echo URL_PATH;?>/public/jquery.min.js"></script>
        <script src="<?php echo URL_PATH;?>/public/bootstrap/js/bootstrap.min.js"></script>
    </head>

    <body>
        <div class="container">
            <div class="col-md-3"></div>
             <div class="col-md-6" >
                <div class="panel panel-primary" style="margin-top:200px">
                    <div class="panel-heading">管理员登录</div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="post" action="<?php echo ADM_URL_PATH; ?>/login.php?do=checkuser">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">用户</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="username" id="username" placeholder="请输入用户名">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">密码</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" name="password" id="password" placeholder="请输入密码">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-default">登 录</button>
                                </div>
                            </div>
                        </form> 
                    </div>
                    <div class="panel-footer text-right text-muted">版权所有，盗版必究</div>
                </div>   
            </div>
            <div class="col-md-3"></div>
        </div>

    </body>
</html>

