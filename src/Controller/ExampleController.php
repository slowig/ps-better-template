<?php


namespace Company\Module\Controller;

use PrestaShopBundle\Controller\Admin\FrameworkBundleAdminController;

class ExampleController extends BaseContoller
{
    /**
     * Important! Replace 'MODULE' in path with your module name.
     */
    public function indexAction(Request $request)
    {
        return $this->render('@Modules/'.self::MODULE_NAME.'/views/templates/admin/index.html.twig', [
            'appPath' =>  $this->spaConfiguration->getAppPathJs(),
            'chunkVendors' =>  $this->spaConfiguration->getAppChunkVendorsPathJs(),
        ]);
    }
}
