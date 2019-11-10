<div class="table-responsive">
	<table class="table table-striped table-bordered table-hover table-sm">
		<h3 class="text-center text-danger"><?php echo $titre; ?></h3>
		<thead class="thead-dark">
			<tr>
				<th scope="col">Numéro</th>
				<th scope="col">Nom</th>
				<th scope="col">Statut</th>
				<th scope="col">New statut</th>
				<th scope="col">Modifier</th>
				<th scope="col">Supprimer</th>
			</tr>
		</thead>
		<tbody>
			<?php
			// Boucle sur toutes les taches de la bdd
			foreach ($donneesRecup as $key => $value) {
				$numero = intval($donneesRecup[$key]['id_tache']);
				$nom = utf8_decode($donneesRecup[$key]['nom_tache']);
				$statut = intval($donneesRecup[$key]['statut']);
				if ($statut === 1){
					$statutNom = "En cours";
					$color = "text-danger";
				} else {
					$statutNom = "Terminée";
					$color = "text-success";
				}
				?>
				<tr>
					<form method="POST" action="?page=updateTache" onsubmit="return confirm('Etes-vous sur de la modification du numéro : <?php echo $numero; ?>?')">
						<th scope="row"><?php echo $numero; ?></th>
						<td>
							<input type="text" name="newNameTache" value="<?php echo $nom; ?>">
						</td>
						<td class="<?php echo $color; ?>"><?php echo $statutNom; ?></td>
						<td>
							<select name="newStatut">
								<option value="">Choisir un nouveau statut</option>
								<option value="1">En cours</option>
								<option value="2">Terminée</option>
							</select>
						</td>
						<td>
							<input type="hidden" name="numeroTache" value="<?php echo $numero; ?>">
							<input type="hidden" name="statutTache" value="<?php echo $statut; ?>">
							<input type="submit" name="updateTache" value="Valider">

						</td>
					</form>
					<form method="POST" action="?page=deleteTache" onsubmit="return confirm('Etes-vous sur de la suppression du numéro : <?php echo $numero; ?>?')">
						<td>
							<input type="hidden" name="numeroTache" value="<?php echo $numero; ?>">
							<input type="submit" name="deleteTache" value="Valider">
						</td>
					</form>
				</tr>
				<?php
			}
			?>
		</tbody>
	</table>
</div>