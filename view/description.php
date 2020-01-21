<!-- Reservatoion -->
<div class="row">
    <div class="col s12">
        <div class="card">
            <div class="card-content">
                <?php
                foreach ($tab_res as $res) {
                    echo $res->getTitreProgramme() . '<br>' . $res->getImageProgramme() . '<br>' . ' Synopsis :  ' . $res->getDescriptionProgramme() . '<br> Durée du film : ' . $res->getDureeProgramme() . '<br> pays du film : ' . $res->getPaysProgramme() . '<br>';
                }
                ?>
            </div>
        </div>
    </div>
</div>