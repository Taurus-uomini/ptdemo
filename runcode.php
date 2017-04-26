<?php
    function runphp($code)
    {
        file_put_contents('code.php',$code);
        $ret=passthru('php -f code.php',$status);
        if($status!=0)
        {
            passthru('php -f code.php 2>&1',$ret);
        }
        return $ret;
    }
    function runc($code)
    {
        file_put_contents('code.c',$code);
        $ret=passthru('gcc code.c -o code',$status);
        if($status==0)
        {
            $ret=passthru('./code',$status);
        }
        else
        {
            passthru('gcc code.c -o code 2>&1',$ret);
        }
        return $ret;
    }
    function runjava($code)
    {
        file_put_contents('code.java',$code);
        $ret=passthru('javac code.java',$status);
        if($status==0)
        {
            $ret=passthru('java code',$status);
        }
        else
        {
            passthru('javac code.java 2>&1',$ret);
        }
        return $ret;
    }
    $code=$_POST['code'];
    $la=$_POST['la'];
    switch($la)
    {
        case 'php':$ret=runphp($code);break;
        case 'c_cpp':$ret=runc($code);break;
        case 'java':$ret=runjava($code);break;
    }
    echo $ret;
?>