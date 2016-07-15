<?php
header("Content-Type:text/html;charset=utf-8");
include("../start.php");
include(ADM_PATH . '/start.admin.php');
include(APP_PATH.'/lib/page.class.php');

switch($input->get('do')){
    case "delete":
        $bid = (int)$input->get('bid');
        if($bid < 1){
            exit('没有正确传递bid参数');
        }
        $db->query("delete from blog where bid='{$auid}'");
        header("location:".ADM_URL_PATH."/blog.php");
        break;
}
$p = $input->get('p');
if($p < 1){
    $p = 1;
}

//每页显示数
$blog_num   = 4; 

$offset = $blog_num * ($p-1);
//总数据量
$blogs_count = $db->get("select count(*) as total from blog")[0];
$page = new page($blogs_count, $blog_num, $p, ADM_URL_PATH.'/blog.php');

//读取adminuser的数据
$sql = "SELECT * FROM blog order by bid desc limit {$offset},{$blog_num}";
$blogs = $db->gets($sql);

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
                <h1>日志管理<small class="pull-right"><a href="<?php echo ADM_URL_PATH;?>/blog.add.php" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> 添加</a></small></h1>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                          <th>bid</th>
                          <th>标题</th>
                          <th>作者</th>
                          <th>时间</th>
                          <th>管理功能</th>
                        </tr>
                    </thead> 
                    <tbody>
                        <?php foreach($blogs as $item) :?>
                        <tr>
                            <td><?php echo $item['bid'];?></td>
                            <td><?php echo $item['title'];?></td>
                            <td><?php echo $item['author'];?></td>
                            <td><?php echo date("Y-m-d H:i:s",$item['intime']);?></td>
                            <td>
                                <a href="<?php echo ADM_URL_PATH;?>/blog.add.php?bid=<?php echo $item['bid']?>" class="btn btn-primary btn-xs">编辑</a>
                                <a href="<?php echo ADM_URL_PATH;?>/blog.php?do=delete&bid=<?php echo $item['bid']?>" class="btn btn-danger btn-xs">删除</a>
                            </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
                <nav class="pull-right">
                    <ul class="pagination">
                        <?php if($p <= 1): ?>
                        <li><a disabled aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
                        <?php else:?>
                        <li><a href="<?php echo ADM_URL_PATH;?>/blog.php?p=<?php echo $p-1?>" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
                        <?php endif?>
                        <?php echo $page->showPage();?>
                        
                        <?php if($p >= $page->maxPage): ?>
                        <li><a disabled aria-label="Next"><span aria-hidden="true">»</span></a></li>
                        <?php else:?>
                        <li><a href="<?php echo ADM_URL_PATH;?>/blog.php?p=<?php echo $p+1?>" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
                         <?php endif?>
                    </ul>
                </nav>
            </div>
        </div>

    </body>

</html>