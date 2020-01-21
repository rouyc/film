<?php
    require_once File::build_path(array('model','ModelProgramme.php'));
    require_once File::build_path(array('model','ModelRecherche.php'));

    if (empty($tab_res)){
        echo "<div class=\"col s12\">
                            <div class=\"card\">
                                <div class=\"card - content center\">
                                    <a class=\" black-text \"> <br> Aucun film disponible avec les critères choisis <br> <br>    
                                    </a>
                        </div>
                    </div>
                </div>";
    }
    else {
        foreach ($tab_res as $res) {
            $res->afficher();
        }
    }

    
?>