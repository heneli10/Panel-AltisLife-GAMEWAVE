<div class="container">
      <div class="row">
		<?php
		if(Auth::isLogged()){
		?>
		<div class="col-lg-12">
			<div class="page-header">	
			  <?php 
			  	$tot_players = $DB->query("SELECT COUNT(playerid) AS totalPlayer FROM players");
			  	$count_police = $DB->query("SELECT DISTINCT COUNT(playerid) AS totalPolice FROM players WHERE coplevel = '1' OR coplevel = '2' OR coplevel = '3' OR coplevel = '4' OR coplevel = '5' OR coplevel = '6' OR coplevel = '7'");
			  ?>
			  <?php while($row = $tot_players->fetch(PDO::FETCH_OBJ) && $row2 = $count_police->fetch(PDO::FETCH_OBJ)){ ?>
			  <h3 id="type" style="text-transform:uppercase;">Liste des <?php echo $row2->totalPolice; ?> policiers du serveur</h3>
			  <?php } ?>
			</div>

			<?php
				// Recherche et gametracker
				include 'search.php';
			?>
			<form action="<?=WEBROOT?>joueur" method="post">
				<a href="/" class="list-group-item" style="background-color:#F8F8F8; color:#000;"<b>Liste des joueurs enregistrés sur le serveur ALTISLIFE</b></a>

        <ul class="list-group" style="min-height: 298px; overflow: auto" name="search"> <!-- Permet d'afficher la liste de tout les joueurs (si pas de limit dans la requetes SQL) -->
        <?php
				if ($search_value == '') {
					$search = $DB->query("SELECT DISTINCT * FROM players WHERE coplevel = '1' OR coplevel = '2' OR coplevel = '3' OR coplevel = '4' OR coplevel = '5' OR coplevel = '6' OR coplevel = '7' ORDER BY adminlevel DESC"); //Affiche les 150 joueurs les plus riches
				  echo '<table style="width:100%;">';
					while($row = $search->fetch(PDO::FETCH_OBJ)){
	          //Nom du joueur
						echo '<a style="" class="list-group-item" href="modifier?j='.$row->playerid.'" value="'.$row->playerid.'">'.$row->name.'';
						//Variables pour les infos bdd
						$pseudo=$row->name;
	          $dntr_lvl=$row->donatorlvl;
	          $bankacc=$row->bankacc;
	          $cash=$row->cash;
	          $adminlevel=$row->adminlevel;
	          $coplevel=$row->coplevel;
	          $duredon=$row->duredon;

	          // liste (boucle) des infos sur la ligne
	          include 'badges.php';
          }
				}
				else {
						include 'search_req.php';
				}
        // Fermeture de la connexion à la BDD
				$search->closeCursor();					
				?>
				</ul>
				</div>
			</form>
		 </div>	  
		<?php
		}
		?>
  	</div>
  </div>
<br>
<br>