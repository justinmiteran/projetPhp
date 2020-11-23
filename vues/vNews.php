<?php

foreach($Tnews as $news){
    echo("$news<br>");
}

if($pageCourante != 1){
    echo('<');
}
echo(" $pageCourante ");
if($pageCourante < $pageMax){
    echo('>');
}