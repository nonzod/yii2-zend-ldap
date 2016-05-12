<?php

namespace nonzod;

/**
 * YII2 wrapper class for the Zend Ldap Module.
 * Look at https://packagist.org/packages/adldap/adldap for the zend-ldap Module
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
 */
use yii\base\Component; //include YII component class
use Zend\Ldap\Ldap as ZLdap;
use Zend\Ldap\Exception\LdapException;

class Ldap extends Component {

  /**
   * The internal zend-ldap object.
   *
   * @var object zend-ldap
   */
  private $ZendLdapClass;

  /**
   * Options variable for the zend-ldap module.
   * See zend-ldap __construct function for possible values.
   *
   * @var array Array with option values
   */
  public $config = [];

  /**
   * init() called by yii. $ldap->setOptions($options);
   */
  public function init() {
    try {
      $this->ZendLdapClass = new ZLdap($this->config);
    } catch (LdapException $zle) {
      echo '  ' . $zle->getCode() . ' : ' . $zle->getMessage() . "\n";
    }
  }

  /**
   * Use magic PHP function __call to route function calls to the zend-ldap class.
   * Look into the zend-ldap class for possible functions.
   *
   * @param string $methodName Method name from zend-ldap class
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
