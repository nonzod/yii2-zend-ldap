# Yii2 Zend Ldap wrapper

##Requirements

* Yii2
* LDAP support in PHP

##Usage

The preferred way to install this extension is through [Composer](http://getcomposer.org/ "Composer").

Either run

`php composer.phar require nonzod/yii2-zend-ldap "0.0.6"`

or add

`"nonzod/yii2-zend-ldap": ">=0.0.6"` 

to the require section of your composer.json

Configuration

~~~php
'components' => [
    'ldap' => [
      'class' => 'nonzod\Ldap',
      'config' => [
        'host' => 'localhost',
        'port' => 389,
        'username' => 'CN=admin,DC=example,DC=com',
        'password' => 'SuperSecretPassword',
        'bindRequiresDn' => true,
        'baseDn' => 'OU=People,DC=example,DC=com',
        'accountDomainName' => 'example.com'
      ]
    ],
~~~

##Resources

 * [Source](https://github.com/nonzod/yii2-zend-ldap)
 * [Zend LDAP Documentation](http://framework.zend.com/manual/current/en/modules/zend.ldap.introduction.html)
 * [Zend LDAP Source](https://github.com/zendframework/zend-ldap)

---

*THANKS TO*: ["Matthias Maderer"](http://www.edvler-blog.de) this module is inspired by his project ["edvlerblog/yii2-adldap-module"](https://github.com/edvler/yii2-adldap-module)
