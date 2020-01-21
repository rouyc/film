<!-- Utilisateur -->
    <div class="card">
        <div class="card-content ">
            <?php
                foreach ($tab_U as $utilisateur)
                    echo '<div class="card">
                            <div class="card-content ">
                                <div class="valign-wrapper row">
                                    <div class="col s1">
                                        <p>' . $utilisateur->getNomUtilisateur() . '</p>
                                    </div>
                                    <div class=" col s1">
                                        <p>' . $utilisateur ->getPrenomUtilisateur(). '</p>
                                    </div>
                                    <div class=" col s1">
                                        <p>' . $utilisateur ->getDateNaissanceUtilisateur(). '</p>
                                    </div>
                                    <div class=" col s4">
                                        <p>' . $utilisateur ->getEmailUtilisateur(). '</p>
                                    </div>
                                    <div class=" col s4">
                                        <p>' . $utilisateur ->getAdresseUtilisateur(). '</p>
                                    </div>
                                    <div class=" col s1">
                                        <p>' . $utilisateur ->getTelephoneUtilisateur(). '</p>
                                    </div>
                                    <div class="col s1">
                                        <a class=\'waves-effect waves-light btn\' href=\'./index.php?controller=utilisateur&action=supprimerUtilisateur&id=' . rawurlencode($utilisateur->getIdUtilisateur()) . '\'>Supprimer</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>';
            ?>
        </div>
    </div>