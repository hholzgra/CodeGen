<?php
/**
 * Container for groups of elements
 *
 * PHP versions 5
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category   Tools and Utilities
 * @package    CodeGen
 * @author     Hartmut Holzgraefe <hartmut@php.net>
 * @copyright  2005-2008 Hartmut Holzgraefe
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @link       http://pear.php.net/package/CodeGen
 */

/**
 * Container for groups of elements
 *
 * @category   Tools and Utilities
 * @package    CodeGen
 * @author     Hartmut Holzgraefe <hartmut@php.net>
 * @copyright  2005-2008 Hartmut Holzgraefe
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    Release: @package_version@
 * @link       http://pear.php.net/package/CodeGen
 */
class CodeGen_Tools_Group
{
  protected $parent = null;

  protected $attributes = array();

  function setParent(Codegen_Tools_Group $parent)
  {
    $this->parent = $parent;
  }

  function getAttribute($name) 
  {
    if (isset($this->attributes["$name"])) {
      return $this->attributes["$name"];
    } 
    if ($this->parent) {
      return $this->parent->getAttribute($name);
    }
    return false;
  }

  function getAttributeStack($name)
  {
    if ($this->parent) {
      $attrs = $this->parent->getAttributeStack($name);
    } else {
      $attrs = array();
    }
    if (isset($this->attributes["$name"])) {
      $attrs[] = $this->attributes["$name"];
    }   
    return $attrs;
  }

  function setAttribute($name, $value) 
  {
    // TODO disallow overwrites?
    $this->attributes[$name] = $value;
  }

  function setAttributes($attr)
  {
    foreach ($attr as $key => $value) {
      $this->attributes[$key] = $value;
    }
  }
}
