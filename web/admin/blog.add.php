<?php
header("Content-Type:text/html;charset=utf-8");
include("../start.php");
include(ADM_PATH . '/start.admin.php');

$bid = (int)$input->get('bid');

$item = array(
    'bid'       => 0,
    'title'     => '',
    'author'    => $user['auname'],
    'content'   => '',
    
);

if($bid > 0){
    $item = $db->get("select * from blog where bid='{$bid}'");
    if(!$item){
        exit("没有找到这个用户！");
    }
}

if($input->get('do') == 'save'){
    $bid        = (int)trim($input->post('bid'));
    $title      = trim($input->post('title'));
    $author     = trim($input->post('author'));
    $content    = htmlentities(trim($input->post('content',false)));
    $nowTime     = time();
    
    if(empty($title) || empty($author) || empty($content)){
        exit('请填写完整表单！');
    }
    
    if($bid > 0){
        $sqlStr = "update blog set title='%s',author='%s',content='%s', uptime=%d where bid='%d'";
        $sql = sprintf($sqlStr, $title, $author, $content, $nowTime, $bid);
    }else{
        $sqlStr = "insert into blog (`title`, `author`, `content`, `intime`,`uptime`) values('%s', '%s', '%s', %d, '%d')";
        $sql = sprintf($sqlStr, $title, $author, $content, $nowTime, $nowTime);
    }
    
    $db->query($sql);
    header("location:".ADM_URL_PATH."/blog.php");
    exit;
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
                <h1>日志管理
                    <small class="pull-right">
                        <a href="<?php echo ADM_URL_PATH; ?>/blog.php" class="btn btn-primary"><span class="glyphicon glyphicon-chevron-left"></span> 返回</a>
                    </small>
                </h1>
            </div>
            <div class="col-md-12" >
               
                    <div class="panel-body">
                        <form class="form-horizontal" method="post" action="<?php echo ADM_URL_PATH; ?>/blog.add.php?do=save">
                            <div class="form-group">
                                <input type="hidden" name="bid" value="<?php echo $item['bid'];?>" />
                                <label for="title" class="col-sm-2 control-label">标题</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="title" value="<?php echo $item['title']?>" id="title" placeholder="请输入标题">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="author" class="col-sm-2 control-label">作者</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="author" value="<?php echo $item['author']?>" id="author" placeholder="请输入作者">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="content" class="col-sm-2 control-label">正文</label>
                                <div class="col-sm-10">
                                    <textarea name="content" id="content"><?php echo $item['content']?></textarea>
                                    <script>
                                        var editor = new Simditor({
                                            textarea: $('#content'),
                                            upload: {
                                                url:'<?php echo ADM_URL_PATH ."/upload.php";?>',
                                                fileKey:'file1'
                                            },
                                            placeholder:"请输入内容",
                                            toolbar:[
                                                'title',
                                                'bold',
                                                'italic',
                                                'underline',
                                                'strikethrough',
                                                'fontScale',
                                                'color',
                                                'ol'    ,       
                                                'ul'     ,        
                                                'blockquote',
                                                'code'       ,   
                                                'table',
                                                'link',
                                                'image',
                                                'hr'    ,       
                                                'indent',
                                                'outdent',
                                                'alignment'
                                            ]
                                            
                                        });
                                    </script>
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

