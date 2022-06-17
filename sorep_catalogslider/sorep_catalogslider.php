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
 
class Sorep_CatalogSlider extends Module
{
	public function __construct()
	{
		$this->name = 'sorep_catalogslider';
        $this->tab = 'administration';
        $this->version = '1.0.0';
        $this->author = 'HES Inovacao';
        $this->need_instance = 0;
        $this->bootstrap = false;
	 
		parent::__construct();
	 
		$this->displayName = $this->l('Sorep Catalog Slider');
		$this->description = $this->l('Sorep Catalog Slider.');
	 
		$this->confirmUninstall = $this->l('Are you sure you want to uninstall?');
		
		$this->ps_versions_compliancy = [
            'min' => '1.7.5',
            'max' => _PS_VERSION_,
        ];
		
		if (!Configuration::get('SOREPCATALOGSLIDER'))      
		  $this->warning = $this->l('No name provided');
	}
  
	public function install()
	{
		return parent::install() && 
		$this->registerHook('displayHome') &&
		$this->registerHook('header') &&
		$this->registerHook('actionFrontControllerSetMedia') ;;
	}
  
	public function uninstall()
	{
		return parent::uninstall();
	}

	public function hookDisplayHome($params)
    {
        $this->context->smarty->assign([
            'sorep_catalogslider' => Configuration::get('sorep_catalogslider'),
            'sorep_catalogslider' => $this->context->link->getModuleLink('sorep_catalogslider', 'displayHome')
        ]);

        return $this->display(__FILE__, 'slider.tpl');
    }




	public function hookDisplayHeader()
{
  $this->context->controller->addCSS($this->_path.'views/css/sorep_catalogslider.css', 'all');
}
// public function hookActionFrontControllerSetMedia()
//     {
//         $this->context->controller->registerStylesheet(
//             'sorep_catalogslider',
//             $this->_path.'views/css/sorep_catalogslider.css',
//             [
//                 'media' => 'all',
//                 'priority' => 1000,
//             ]
//         );

// 		$this->context->controller->registerJavascript(
//             'sorep_catalogslider-javascript',
//             $this->_path.'views/js/main.js',
//             [
//                 'position' => 'bottom',
//                 'priority' => 1000,
//             ]
//         );
//     }
public function hookHeader ($params)
{
     $this->context->controller->addJS($this->_path.'views/js/main.js');
     $this->context->controller->addCSS($this->_path.'views/css/sorep_catalogslider.css');
}


}
