<div class="col s12 l6">
		<div class="card">
  			<div class="card-content">
  				<form method="post" action="index.php?controller=utilisateur&action=connected">
				    <legend>Connexion :</legend>
				    <p>
				      <label for="email_id">Email</label>
				      <input type="email" name="email" id="email_id" required/>
				    </p>
				    <p>
				      <label for="mdp_id">Mot de passe</label>
				      <input type="password" name="password" id="mdp_id" required/>
				    </p>
				    <p>
				      <input type="submit" value="Envoyer" />
				    </p>
				</form>
                <?php if(isset($msg)) {
                    echo "<p class=\"red-text\">$msg </p>";
                } ?>
  			</div>
		</div>
	</div>
</div>