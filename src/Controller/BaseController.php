<?php

namespace Company\Module\Controller;

use Company\Module\Dto\SpaApplicationConfigurationDto;

class BaseContoller extends FrameworkBundleAdminController {

    const MODULE_NAME = 'MODULE';

    /**
     * @var SpaApplicationConfigurationDto
     */
    protected $spaConfiguration; 

    public function __construct()
    {
        parent::__construct();
        $this->spaConfiguration = $this->initializeSpaApplication();
    }

    protected function initializeSpaApplication()
    {
        return new SpaApplicationConfigurationDto(_PS_BASE_URL_SSL_.__PS_BASE_URI__.'modules/'.self::MODULE_NAME.'/');;
    }
}