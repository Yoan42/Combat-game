<?php
function loadClass($classe)
{
    require_once ('classes/'.$classe.'.php') ;
}
spl_autoload_register('loadClass');


