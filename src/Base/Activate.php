<?php
/**
 * @package MRLCAA
 */

namespace CAA\Base;

class Activate
{
    //On lance la fonction à l'activation
    public static function activate(){
        flush_rewrite_rules();

        /*Si cette option est déjà enregistrer
        en base de donnée dans la table WP_Option
        alors on fais rien, sinon on update*/
        if (get_option( 'mrl_caa_plugin' )){
            return;
        }

        $default = [];

        update_option( 'mrl_caa_plugin', $default);
    }
}