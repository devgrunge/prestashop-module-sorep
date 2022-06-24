<?php
/**
 * Copyright since 2007 PrestaShop SA and Contributors
 * PrestaShop is an International Registered Trademark & Property of PrestaShop SA
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License version 3.0
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * @author    PrestaShop SA and Contributors <contact@prestashop.com>
 * @copyright Since 2007 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License version 3.0
 */


if (!defined('_PS_VERSION_'))
  exit;
 
class Sorep_OverlayMenu extends Module
{
	public function __construct()
	{
		$this->name = 'sorep_overlaymenu';
        $this->tab = 'administration';
        $this->version = '1.0.0';
        $this->author = 'HES Inovacao';
        $this->need_instance = 0;
        $this->bootstrap = false;
	 
		parent::__construct();
	 
		$this->displayName = $this->l('Sorep Overlay Menu');
		$this->description = $this->l('Products menu wich overlays when hovered');
	 
		$this->confirmUninstall = $this->l('Are you sure you want to uninstall?');
		
		$this->ps_versions_compliancy = [
            'min' => '1.7.5',
            'max' => _PS_VERSION_,
        ];
		
		if (!Configuration::get('SOREPOVERLAYMENU'))      
		  $this->warning = $this->l('No name provided');
	}
  
	public function install()
	{

          // Legacy BO Controller does not use namespaces
          include_once dirname(__FILE__).'/controllers/admin/adminsorep_overlaymenuController.php';

        if (Shop::isFeatureActive()) {
            Shop::setContext(Shop::CONTEXT_ALL);
        }



		return parent::install() && 
		$this->registerHook('header') &&
        $this->registerHook('displayTop') &&
        $this->registerHook('top') &&
		$this->registerHook('actionFrontControllerSetMedia') ;;
	}
  
	public function uninstall()
	{
		return parent::uninstall();
	}

	public function hookTop($params)
    {
        $sql = " select * from `"._DB_PREFIX_."product` order by date_add desc limit 8";
        $products = Db::getInstance()->executeS($sql);
        $this->context->smarty->assign([
            'sorep_overlaymenu' => Configuration::get('sorep_overlaymenu'),
            'sorep_overlaymenu' => $this->context->link->getModuleLink('sorep_overlaymenu', 'top')
        ]);
        
        $accessory_products=array();
        foreach($products as $product){

            $p = new Product($product["id_product"]);
            $id_image = Product::getCover($product["id_product"]);
            
            if (sizeof($id_image) > 0) {
                $image = new Image($id_image['id_image']);
                $image_url = _PS_BASE_URL_._THEME_PROD_DIR_.$image->getExistingImgPath().".jpg";
                $arraytest[] = $image_url;
            }
            $p->images=$arraytest;
            $accessory_products[]=$p;
        }

        $this->smarty->assign('accessory_data', $accessory_products);

        $this->_html .= $this->display(__FILE__, 'overlaymenu.tpl');
        return $this->_html;
    }




	public function hookDisplayHeader()
{
  $this->context->controller->addCSS($this->_path.'views/css/sorep_overlaymenu.css', 'all');
}
public function hookActionFrontControllerSetMedia()
    {
        $this->context->controller->registerStylesheet(
            'sorep_overlaymenu',
            $this->_path.'views/css/sorep_overlaymenu.css',
            [
                'media' => 'all',
                'priority' => 1000,
            ]
        );

		$this->context->controller->registerJavascript(
            'sorep_overlaymenu-javascript',
            $this->_path.'views/js/default.js',
            [
                'position' => 'bottom',
                'priority' => 1000,
            ]
        );
    }
public function hookHeader ($params)
{
     $this->context->controller->addJS($this->_path.'views/js/main.js');
     $this->context->controller->addCSS($this->_path.'views/css/sorep_overlaymenu.css');
}



}
