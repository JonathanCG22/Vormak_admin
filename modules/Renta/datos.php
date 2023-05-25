<?php
require '../../config/conexion.php';
$crud = new CRUD;
$costo=$_POST['costo'];

echo "<input type='text' name='total' class='form-control' value=".$costo." required='required' maxlength='30' disable>";
        
      
?>