<?php
/**
 * C/C++ code specific extension of the Indent class
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

require_once "CodeGen/Tools/Indent.php";

/**
 * C/C++ code specific extension of the Indent class
 * 
 * So far the only C/C++ specific stuff is that preprocessor commands
 * require the # to be on the first column
 *
 * @category   Tools and Utilities
 * @package    CodeGen
 * @author     Hartmut Holzgraefe <hartmut@php.net>
 * @copyright  2005-2008 Hartmut Holzgraefe
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    Release: @package_version@
 * @link       http://pear.php.net/package/CodeGen
 */
class CodeGen_Tools_IndentC 
  extends CodeGen_Tools_Indent
{
    /**
     * re-indent a block of text
     *
     * with C/C++ we need to make sure that preporcessor
     * directives always start on the first column
     *
     * @access public
     * @param  int    number of leading indent spaces
     * @param  string text to reindent
     * @return string indented text
     */
    function indent($level, $text) 
    {
        $result = parent::indent($level, $text);

        return preg_replace('/^\s+#/m', '#', $result);
    }  
}

/*
 * Local variables:
 * tab-width: 4
 * c-basic-offset: 4
 * indent-tabs-mode:nil
 * End:
 */
