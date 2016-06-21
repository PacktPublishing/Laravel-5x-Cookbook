<?php

namespace App;

use Michelf\MarkdownExtra;

class MarkdownExtraParser extends MarkdownExtra {


	public $code_attr_on_pre = true;

	function _doFencedCodeBlocks_callback($matches) {

		$classname =& $matches[2];
		$attrs     =& $matches[3];
		$codeblock = $matches[4];

		if ($this->code_block_content_func) {
			$codeblock = call_user_func($this->code_block_content_func, $codeblock, $classname);
		} else {
			$codeblock = htmlspecialchars($codeblock, ENT_NOQUOTES);
		}

		$codeblock = preg_replace_callback('/^\n+/',
			array($this, '_doFencedCodeBlocks_newlines'), $codeblock);

		$classes = array();
		if ($classname != "") {
			if ($classname{0} == '.')
				$classname = substr($classname, 1);
			$classes[] = $this->code_class_prefix.$classname;
		}
		$attr_str = $this->doExtraAttributes($this->code_attr_on_pre ? "pre" : "code", $attrs, null, ['prettyprint', 'linenums']);
		$pre_attr_str  = $this->code_attr_on_pre ? $attr_str : '';
		$code_attr_str = $this->code_attr_on_pre ? '' : $attr_str;
		$codeblock  = "<pre$pre_attr_str><code$code_attr_str>$codeblock</code></pre>";

		return "\n\n".$this->hashBlock($codeblock)."\n\n";
	}



}

?>