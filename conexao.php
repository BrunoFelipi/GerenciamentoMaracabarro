<?php
$conecta = mysqli_connect("localhost", "root", "") or print (mysqli_error()); 
mysqli_select_db($conecta, "abarro") or print(mysqli_error());

if($conecta){
    print "Conexão e Seleção OK!";     
} else {
    print "NOK!"; 
}

mysqli_close($conecta);

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

