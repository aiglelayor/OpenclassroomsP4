<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link href="fonts/css/fontawesome.css" rel="stylesheet">
	<link href="fonts/css/brands.css" rel="stylesheet">
  	<link href="fonts/css/solid.css" rel="stylesheet">
  	<link rel="stylesheet" type="text/css" href="style.css">
  	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
   	integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
   	crossorigin=""/>
   	<link href="https://allfont.net/allfont.css?fonts=raleway-regular" rel="stylesheet" type="text/css" />
   	<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
   	integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
   	crossorigin=""></script>
   	<script src="js/jquery.js"></script>
	<title>Vélo'Nantes - Projet OpenClassroom</title>
	<meta name="Sara Bjorck" content="Vélo'Nantes">
	<meta property="og:title" content="Vélo'Nantes"/>
	<meta property="og:description" content="Agence de Location de Vélos à Nantes"/>
	<meta property="og:image" content="img/logo_text.png">
	<meta property="og:image:secure_url" content="img/logo_text.png"/>
	<meta property="og:image:type" content="image/jpeg"/>
	<meta property="og:image:width" content="1200"/>
	<meta property="og:image:height" content="627" />
	<meta property="og:image:alt" content="Vélo'Nantes Logo"/>
	<meta property="og:url" content="http://sara-lima.fr/p1/"/>
	<meta name="twitter:card" content="Agence de Location de Vélos à Nantes"/>
	<meta name="twitter:site" content="Agence de Location de Vélos à Nantes"/>
	<meta name="twitter:creator" content="Sara Bjorck"/>	
</head>
<body>
	<nav class="navBar">
		<nav class="menu">
		    <div id = "logo_header">
		    	<img class="logo" src="img/logo_header.png" alt="Logo Vélo'Nantes"/>
		    </div>
		    <input type="checkbox" id="menu_toggle">
		    <label for="menu_toggle" class="label_toggle"></label>
		    <ul>
			    <li><a href="#carousel1">Accueil</a></li>
				<li><a href="#choisir_station">Réserver un vélo</a></li>
				<li><a href="#contact">Contact</a></li>
	    	</ul>
	  	</nav>
	</nav>
	<div class="container">
		<div id="carousel1">
			<div class="item">
				<div class="item__image">
					<img src="img/slide1.jpg" alt="">
				</div>
				<div class="item__body">
					<div class="item__title">
						Vélo Nantes vous accompagne à chaque instant !
					</div>
				</div>
			</div>
			<div class="item">
				<div class="item__image">
					<img src="img/slide2.jpg" alt="">
				</div>
				<div class="item__body">
					<p>
					Un panneau s'affiche lors du clic sur un marqueur vous permettant de réserver un vélo
					<p>
				</div>
			</div>
			<div class="item">
				<div class="item__image">
					<img src="img/slide3.jpg" alt="">
				</div>
				<div class="item__body">
					<p>
					Cliquez sur 'réserver', puis indiquez votre nom, votre prénom et signez avant de confirmer notre réservation.
					</p>
				</div>
			</div>
			<div class="item">
				<div class="item__image">
					<img src="img/slide4.jpg" alt="">
				</div>
				<div class="item__body">
					<p>
					Votre réservation expire automatiquement après 20 minutes.
					</p>
				</div>
			</div>
			<div class="item">
				<div class="item__image">
					<img src="img/slide5.jpg" alt="">
				</div>
				<div class="item__body">
					<p>
					Bon voyage !
					</p>
				</div>
			</div>
		</div>
	</div>
	<div class="informations_tarifs" id="choisir_station">
		<h2>RÉSERVER VOTRE VÉLO'NANTES</h2>
		<div class="heading_border"></div>
		<p>Vous pouvez réserver un vélo, 7j/7, 24h/24.</p>
		<p>Dans chaque station, une borne permet d'acquérir une carte (courte durée) payable par carte bancaire. </p>
		<p>Le ticket 1 trajet coûte 1,80 € et la formule 24 heures 4 €.</p>
		<p>L'abonnement longue durée coûte 31 €.</p>
		<h2>SÉLECTIONNER UNE STATION POUR COMMENCER LA RÉSERVATION</h2>
		<div class="heading_border"></div>
	</div>
	<div class="map_section">
			<div id="map_container">Carte Stations Vélos</div>
			<div class="map_infos infos_hidden"> 
				<div>
					<button type="button" class="close">
						<i class="fas fa-window-close"></i>
					</button>
				</div>
				<div class="station_infos">
					<h3 class="station_name"></h3>
					<p class="station_address"></p>
					<p class="station_status"></p>
				</div>
				<div class="station_bikes_stands">
					<p id="bikes_stands"></p>
					<i class="fas fa-parking"></i>
					<p><span class="laces">laces</span> disponibles</p>
				</div>
				<div class="station_bikes_available">
					<p id="bikes_available"></p>
					<i class="fas fa-bicycle"></i>
					<p>disponibles</p>
					<i class="fas fa-credit-card"></i>
				</div>
				<div class="container_bouton_message">
					<button type="button" id="button_reserver">Réserver</button>
					<p class="message_aucunvelo hidden">Aucun vélo n'est actuellement disponible dans cette station.</br>Veuillez réessayez plus tard.</p>
				</div>
			</div>	
	</div>
	<div class ="reservation hidden" id="reserver">
		<form method="post" action="#">
			<h3>Réservation</h3>
			<p>Veuillez apposer votre signature et indiquer votre nom et votre prénom pour finaliser la réservation.</p>
			<input type="text" id="Nom" placeholder="Nom" maxlength="30" required/><br>
			<input type="text" id="Prenom" placeholder="Prénom" maxlength="30" required/><br>
			<canvas id="canvas"></canvas>
			<button type="button" class="btn btn-primary" id="submit" value="Réserver mon vélo">Réserver mon Vélo</button>
			<button type="button"class="btn btn-default" id="clear">Effacer</button>
			<div class="hidden" id="reservation_validee">
				<h3>Votre Réservation</h3>
				<p>Votre vélo est réservé à la station <span class="station_nom"></span></br>
				<span class="station_addresse">Adresse</span></br>
				au nom de <span class="prenom"></span> <span class="nom"></span>.</br>
				Temps restant : <span id="time_left"></span></p>
				<button type="reset" id="annuler">Annuler la réservation</button>
			</div>
		</form>
		
	</div>
	<div class="hidden" id="reservation_annulee">
				<h3>Votre réservation a bien été annulée.</h3>
	</div>
	<div id="contact">
		<h2>NOUS CONTACTER</h2>
		<div class="heading_border"></div>
		<div class="contact">
			<div class="formulaire_contact">
				<input type="text" name="Nom" placeholder="Nom" maxlength="30"/>

				<input type="email" name="E-mail" placeholder="E-mail" maxlength="30"/>

				<input type="text" name="Subject" placeholder="Sujet" maxlength="30"/>

				<textarea name="Message" placeholder="Message" maxlength="400" rows="8"></textarea>

				<input id="bouton" type="submit" value="Envoyer Message"/>
				<p>contact.velonantes@jcdecaux.com<br>Tel : 01 02 03 04 05<br></p>
			</div>
			<img src="img/slide_contact.jpg" alt="Vélos Nantes" id="contact_image">
		</div>
	</div>
	<footer>
		<div id="reseaux">
		    	<img class="logo" src="img/reseaux.png" alt="Réseaux"/>
		    	<p>2020 LIMA Sara - Projet 3 Openclassrooms</br>Icons made by <a href="https://fontawesome.com/kits/19a4ab798e/use?welcome=yes">Font Awesome</a></p>
		</div>
	</footer>
	<script src="js/carousel.js"></script>
	<script src="js/stations.js"></script>
	<script src="js/main.js"></script>
</body>
</html>