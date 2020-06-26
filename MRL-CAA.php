<?php
/**
 * @package MRLCAA
 */

/*
Plugin Name: MRL CAA
Description: Gestion de la parti CAA.
Version: 1.0.0
Author: MRL
*/

//check si le plugin est utilisé par wordpress
if( ! defined('ABSPATH') ){
    die( "You're wrong" );
}

//check si l'autoload est ne place pour les namespace
if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
    require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}


//activation et deactivation du plugin

function activate_mrl_caa(){
    CAA\Base\Activate::activate();
}
register_activation_hook( __FILE__, 'activate_mrl_caa' );

function deactivate_mrl_caa(){
    CAA\Base\Deactivate::deactivate();
}
register_deactivation_hook( __FILE__, 'deactivate_mrl_caa' );


//initialisation du Plugin
if (class_exists( 'CAA\\Init' ) ) {
    CAA\Init::register_services();
}
