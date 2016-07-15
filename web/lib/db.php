<?php

/*
    数据库操作类
    提供常用的数据库相关操作
    使用方法：
            $db = new db(数据库IP地址,账号,密码,数据库名称);
            $db->query($sql) 负责执行一次SQL查询
            $db->close()  手动关闭数据库连接
 */
class db {
    public $host;
    public $user;
    public $passwd;
    public $dbname;
    
    public $dblink;
    
    //构造方法，用来传入连接数据库的各种参数
    function __construct($host, $user, $passwd, $dbname){
        $this->host = $host;
        $this->user = $user;
        $this->passwd = $passwd;
        $this->dbname = $dbname;
        $this->connect();
        $this->query("set names UTF8");
    }
    
    //连接数据库，并创建一个类属性：$this-dblink
    function connect(){
        $mysqli = new mysqli($this->host, $this->user, $this->passwd, $this->dbname);
        if($mysqli->connect_errno <> 0){
            echo "数据库连接失败，错误信息：".$mysqli->connect_error;
            exit;
        }
        $this->dblink = $mysqli;
    }
    
    //执行一次SQL查询
    function query($sql, $resultmode = MYSQLI_STORE_RESULT){
        return $this->dblink->query($sql);
    }
    
    //如果你认为有必要，可以使用这个方法，手动关闭数据库
    //否则，等网页加载完毕，会自动关闭数据库连接
    function close(){
        return $this->dblink->close();
    }
    
    //获取一条数据
    function get($sql){
        $res = $this->query($sql);
        $row = $res->fetch_array();
        return $row;
    }
    
    //获取多条数据
    function gets($sql){
        $res = $this->query($sql);
        $rows = array();
        while($row = $res->fetch_array()){
            $rows[] = $row;
        }
        return $rows;
    }
}
