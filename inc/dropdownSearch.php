	<form class="div-filter rounded" action="../casting/results.php" onsubmit="return goSearch()" method="post">
		<div class="div-search">
			<select name="voice" class="search rounded" size=1 >
				<option selected disabled value="" >BUSCO UNA VOZ...</option>
				<option value="F">Femenina</option> 
				<option value="M">Masculina</option> 
				<option value="I">Infantil</option> 
			</select>
		</div>
		<div class="div-search">		
			<select name="character" class="search rounded" size=1 >
				<option selected disabled value="" >CON UN CARACTER...</option>
			<?php 
				$caracteres = get_caracteres();
				foreach ($caracteres as $caracter){?>  
					<option value="<?php echo $caracter["codigo"] ?>"><?php echo $caracter["caracter"] ?></option> 
			<?php 
				// Get the description of the character for the legend
				if ($caracter["codigo"] == $character){ $character_desc = $caracter["caracter"];}
			} ?>
			</select>
		</div>
		<input type="submit" id="searchButton" class="search rounded yellowBG" value="BUSCAR" >
	</form>
	<label id="lblMessage" class="errorMsgLabel" hidden > </label>