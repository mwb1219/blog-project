<?php

class page{
    //存放了最大页数
    public $maxPage;
    
    function __construct($dataTotal, $pageTotal, $p, $file) {
        $this->maxPage = ceil($dataTotal / $pageTotal);
        $this->p = $p;
        $this->file = $file;
    }
    
    function showPage(){
        $html = '';
        for($i = 1;$i <= $this->maxPage; $i ++){
            if($this->p == $i){
                $html .= "<li class='active'><span aria-hidden='true'    style='color:red;'>{$i}</span></li>";
                
            }else{
                $html .= "<li><span aria-hidden='true'><a href='{$this->file}?p=$i'>{$i}</a></span></li>";
            }
        }
        return $html;
    }
}

