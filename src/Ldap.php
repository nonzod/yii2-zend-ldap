<?php

namespace nonzod;

/**
 * YII2 wrapper class for the Zend Ldap Module.
 * Look at http://framework.zend.com/manual/current/en/modules/zend.ldap.api.html
 * for the zend-ldap Module
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 * 
 * THANKS TO "Matthias Maderer" this extension is inspired by his project 
 * "edvlerblog/yii2-adldap-module" 
 * 
 * @see https://github.com/edvler/yii2-adldap-module
 */
use yii\base\Component; //include YII component class
use Zend\Ldap\Ldap as ZLdap;
use Zend\Ldap\Exception\LdapException;

class Ldap extends Component {

  /**
   * The internal zend-ldap object.
   *
   * @var object Zend\Ldap\Ldap
   */
  private $ZendLdapClass;

  /**
   * Options variable for the zend-ldap module.
   * See Zend\Ldap\Ldap __construct function for possible values.
   *
   * @var array Array with config values
   */
  public $config = [];

  /**
   * init() called by yii.
   */
  public function init() {
    try {
      $this->ZendLdapClass = new ZLdap($this->config);
    } catch (LdapException $zle) {
      echo '  ' . $zle->getCode() . ' : ' . $zle->getMessage() . "\n";
    }
  }

  /**
   * Use magic PHP function __call to route function calls to the Zend\Ldap\Ldap class.
   * Look into the Zend\Ldap\Ldap class for possible functions.
   *
   * @param string $methodName Method name from Zend\Ldap\Ldap class
   * @param array $methodParams Parameters pass to method
   * @return mixed
   */
  public function __call($methodName, $methodParams) {
    if (method_exists($this->ZendLdapClass, $methodName)) {
      return call_user_func_array(array($this->ZendLdapClass, $methodName), $methodParams);
    } else {
      return parent::__call($methodName, $methodParams);
    }
  }

}
