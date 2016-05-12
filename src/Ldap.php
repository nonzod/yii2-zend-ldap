<?php
namespace Edvlerblog;

/**
 * YII2 wrapper class for the Zend Ldap Module.
 * Look at https://packagist.org/packages/adldap/adldap for the Adldap Module
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
use Zend\Ldap\Ldap;

class Ldap extends Component
{
    /**
     * The internal Adldap object.
     *
     * @var object Adldap
     */
    private $ZendLdapClass;

    /**
     * Options variable for the Adldap module.
     * See Adldap __construct function for possible values.
     *
     * @var array Array with option values
     */
    public $options = [];

    /**
     * init() called by yii.
     */
    public function init()
    {
//        try {
            $this->ZendLdapClass = new Ldap($this->options);
//        } catch (Exception $e) {
//            throw $e;
//        }
    }

    /**
     * Use magic PHP function __call to route function calls to the Adldap class.
     * Look into the Adldap class for possible functions.
     *
     * @param string $methodName Method name from Adldap class
     * @param array $methodParams Parameters pass to method
     * @return mixed
     */
    public function __call($methodName, $methodParams)
    {
        if (method_exists($this->ZendLdapClass, $methodName)) {
            return call_user_func_array(array($this->ZendLdapClass, $methodName), $methodParams);
        } else {
            return parent::__call($methodName, $methodParams);
        }
    }
}
