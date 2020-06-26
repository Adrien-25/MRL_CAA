<?php
/**
 * @package MRLCAA
 */

namespace CAA\Base;

use \CAA\API\SettingsApi;
use \CAA\Base\BaseController;
use \CAA\API\Callbacks\AdminCallbacks;

class ActualitesEvenementsController extends BaseController
{
    public $settings;
    public $callbacks;
    public $subpages = array();

    public $custom_post_types = [];

    public function register()
    {
        
        if ( ! $this->activated( 'caa_actualites' ) ) return;

        $this->callbacks = new AdminCallbacks;
        $this->settings = new SettingsApi;
        $this->setSubpages();
        $this->settings->addSubPages($this->subpages)->register();
    }

    public function setSubpages(){
        $this->subpages = [
            [
                'parent_slug' => 'mrl_caa_plugin',
                'page_title' => 'Actualités / Événements',
                'menu_title' => 'Actualités / Événements',
                'capability' => 'manage_options',
                'menu_slug' => 'caa_actualites',
                'callback' => [$this->callbacks, 'adminActualitesEvenements']
            ]
        ];
    }
}