<div class="col s12 l6">
    <div class="card">
        <div class="card-content">
            <form method="post" action="index.php?controller=utilisateur&action=validationTest">
                <legend>Validation de Compte</legend>
                <p>
                    <label for="login_id">Login du compte à valider</label>
                    <input type="text" name="login" id="login_id" required/>
                </p>
                <p>
                    <label for="code_id">Code envoyé par mail</label>
                    <input type="password" name="code" id="code_id" required/>
                </p>
                <p>
                    <input type="submit" value="Envoyer" />
                </p>
            </form>
            <?php
            if (isset($msg)) {
                echo "<p class=\"red-text\">$msg </p>";
            }
            ?>
        </div>
    </div>
</div>
</div>