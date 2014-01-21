<?php

class Visono_Sniffs_Legacy_DisallowVariableSniff implements PHP_CodeSniffer_Sniff
{
	/**
	 * Returns an array of tokens this test wants to listen for.
	 *
	 * @return array
	 */
	public function register()
	{
		return array(T_VARIABLE);
	}


	/**
	 * Processes this test, when one of its tokens is encountered.
	 *
	 * @param PHP_CodeSniffer_File $phpcsFile All the tokens found in the document.
	 * @param int                  $stackPtr  The position of the current token in
	 *                                        the stack passed in $tokens.
	 *
	 * @return void
	 */
	public function process(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
	{
		$tokens = $phpcsFile->getTokens();

		$varName = $tokens[$stackPtr];
		$openSqBracket = $phpcsFile->findNext(PHP_CodeSniffer_Tokens::$emptyTokens, ($stackPtr + 1), null, true);

		// disallow $s_mar['customer_id']
		if ($varName['content'] === '$s_mar'
			&& $tokens[$openSqBracket]['code'] === T_OPEN_SQUARE_BRACKET
			&& trim($tokens[$openSqBracket + 1]['content'], "'\"") === 'customer_id') {

			$error = 'Use of $s_mar[\'customer_id\'] is disallowed';
			$phpcsFile->addError($error, $stackPtr, 'DisallowedVariableCustomerId');
		}

		// disallow $conf_
		if (strpos($varName['content'], '$conf_') !== false) {
			$error = 'Use of $conf_ is disallowed';
			$phpcsFile->addError($error, $stackPtr, 'DisallowedVariableConf');
		}
	}
}
