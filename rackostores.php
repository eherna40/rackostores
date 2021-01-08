<?php
/**
* 2007-2019 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author    PrestaShop SA <contact@prestashop.com>
*  @copyright 2007-2019 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

if (!defined('_PS_VERSION_')) {
    exit;
}

class Rackostores extends Module
{
    protected $config_form = false;

    public function __construct()
    {
        $this->name = 'rackostores';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'LabelGrup';
        $this->need_instance = 0;

        /**
         * Set $this->bootstrap to true if your module is compliant with bootstrap (PrestaShop 1.6)
         */
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Racko Stores/Tiendas');
        $this->description = $this->l('Modulo de tiendas para rackosports');

        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);
    }

    /**
     * Don't forget to create update methods if needed:
     * http://doc.prestashop.com/display/PS16/Enabling+the+Auto-Update
     */
    public function install()
    {
        Configuration::updateValue('RACKO_STORES_LIVE_MODE', false);

        return parent::install() &&
            $this->registerHook('header');
    }

    public function uninstall()
    {
        Configuration::deleteByName('RACKO_STORES_LIVE_MODE');

        return parent::uninstall();
    }



    /**
     * Add the CSS & JavaScript files you want to be added on the FO.
     */
    public function hookHeader()
    {
        $this->context->controller->addJS($this->_path.'/views/js/front.js');
        $this->context->controller->addCSS($this->_path.'/views/css/front.css');
    }

    public function hookDisplayFooter()
    {
      $idLang = Context::getContext()->language->id;

      $arreglo_spain = array();
      $arreglo_wordlwide = array();
      $stores = Db::getInstance()->executeS('SELECT DISTINCT a.id_customer , c.email, c.dato_extra1, s.name, c.website
                  FROM ' . _DB_PREFIX_ . 'address a
                  LEFT JOIN ps_customer c ON (c.id_customer = a.id_customer)
                  LEFT JOIN ps_state s ON (a.id_state = s.id_state)
                  WHERE c.active = 1 AND c.dato_extra2 = "1"
                  ORDER BY  s.name, a.city
                  ');


                foreach ($stores as $key => $store) {
  

                $dato_extra = explode(';',$store['dato_extra1']);
                $id_address = Address::getFirstCustomerAddressId($store['id_customer']);
                $address = new Address($id_address);
                $country = Country::getNameById($idLang, (int)$address->id_country);
                $state = State::getNameById((int)$address->id_state);
                $store['name_country'] = $country;
                $store['id_country'] = $address->id_country;
                $store['name'] = $address->alias;
                $store['address1'] = $address->address1;
                $store['city'] = $address->city;
                $store['phone'] = $address->phone;
      $store['phone_mobile'] = $address->phone_mobile;
                $store['note'] = '';
                $store['postcode'] = $address->postcode;
                $store['state'] = $state;
                $store['company'] = $address->company;
                $store['web'] = $store['website'];
                  if($address->id_country == "6"){
                    $arreglo_spain[] = $store;
                  }else{
                    $arreglo_wordlwide[$country][] = $store;
                  }
              
              }


              $store = new Store(7);

              $showroom = array(
                'name' => $store->name[$this->context->language->id],
                'address1' => $store->address1[$this->context->language->id],
                'postcode' => $store->postcode,
                'city' => $store->city,
                'name_country' =>Country::getNameById($idLang, (int)$store->id_country),
                'state' => State::getNameById((int)$store->id_state),
                'note' => $store->note[$this->context->language->id],
                'phone' => $store->phone,
                'email' => $store->email,
                'fax' => $store->fax,
              );



              // usort($arreglo_spain, function($a, $b) { return $a['state'] <=> $b['state']; });

     
      $this->context->smarty->assign(array(
        'stores_spain' => $arreglo_spain,
        'show' => $showroom,'stores_wordwide' => $arreglo_wordlwide, 
        'lang' => $idLang));


      return $this->display(__FILE__, 'views/templates/hook/stores.tpl');
    }

    public function hookRackStores(){

    }

}
