<?php

/*
* Objetivo: Retorna o Sistema Operacional da Estaçao 
*/
function getOs(){
 
    $useragent = $_SERVER['HTTP_USER_AGENT'];
    
    $useragent = strtolower($useragent);
    
    //check for (aaargh) most popular first
    //winxp
    if(strpos("$useragent","windows nt 5.1") !== false)
    {
        return "Windows XP";
    }
    elseif (strpos("$useragent","windows nt 6.0") !== false)
    {
        return "Windows Vista";
    }
    elseif (strpos("$useragent","windows nt 6.1") !== false)
    {
        return "Windows 7";
    }
    elseif (strpos("$useragent","windows 98") !== false)
    {
        return "Windows 98";
    }
    elseif (strpos("$useragent","windows nt 5.0") !== false)
    {
        return "Windows 2000";
    }
    elseif (strpos("$useragent","windows nt 5.2") !== false)
    {
        return "Windows 2003 server";
    }
    elseif (strpos("$useragent","windows nt 6.0") !== false)
    {
        return "Windows Vista";
    }
    elseif (strpos("$useragent","windows nt") !== false)
    {
        return "Windows NT";
    }
    elseif (strpos("$useragent","win 9x 4.90") !== false && strpos("$useragent","win me"))
    {
        return "Windows ME";
    }
    elseif (strpos("$useragent","win ce") !== false)
    {
        return "Windows CE";
    }
    elseif (strpos("$useragent","win 9x 4.90") !== false)
    {
        return "Windows ME";
    }
    elseif (strpos("$useragent","iphone") !== false)
    {
        return "iPhone";
    }
    elseif (strpos("$useragent","mac os x") !== false)
    {
        return "Mac OS X";
    }
    elseif (strpos("$useragent","macintosh") !== false)
    {
        return "Macintosh";
    }
    elseif (strpos("$useragent","linux") !== false)
    {
        return "Linux";
    }
    elseif (strpos("$useragent","freebsd") !== false)
    {
        return "Free BSD";
    }
    elseif (strpos("$useragent","symbian") !== false)
    {
        return "Symbian";
    }
    else
    {
        return false;
    }
 }
function DateToBrasil($dataUsa)
{
    $data=explode("-",$dataUsa);
    if ( count($data)>1 )
    {
        return $data[2]."/".$data[1]."/".$data[0];
    }
    return $dataUsa;
}
function DateToUsa($dataBra)
{
    $data=explode("/",$dataBra);
    if ( count($data)>1 )
    {
        return $data[2]."-".$data[1]."-".$data[0];
    }
    return $dataBra;
    
}
 ?>