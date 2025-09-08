<div class="inis">
	<h2> Inicio de Sesion </h2>
<form name="frm1" action="models/control.php" method="POST">
	<div class="row">
		<div class="form-group col-md-12">
			<label for="usu"><i class="fa-solid fa-user"></i>Usuario</label>
			<input type="text" name="usu" id="usu" class="form-control" required>
		</div>
		<div class="form-group col-md-12">
			<label for="pas"><i class="fa-solid fa-key"></i>Contraseña</label>
			<input type="password" name="pas" id="pas" class="form-control" required>
		</div>
		<?php 
		$err= isset($_GET['err']) ? $_GET['err']:NULL;
		if($err=="ok"){
		?>
		<div class="form-group col-md-12 derr">
			¡Datos Incorrectos!
		</div>
		<?php }?>
		<div class="form-group col-md-12">
			<br>
			<input type="submit" value="ingresar" class=" form-control btn btn-primary" >
		</div>
	</div>
</form>
</div>