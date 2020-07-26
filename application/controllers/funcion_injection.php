<?php

function injection($tAlias)
{
    $archivo = file('black_list.txt');
    $encontrado=0;
    foreach($archivo as $linea) 
    {
        if(strpos($tAlias,' '.trim($linea))!==false)
        {
            $encontrado=1;
            break;
        }
    }
    
    if ($encontrado==1)
    {
        return true;
    }
    else
    {
        return false;
    }
    
}

function numerico($tClave)
{
    if(ctype_digit($tClave))
    {
        return true;
    }
    else
    {
        return false;
    }
}

function graficar()
{
    echo " <div class='alert alert-danger'>
    <h1><strong align='center'>Te Atrapamos! Estas intentando realizar SQL INJECTION. </strong></h1>
    </div>
    <div align='center'>
    <img src='http://localhost/parcial/img/sql.jpg' width='320px' height='240px'>
    </div>";
}
?>