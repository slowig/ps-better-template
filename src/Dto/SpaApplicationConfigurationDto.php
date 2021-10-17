<?php


namespace Company\Module\Dto;


final class SpaApplicationConfigurationDto
{
    private $moduleUri;
    private $appPathJs = 'views/js/app.js';
    private $appChunkVendorsPathJs = 'views/js/chunk-vendors.js';

    public function __construct($moduleUri)
    {
        $this->moduleUri = $moduleUri;
    }

    /**
     * @return mixed
     */
    public function getModuleUri()
    {
        return $this->moduleUri;
    }

    /**
     * @return mixed
     */
    public function getAppPathJs()
    {
        return $this->getModuleUri().$this->appPathJs;
    }

    /**
     * @return mixed
     */
    public function getAppChunkVendorsPathJs()
    {
        return $this->getModuleUri().$this->appChunkVendorsPathJs;
    }

}
