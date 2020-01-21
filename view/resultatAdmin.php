<?php
    require_once File::build_path(array('model','ModelProgramme.php'));
    require_once File::build_path(array('model','ModelRechercheAdmin.php'));

    foreach ($tab_resultatAdmin as $res) {
        ModelProgramme::afficher($res);
    }
    if (empty($tab_resultatAdmin)){
        echo "<div class=\"col s12\">
                        <div class=\"card\">
                            <div class=\"card - content center\">
                                <a class=\" black-text \"> <br> Aucun film disponible avec les critères choisis <br> <br>    
                                </a>
                    </div>
                </div>
            </div>";
    }
?>