<?php
/**
 * A class that describes an extension author or maintainer
 *
 * PHP versions 5
 *
 * LICENSE: This source file is subject to version 3.0 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_0.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category   Tools and Utilities
 * @package    CodeGen
 * @author     Hartmut Holzgraefe <hartmut@php.net>
 * @copyright  2005 Hartmut Holzgraefe
 * @license    http://www.php.net/license/3_0.txt  PHP License 3.0
 * @version    CVS: $Id$
 * @link       http://pear.php.net/package/CodeGen
 */

/**
 * A class that describes an extension author or maintainer
 *
 * This class wraps up the functionality needed for the 
 * command line script. 
 *
 * @category   Tools and Utilities
 * @package    CodeGen
 * @author     Hartmut Holzgraefe <hartmut@php.net>
 * @copyright  2005 Hartmut Holzgraefe
 * @license    http://www.php.net/license/3_0.txt  PHP License 3.0
 * @version    Release: @package_version@
 * @link       http://pear.php.net/package/CodeGen
 */
class CodeGen_Maintainer 
{
    /**
     * Users system account name
     *
     * @var string
     */
    var $user;

    /**
     * Real name
     *
     * @var string
     */
    var $name;

    /**
     * Email address
     *
     * @var string
     */
    var $email;

    /**
     * Role in this project
     *
     * @var string
     */
     var $role;
     
    /**
     * First maintainer added?
     *
     * @var bool
     */
     static $first = true;

    /**
     * Prefix to use in comment headers
     *
     * @var bool
     */
    var  $comment_prefix = "Authors:";

    /**
     * Constructor
     *
     * @access public
     * @param  string  CVS user name
     * @param  string  real name
     * @param  string  email address
     * @param  string  role in this project
     */
     function __construct($user="unknown", $name="Anonymous Coward", $email="unknown", $role="unknown")
     {
       $this->user  = $user;
         $this->name  = $name;
         $this->email = $email;
         $this->role  = $role;

         if (self::$first) {
             self::$first = false;
         } else {
             $this->comment_prefix = "        ";
         }
     }

     /**
      * Set CVS user name
      *
      * @access public
      * @param  string CVS user name
      * @return bool   true on success
      */
     function setUser($name) 
     {
         if (!ereg("^[[:alnum:]_-]+$", $name)) {
             return PEAR::raiseError("'$name' is not a valid CVS user name");
         }

         $this->user = $name;
         return true;
     }

     /**
      * Set real user name
      *
      * @access public
      * @param  string user name
      * @return bool   true on success
      */
     function setName($name) 
     {
         $this->name = $name;
         return true;
     }

     /**
      * Set email address
      *
      * @access public
      * @param  string email address
      * @return bool   true on success
      */
     function setEmail($email) 
     {
         // TODO check for valid address

         $this->email = $email;
         return true;
     }

     /**
      * Set project role
      *
      * @access public
      * @param  string project role
      * @return bool   true on success
      */
     function setRole($role) 
     {
         // TODO check for valid roles

         $this->role = $role;
         return true;
     }

     /**
      * Generate a comment header line for this author
      *
      * @access public
      * @return string comment line 
      */
     function comment()
     {
         $code = sprintf("   | {$this->comment_prefix} %-59s |\n", "{$this->name} <{$this->email}>");
         $prefix = "        ";

         return $code;
     }

}
/*
 * Local variables:
 * tab-width: 4
 * c-basic-offset: 4
 * indent-tabs-mode:nil
 * End:
 */

?>