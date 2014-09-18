<?php
/**
 * Class representing a library dependency
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
 * include
 */
require_once "CodeGen/Element.php";

/**
 * Class representing a library dependencyp
 *
 * @category   Tools and Utilities
 * @package    CodeGen
 * @author     Hartmut Holzgraefe <hartmut@php.net>
 * @copyright  2005-2008 Hartmut Holzgraefe
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    Release: @package_version@
 * @link       http://pear.php.net/package/CodeGen
 */
class CodeGen_Dependency_Lib
    extends CodeGen_Element
{
    /** 
     * library basename
     *
     * @var string
     */
    protected $name;

    /**
     * library searchpath relative to install prefix
     *
     * @var string
     */
    protected $path = "lib";

    /**
     * library platform
     *
     * @var object
     */
    protected $platform;

    /**
     * function to check for
     *
     * @var string
     */
    protected $function = "";

    /**
     * Constructor
     *
     * @param  string  library basename
     * @param  string  platform name
     */
    function __construct($name, $platform = "all")
    {
        // TODO check name
        $this->name = $name;

        $this->platform = new CodeGen_Tools_Platform($platform);
    }

    /**
     * path setter
     *
     * @param string
     */
    function setPath($path) 
    {
        $this->path = $path;
    }

    /**
     * test function setter
     *
     * @param string
     */
    function setFunction($function)
    {
        $this->function = $function;
    }
    
    /**
     *  basename getter
     *
     * @return string
     */
    function getName()
    {
        return $this->name;
    }
    
    /**
     * check for platform 
     *
     * @param  platfrom name
     * @return bool
     */
    function testPlatform($name) 
    {
        return $this->platform->test($name);
    }

    /**
     * write config.m4 code snippet for unix builds
     *
     * @param  string Extension name
     * @param  string --with option name
     * @return string code snippet
     */
    function configm4($extName, $withName)
    {
        if (!$this->platform->test("unix")) {
            return "";
        }

        error_log("WARNING: configm4 used but not implemeted!");
    }

}

?>
