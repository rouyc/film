	<div class="col s12 l6">
		<div class="card">
  			<div class="card-content">
  				<form method="post" action="index.php?controller=utilisateur&action=addUtilisateur">
				    <legend>Inscription :</legend>
				    <p>
				      <label for="nom_id">Nom</label>
				      <input type="text" name="nom" id="nom_id" required/>
				    </p>
				    <p>
				      <label for="prenom_id">Prénom</label>
				      <input type="text" name="prenom" id="prenom_id" required/>
				    </p>
				    <p>
				      <label for="datedenaissance_id">Date de naissance</label>
				      <input type="date" name="datedenaissance" id="datedenaissance_id" required/>
				    </p>
				    <p>
				      <label for="email_id">Email</label>
				      <input type="email" name="email" id="email_id" required/>
				    </p>
				    <p>
				      <label for="mdp_id">Mot de passe</label>
				      <input type="password" name="password" id="mdp_id" required/>
                    </p>
                    <p>
                        <label for="mdp_id">Mot de Passe</label>
                        <input type="password" name="password1" id="mdp_id" required/>
                    </p>

				    <p>
				      <label for="adresse_id">Adresse</label>
				      <input type="text" name="adresse" id="adresse_id" required/>
				    </p>
				    <p>
				      <label for="telephone_id">Télephone</label>
				      <input type="tel" name="telephone" id="telephone_id" required/>
				    </p>
				    <p>
				      <input type="submit" value="Envoyer" />
				    </p>
				</form>

  			</div>
		</div>
	</div>


