<?php
/**
 * Wrapper class for whitespace related stuff
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
 * Wrapper class for whitespace related stuff
 *
 * all methods are actually static, the class is just needed for
 * namespace emulation to conform with PEAR naming conventions
 *
 * @category   Tools and Utilities
 * @package    CodeGen
 * @author     Hartmut Holzgraefe <hartmut@php.net>
 * @copyright  2005 Hartmut Holzgraefe
 * @license    http://www.php.net/license/3_0.txt  PHP License 3.0
 * @version    Release: @package_version@
 * @link       http://pear.php.net/package/CodeGen
 */
class CodeGen_Tools_Indent {
    /**
     * Replace leading blanks with tabs
     *
     * PHP C coding conventions require tab indention 
     * with a tabsize of 4
     *
     * @access public
     * @param  string text to tabify
     * @param  int    tab indention level (default: 4 spaces)
     * @return string tabified text
     */
    function tabify($text, $tabsize = 4) 
    {
        return preg_replace_callback("/^(".str_repeat(" ", $tabsize).")+/m", 
            create_function('$matches','return str_repeat("\t", strlen($matches[0])/'.$tabsize.');'), 
            $text
        );
    }


    /**
     * Replace leading tabs with blanks
     *
     * PEAR PHP coding conventions require blank indention 
     * with a tabsize of 4
     *
     * @access public
     * @param  string text to untabify
     * @param  int    tab indention level (default: 4 spaces)
     * @return string untabified text
     */
    function untabify($text, $tabsize = 4) 
    {
        return preg_replace_callback("/^(\t)*/m", 
            create_function('$matches','return str_repeat(" ", strlen($matches[0])*'.$tabsize.');'), 
            $text
        );
    }

    /**
     * re-indent a block of text
     *
     * @access public
     * @param  int    number of leading indent spaces
     * @param  string text to reindent
     * @return string indented text
     */
    function indent($level, $text) 
    {
        $lines = explode("\n", $text);

        while (count($lines) && trim(end($lines)) == "") {
            array_pop($lines);
        }

        $maxindent = 999;
        foreach ($lines as $line) {
            if (trim($line)=="") continue;
            ereg("^ *", $line, $matches);
            $maxindent = min($maxindent, strlen($matches[0]));
        }

        $result = "";
        $find = str_repeat(" ", $maxindent);
        $replace = str_repeat(" ", $level);
        foreach ($lines as $line) {
            $result.= self::tabify(ereg_replace("^$find", $replace, $line)."\n", 4);
        }
        
        return self::linetrim($result);
    }


    /**
     * Trim of leading and trailing whitespace-only lines
     *
     * @access public
     * @param  string  text
     * @return string  trimmed text
     */
    function linetrim($text)
    {
        $text = preg_replace('|^\s*\n|','', $text);
        $text = preg_replace('|\n\s*$|',"\n", $text);
        return $text;
    }

    /**
     * Change to DOS/Windows line terminators
     *
     * @access public
     * @param  string unix text
     * @param  string dos/windows text
     */
    function dosify($text) {
        return str_replace("\n", "\r\n", $text);
    }
}

?>