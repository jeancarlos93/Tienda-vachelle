
<html>
    <head>
         <script src="//code.jquery.com/jquery-1.10.2.js"></script> 
         <!--para la funcion de #header-->        
      <script> 
            $(function(){  
                $("#header").load("../View/Header.php"); 
            });
      </script>      
    </head>
    
    <body>
        <div id="header"></div>
          <br><br><br><br>
        <h1> Registrar Usuario</h1>
        
        <div id="registrar usuario">
            <form class="form" method="post" action="../Business/IngresarUsuarios.php" accept-charset="UTF-8" >
            
		<label for="nombreUsuario">Nombre:</label>
                <input title="Es necesario su nombre" type="text" id="name" name="nombreUsuario" required/>
		<label class="error" for="name" id="name_error">Debe introducir su nombre.</label><br><br>
                
                <label for="apellidoUsuario">Apellido:</label>
                <input type="text" id="name" name="apellidoUsuario" required/>
		<label class="error" for="name" id="name_error">Debe introducir su apellido.</label><br><br>
                
                <label for="cedulaUsuario">Cedula:</label>
                <input type="text" id="name" name="cedulaUsuario" maxlength="9"   required />
		<label class="error" for="name" id="name_error">Debe introducir su Cedula.</label><br><br>
                
                <label for="telefonoUsuario">Telefono:</label>
                <input type="text" id="name" name="telefonoUsuario" maxlength="8" required/>
		<label class="error" for="name" id="name_error">Debe introducir su telefono.</label><br><br>  
                
            <label for="tipoEmpleado">Tipo de Empleado:</label> <select name="tipoEmpleado" key="tipoEmpleado" class="tipoEmpleado" required >
                             <option value="Empleado">Vendedor</option>
                             <option value="Vendedor">Administrador</option>
                            
                </select ><br/>
                
                <label for="contrasenia1Usuario">Contrasenia:</label>
                <input type="password" id="name" name="contrasenia1Usuario" required/>
		<label class="error" for="name" id="name_error">Debe introducir la contraseña.</label><br><br>  
                
                <label for="contrasenia2Usuario"> Confirmar Contrasenia:</label>
                <input type="password" id="name" name="contrasenia2Usuario" required/>
		<label class="error" for="name" id="name_error">Debe confirmar la contraseña.</label><br><br> 
                
                <button id="boton" type="submit" class="btn btn-default">Guardar</button>
		
	    </form>
        </div>        
    </body>
    
    <footer>
        <p>footer</p>
    </footer>    
</html>
