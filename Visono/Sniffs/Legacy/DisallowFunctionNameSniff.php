<?php

class Visono_Sniffs_Legacy_DisallowFunctionNameSniff implements PHP_CodeSniffer_Sniff
{
	/**
	 * @var array
	 */
	protected $disallowedFuncPrefix = array(
		'mysql_'
	);

	/**
	 * Returns an array of tokens this test wants to listen for.
	 *
	 * @return array
	 */
	public function register()
	{
		return array(T_STRING);
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

		// Find the next non-empty token.
		$openBracket = $phpcsFile->findNext(PHP_CodeSniffer_Tokens::$emptyTokens, ($stackPtr + 1), null, true);
		if ($tokens[$openBracket]['code'] !== T_OPEN_PARENTHESIS) {
			// not a function call
			return;
		}

		$functionCallName = $tokens[$stackPtr]['content'];
		foreach ($this->disallowedFuncPrefix as $prefix) {
			if (strpos($functionCallName, $prefix) !== false) {
				$error = 'Functions with prefix: "' . $prefix . '" are forbidden';
				$phpcsFile->addError($error, $stackPtr, 'DisallowedFunction');
			}
		}
	}
}
