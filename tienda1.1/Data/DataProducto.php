<?php

include_once '../Data/Data.php';

function registrarProducto($producto) {
    $conn = getConnection();
    $descripcion = $producto->getDescripcion();
    $precioUnitario=$producto->getPrecioUnitario();
    $precioVenta=$producto->getPrecioVenta();
    $marca = $producto->getMarca();
    $categoria = $producto->getCategoria();

    $sql = "insert into Producto (descripcion,precioUnitario,precioVenta,idmarcaProd,idCategoriaProd,estado) VALUES('".$descripcion."',".$precioUnitario.",".$precioVenta.",".$marca.",".$categoria.",1);";

    if ($conn->query($sql) == TRUE) {

        echo "GUARDADO ";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    header("Location: ../View/Listar_Productos.php");
    die();

}

function modificarProducto($producto) {
    
    $conn = getConnection();
    $id= $producto->getId();  //solo si no es autoincrement se usa
    $descripcion = $producto->getDescripcion();
    $precioUnitario=$producto->getPrecioUnitario();
    $precioVenta=$producto->getPrecioVenta();
    $marca = $producto->getMarca();
    $categoria = $producto->getCategoria();

    $sql = "Update Producto set descripcion='$descripcion', precioUnitario='$precioUnitario',precioVenta='$precioVenta',idmarcaProd='$marca',idCategoriaProd='$categoria' where codigo=$id;";
    if ($conn->query($sql) == TRUE) {

        echo "GUARDADO ";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    header("Location: ../View/Listar_Productos.php");
    die();

}

function eliminarProducto($codigo) {// metodo de eliminar: aun no estaba vel valor a setear en labase de datos pero lo puse a setear el nombre... Cambiar la variable nada mÃ¡s
    $conn = getConnection();
    $sql = "Update Producto set estado= 0 where codigo='$codigo'";
     if ($conn->query($sql) == TRUE) {
        echo "GUARDADO ";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
    header("Location: ../View/Listar_Productos.php");
    die();

}

function registrarMarca($marca) {
    $conn = getConnection();
    $marcaN= $marca->getMarca();  //solo si no es autoincrement se usa

    $sql = "insert into marcaProd (marca) VALUES('$marcaN');";

    if ($conn->query($sql) == TRUE) {

        echo "GUARDADO ";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    header("Location: ../View/Listar_Productos.php");
    die();
}

function registrarCategoria($categoria) {
    $conn = getConnection();
    $categoriaN= $categoria->getCategoria();  //solo si no es autoincrement se usa

    $sql = "insert into categoriaProd (categoria) VALUES('$categoriaN');";

    if ($conn->query($sql) == TRUE) {

        echo "GUARDADO ";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    header("Location: ../View/Listar_Productos.php");
    die();
}

function eliminarMarca($idMarca,$marcas) {// metodo de eliminar: aun no estaba vel valor a setear en labase de datos pero lo puse a setear el nombre... Cambiar la variable nada mÃƒÂ¡s
    
    $conn = getConnection();
    $sql = "Update marcaProd set marca='$marcas' where id=$idMarca";
     if ($conn->query($sql) == TRUE) {
        echo "GUARDADO ";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }  
    $conn->close();
    header("Location: ../Registrar_marca.php");
    die();
}

function ModificarCategoria($codigo,$categoria) {// metodo de eliminar: aun no estaba vel valor a setear en labase de datos pero lo puse a setear el nombre... Cambiar la variable nada mÃƒÂ¡s
    $conn = getConnection();
    $sql = "Update categoriaProd set categoria='$categoria' where id='$codigo'"; //Update Proveedor set estado=0 where codigo =6;
   
    if ($conn->query($sql) == TRUE) {
        echo "GUARDADO ";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }  
    $conn->close();
    header("Location: ../Registrar_Categoria.php");
    
    die();
    
}
?>

