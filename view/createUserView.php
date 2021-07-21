
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Inscription</title>
</head>
<body>
	<div align="center">
		<h1>Inscription</h1>
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

		<form action="index.php?action=createUser" method="post">
			<table>
				<tr>
					<td>
						<label for="pseudo">Pseudo :
					</td>
					<td>
						<input type="text" name="pseudo" id="pseudo" placeholder="Votre pseudo" value="<?php if(isset($pseudo)) { echo $pseudo; } ?>">
					</td>
				</tr>
				<tr>
					<td>
						<label for="email">Mail :</label>
					</td>
					<td>
						<input type="email" name="email" id="email" placeholder="Votre mail" value="<?php if(isset($email)) { echo $email; } ?>">
					</td>
				</tr>
				<tr>
					<td>
						<label for="pass">Mot de Passe :</label>
					</td>
					<td>
						<input type="password" name="pass" id="pass" placeholder="Votre mot de passe">
					</td>
				</tr>
				<tr>
					<td>
						<label for="pass_confirm">Confirmation du mot de passe :</label>
					</td>
					<td>
						<input type="password" name="pass_confirm" id="pass_confirm" placeholder="Votre mot de passe">
					</td>					
				</tr>
				<tr>
					<td></td>
					<td id="bouton_submit">
						<input type="submit" name="forminscription" value="S'inscrire"></input>
					</td>
				</tr>	
			</table>
		</form>
	</div>
</body>
</html>