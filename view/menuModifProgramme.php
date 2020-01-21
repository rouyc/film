<!-- Menu modif programme -->
<div class="center">
    <nav class="nav-wrapper white">
        <div class="col s12" >
            <ul class="left">
                <?php
                        foreach ($tab_programme as $programme) {
                            echo '<li> <a class="black-text" href="./index.php?controller=adminProgramme&action=build_modifProgramme&id='. $programme->getIdProgramme() .'">'. $programme->getTitreProgramme() .' </a> </li>';
                    }
                ?>
            </ul>
        </div> 
    </nav> 
</div>