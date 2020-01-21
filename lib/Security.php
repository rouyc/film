<?php
/**
 * Created by IntelliJ IDEA.
 * User: cleme
 * Date: 15/11/2019
 * Time: 08:25
 */

class Security
{
    public static function chiffrer($texte_en_clair)
    {
        $seed = Security::getSeed();
        $texte_en_clair = $seed . $texte_en_clair;
        $texte_chiffre = hash('sha256', $texte_en_clair);
        return $texte_chiffre;
    }

    private static $seed = 'LmUDoGTGQe';

    static public function getSeed() {
        return self::$seed;
    }


}