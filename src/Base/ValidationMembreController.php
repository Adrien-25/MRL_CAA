<?php
/**
 * @package MRLCAA
 */

namespace CAA\Base;

use \CAA\API\SettingsApi;
use \CAA\Base\BaseController;
use \CAA\API\Callbacks\AdminCallbacks;

class ValidationMembreController extends BaseController
{
    public $settings;
    public $callbacks;
    public $subpages = array();

    public $custom_post_types = [];

    public function register()
    {
        
        if ( ! $this->activated( 'caa_validation_membre' ) ) return;

        $this->callbacks = new AdminCallbacks;
        $this->settings = new SettingsApi;
        $this->setSubpages();
        $this->settings->addSubPages($this->subpages)->register();
    }

    public function setSubpages(){
        $this->subpages = [
            [
                'parent_slug' => 'mrl_caa_plugin',
                'page_title' => 'Validation de Membre',
                'menu_title' => 'Validation de Membre',
                'capability' => 'manage_options',
                'menu_slug' => 'caa_validation_membre',
                'callback' => [$this->callbacks, 'adminValidationMembre']
            ]
        ];
    }
}