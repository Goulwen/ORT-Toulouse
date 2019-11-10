<div class="table-responsive">
	<table class="table table-striped table-bordered table-hover table-sm">
		<h3 class="text-center text-danger"><?php echo $titre; ?></h3>
		<thead class="thead-dark">
			<tr>
				<th scope="col">Numéro</th>
				<th scope="col">Nom</th>
				<th scope="col">Prénom</th>
				<th scope="col">Email</th>
				<th scope="col">Mot de passe</th>
				<th scope="col">Niveau</th>
				<th scope="col">Nouveau niveau</th>
				<th scope="col">Modifier</th>
				<th scope="col">Supprimer</th>
			</tr>
		</thead>
		<tbody>
			<?php
			// Boucle sur toutes les taches de la bdd
			foreach ($donneesRecup as $key => $value) {
				$id = intval($donneesRecup[$key]['id_user']);
				$nom = utf8_decode($donneesRecup[$key]['nom_user']);
				$prenom = utf8_decode($donneesRecup[$key]['prenom_user']);
				$email = utf8_decode($donneesRecup[$key]['email_user']);
				$mdp = utf8_decode($donneesRecup[$key]['mdp_user']);
				$level = intval($donneesRecup[$key]['level_user']);
				if ($level === 1){
					$levelNom = "Admin";
					$color = "text-danger";
				} else {
					$levelNom = "Utilisateur";
					$color = "text-success";
				}
				?>
				<tr>
					<form method="POST" action="?page=updateUser" onsubmit="return confirm('Etes-vous sur de la modification du numéro : <?php echo $key + 1; ?>?')">
						<th scope="row"><?php echo $key + 1; ?></th>
						<td>
							<input type="text" name="newNomUser" value="<?php echo $nom; ?>">
						</td>
						<td>
							<input type="text" name="newPrenomUser" value="<?php echo $prenom; ?>">
						</td>
						<td>
							<input type="email" name="newEmailUser" value="<?php echo $email; ?>">
						</td>
						<td>
							<input type="text" name="newMdpUser" value="<?php echo $mdp; ?>">
						</td>
						<td class="<?php echo $color; ?>"><?php echo $levelNom; ?></td>
						<td>
							<select name="newlevel">
								<option value="">Choisir le nouveau niveau</option>
								<option value="1">Admin</option>
								<option value="2">Utilisateur</option>
							</select>
						</td>
						<td>
							<input type="hidden" name="idUser" value="<?php echo $id; ?>">
							<input type="submit" name="updateUser" value="Valider">
						</td>
					</form>
					<form method="POST" action="?page=deleteUser" onsubmit="return confirm('Etes-vous sur de la suppression du numéro : <?php echo $key + 1; ?>?')">
						<td>
							<input type="hidden" name="idUser" value="<?php echo $id; ?>">
							<input type="submit" name="deleteUser" value="Valider">
						</td>
					</form>
				</tr>
				<?php
			}
			?>
		</tbody>
	</table>
</div>