<?php
/**
 * Abstract base class for all code elements
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
 * Abstract base class for all code elements
 *
 * @category   Tools and Utilities
 * @package    CodeGen
 * @author     Hartmut Holzgraefe <hartmut@php.net>
 * @copyright  2005-2008 Hartmut Holzgraefe
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    Release: @package_version@
 * @link       http://pear.php.net/package/CodeGen
 */
abstract class CodeGen_Element 
{
    /**
     * The function name
     *
     * @var     string
     */
    protected $name  = "unknown";

    /**
     * Name setter
     *
     * @param  string  function name
     * @return bool    success status
     */
    function setName($name) 
    {
        $this->name = $name;
            
        return true;
    }


    /**
     * Name getter
     *
     * @return  string  function name
     */
    function getName() 
    {
        return $this->name;
    }


    /**
     * A short description
     *
     * @var     string
     */
    protected $summary = "";

    /**
     * Summary setter
     *
     * @param  string  function summary
     * @return bool    success status
     */
    function setSummary($text)
    {
        $this->summary = $text;
        return true;
    }




    /**
     * A long description
     *
     * @var     string
     */
    protected $description  = "";

    /**
     * Description setter
     *
     * @param  string  function description
     * @return bool    success status
     */
    function setDescription($text)
    {
        $this->description = $text;
        return true;
    }



    /**
     * Conditional compile condition
     *
     * @var string
     */
    protected $ifCondition = "";
    
    /**
     * ifCondition setter
     *
     * @param string preprocessor #if condition
     */
    function setIfCondition($code)
    {
        $this->ifCondition = trim($code);
    }

    /**
     * ifCondition adder
     *
     * @param string preprocessor #if condition
     */
    function addIfCondition($code)
    {
        $if = trim($this->ifCondition);
        if (strlen($if) == 0) {
          return $this->setIfCondition($code);
        }
        if (($if{0} != '(') && strstr($if, ' ')) {
            $if = "( $if )";
        }

        $code = trim($code);
        if (($code{0} != '(')  && strstr($code, ' ')) {
            $code = "( $code )";
        }

        $this->ifCondition= "$if && $code";
    }

    /**
     * ifCondition getter
     *
     * @return string
     */
    function getIfCondition()
    {
      return $this->ifCondition;
    }
    
    /**
     * Conditional compilation start
     * 
     * @return string
     */
    function ifConditionStart()
    {
        if ($this->ifCondition) {
            return "#if {$this->ifCondition}\n";
        }
        
        return "";
    }
    
    /**
     * Conditional compilation end
     * 
     * @return string
     */
    function ifConditionEnd()
    {
        if ($this->ifCondition) {
            return "#endif /* {$this->ifCondition} */\n";
        }
        
        return "";
    }
    
    

    /**
     * Checks whether a string is a reserved name
     *
     * @access public
     * @param  string name
     * @return bool   true if reserved
     */
    function isKeyword($name) 
    {
        return false;
    }



    /**
     * Checks whether a string is a valid C name
     *
     * @access public
     * @param  string The name to check
     * @return bool   true for valid names, false otherwise
     */
    static function isName($name) 
    {
        if (preg_match('|^[a-z_]\w*$|i', $name)) {
            // TODO reserved words
            return true;
        } 
        return false;
    }

    /**
     * Generate C code for element
     *
     * @access  public
     * @param   string Extension name
     * @return  string C code 
     */
    function cCode($name)
    {
        return ""; 
    }

    /**
     * Generate C code header block for all elements of this class
     *
     * @access public
     * @param  string Extension name
     * @return string C code
     */
    static function cCodeHeader($name) 
    {
        return "";
    }

    /**
     * Generate C code footer block for all elements of this class
     *
     * @access public
     * @param  string Extension name
     * @return string C code
     */
    static function cCodeFooter($name) 
    {
        return "";
    }

    /**
     * Generate C include file definitions for element
     *
     * @access  public
     * @param  class Extension  extension we are owned by
     * @return  string C header code 
     */
    function hCode($extension) 
    {
        return "";
    }

    /**
     * Generate documentation code for element
     *
     * @access  public
     * @param   string id basename for extension
     * @return  string documentation content
     */
    function docEntry($extension)
    {
        return "";
    }

    /**
     * Generate documentation header block for all elements of this class
     *
     * @access public
     * @param  string Extension name
     * @return string documentation fragment
     */
    static function docHeader($name) 
    {
        return "";
    }

    /**
     * Generate documentation footer block for all elements of this class
     *
     * @access public
     * @param  string Extension name
     * @return string documentation fragment
     */
    static function docFooter($name) 
    {
        return "";
    }

}

?>
