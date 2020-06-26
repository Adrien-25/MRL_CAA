<?php
/**
 * @package MRLCAA
 */

namespace CAA\Pages;

use \CAA\Base\BaseController;
use \CAA\API\SettingsApi;
use \CAA\API\Callbacks\AdminCallbacks;
use \CAA\API\Callbacks\ManagerCallbacks;

class Dashboard extends BaseController
{
    public $settings;

    public $pages = array();

    public $callbacks;
    public $callbacks_mngr;

    //On entre les informations lié à la page principal dans le tableau de bord
    public function setPages(){
        $this->pages = [
            [
                'page_title' => 'MRL Plugin',
                'menu_title' => 'MRL CAA',
                'capability' => 'manage_options',
                'menu_slug' => 'mrl_caa_plugin',
                'callback' => [$this->callbacks, 'adminDashboard'],
                'icon_url' => 'dashicons-businessman',
                'position' => 110
            ]
        ];

    }

    public function setSettings(){

            $args = [
                [ 'option_group' => 'mrl_caa_plugin_settings',                  //représente l'id du groupe d'option
                'option_name' => 'mrl_caa_plugin',                              //représente l'id de l'option
                'callback' => [$this->callbacks_mngr, 'checkboxSanitize']
                ]
            ];

            $this->settings->setSettings($args);
    }

    public function setSections(){
        $args = [
            [
                'id' => 'mrl_admin_index',
                'title' => 'Settings Manager',                                  //Titre lié à l'option checkbox
                'callback' => [$this->callbacks_mngr, 'adminSectionManager'],
                'page' => 'mrl_caa_plugin'                                      //Slug de la page dans laquelle les checkbox seront affiché
            ]
            ];

            $this->settings->setSections($args);
    }

    /*On récupère les données de l'array $managers_admin de BaseController.php dont on étend
    Puis on rentre les information nécéssaire à chaque checkbox*/
    public function setFields(){

        $args = [];

        foreach ( $this->managers_admin as $key => $value) {
            $args[] = [
                'id' => $key,
                'title' => $value,
                'callback' => [$this->callbacks_mngr, 'checkboxField'],
                'page' => 'mrl_caa_plugin',
                'section' => 'mrl_admin_index',
                'args' => [
                    [
                        'option_name' => 'mrl_caa_plugin',
                        'label_for' => $key,
                        'class' => 'example-classe'
                    ]
                ]
            ];
        }

            $this->settings->setFields($args);
    }


    public function register(){
        $this->settings = new SettingsApi();

        $this->callbacks = new AdminCallbacks;
        $this->callbacks_mngr = new ManagerCallbacks;

        $this->setPages();

        $this->setSettings();
        $this->setSections();
        $this->setFields();

        $this->settings->addPages( $this->pages )->subPage('Gestion du CAA')->register();
    }
}