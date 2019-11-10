<div class="card">
	<div class="card-body text-center">
		<form method="POST" action="#">
			<h3 class="text-center text-danger">Formulaire ajout utilisateur</h3>
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-hover table-sm">
					<thead class="thead-dark">
						<tr>
							<th scope="col">Nom</th>
							<th scope="col">Prénom</th>
							<th scope="col">Email</th>
							<th scope="col">Mot de passe</th>
							<th scope="col">level</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<input type="text" name="nomUser" required>
							</td>
							<td>
								<input type="text" name="prenomUser" required>
							</td>
							<td>
								<input type="email" name="emailUser" required>
							</td>
							<td>
								<input type="text" name="mdpUser" required>
							</td>
							<td>
								<select name="levelUser" required>
									<option value="">Choisir le niveau</option>
									<option value="1">Admin</option>
									<option value="2">Utilisateur</option>
								</select>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<input class="text-center" type="submit" name="ajoutUser" value="Valider">
		</form>
	</div>
</div>