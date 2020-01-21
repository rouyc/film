<?php

    require_once File::build_path(array('model','Model.php'));

    class ModelDescription extends Model
    {

        private $idProgramme;
        private $titreProgramme;
        private $descriptionProgramme;
        private $paysProgramme;
        private $dureeProgramme;
        private $imageProgramme;
        protected static $object='description';
        protected static $primary='idDescription';


        public function getIdProgramme()
        {
            return $this->idProgramme;
        }

        public function getTitreProgramme()
        {
            return $this->titreProgramme;
        }


        public function getDescriptionProgramme()
        {
            return $this->descriptionProgramme;
        }


        public function getPaysProgramme()
        {
            return $this->paysProgramme;
        }


        public function getDureeProgramme()
        {
            return $this->dureeProgramme;
        }


        public function getImageProgramme()
        {
            return $this->imageProgramme;
        }

    }
    ?>