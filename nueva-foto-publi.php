<?php
include('conexion.php');

if(isset($_GET['nuevafoto'])){
                
    echo "<input class='boton' type='file' name='foto-publicacion'>";
  
   exit(); 
}  
?>