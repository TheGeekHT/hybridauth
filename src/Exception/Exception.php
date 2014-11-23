<?php
/*!
* HybridAuth
* http://hybridauth.sourceforge.net | http://github.com/hybridauth/hybridauth
* (c) 2009-2014, HybridAuth authors | http://hybridauth.sourceforge.net/licenses.html 
*/

namespace Hybridauth\Exception;

/**
 * Hybridauth Base Exception
 */
class Exception extends \Exception implements ExceptionInterface
{
	/**
	* Shamelessly Borrowed from Slimframework
	*
	* @param $object
	*/
	function debug( $object )
	{
		$title   = 'Hybridauth Exception';
		$code    = $this->getCode();
		$message = $this->getMessage ();
		$file    = $this->getFile();
		$line    = $this->getLine();
		$trace   = $this->getTraceAsString ();

		$html  = sprintf ( '<h1>%s</h1>', $title );
		$html .= '<p>HybridAuth has encountered the following error:</p>';
		$html .= '<h2>Details</h2>';

		$html .= sprintf ( '<div><strong>Exception:</strong> %s</div>', get_class( $this ) );

		$html .= sprintf ( '<div><strong>Message:</strong> <font color="#cc0000">%s</font></div>', $message );

		$html .= sprintf ( '<div><strong>File:</strong> %s</div>', $file );

		$html .= sprintf ( '<div><strong>Line:</strong> %s</div>', $line );

		$html .= sprintf ( '<div><strong>Code:</strong> %s</div>', $code );

		$html .= '<h2>Trace</h2>';
		$html .= sprintf ( '<pre>%s</pre>', $trace );

		if ( $object ){
			$html .= '<h2>Debug</h2>';

			ob_start();
			var_dump( $object ); 
			$var_dump = ob_get_clean();

			$html .= sprintf ( '<b>' . get_class( $object ) . '</b> extends <b>' . get_parent_class( $object ) . '</b><pre>%s</pre>', $var_dump );
		}

		$html .= '<h2>Session</h2>';

		ob_start();
		var_dump( $_SESSION ); 
		$var_dump = ob_get_clean();

		$html .= sprintf ( '<pre>%s</pre>', $var_dump );

		echo sprintf ( "<html><head><title>%s</title><style>body{margin:0;padding:30px;font:12px/1.5 Helvetica,Arial,Verdana,sans-serif;}h1{margin:0;font-size:48px;font-weight:normal;line-height:48px;}strong{display:inline-block;width:75px;}</style></head><body>%s</body></html>", $title, $html );
	}
}