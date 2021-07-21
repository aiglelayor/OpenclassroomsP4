<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Connexion</title>
</head>
<body>
	<div>
		<h1>Connexion</h1>
		<?php
		if(!empty($showErrors))
		{
			if($showErrors == true){ ?>
				<div>
					<p>Certains champs requièrent votre attention.</p>
					<ol>
						<?php foreach ($errors as $kerrors) { ?>
						<li><?=$kerrors;?></li>
						<?php } ?>	
					</ol>
				</div>
			<?php
			}
		}
		?>
		<form action="index.php?action=userLogin" method="post">
			<input type="text" name="pseudoconnect" placeholder="Pseudo" value="<?php if(isset($pseudoconnect)) { echo $pseudoconnect; } ?>"/>
			<input type="password" name="passconnect" placeholder="Mot de passe">
			<input type="submit" name="formconnection" value="Se connecter">
		</form>
		<?php
		if(isset($erreur))
		{
			echo $erreur;
		}
		?>
	</div>
	
</body>
</html>
