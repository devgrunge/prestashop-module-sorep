<?php
/**
 * <ModuleClassName> => Cheque
 * <FileName> => validation.php
 * Format expected: <ModuleClassName><FileName>ModuleFrontController
 */
class SorepCatalogSliderFrontController extends ModuleFrontController
{ 
    public function initContent()
{
  
  $this->setTemplate('module:sorep_overlaymenu/views/templates/front/overlaymenu.tpl');
}

}