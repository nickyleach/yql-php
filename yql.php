<?
/**
 * yql class.
 *
 * Wrapper class for all YQL calls
 */
class yql {
	/**
	 * YQL base url
	 *
	 * Base URL to which all YQL calls are made
	 */
	const yqlUrl = 'http://query.yahooapis.com/v1/public/yql';
	
	/**
	 * Perform a YQL query
	 * 
	 * @access public
	 * @param string $query
	 * @param array $args. (default: array())
	 * @param bool $diagnostics (default: false)
	 * @return mixed $response
	 * Returns the raw results of the YQL query
	 * Should be delegated to by other methods in child classes
	 */
	public function query($query, $args = array(), $diagnostics = false){
		$queryUrl = self::yqlUrl."?q=" . urlencode(self::encodeQuery($query, $args))."&format=json&env=".urlencode("store://datatables.org/alltableswithkeys") . ( $diagnostics ? "&diagnostics=true" : "" );
		
		$ch = curl_init($queryUrl);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$json = curl_exec($ch);
		curl_close($ch);
		
        if ($json !== false){
        	$data = json_decode($json, true);
        	
        	return $data;
        } else {
        	return false;
        }
	}
	
	/**
	 * Generates the query with optional arguments
	 * 
	 * @access public
	 * @param string $queryFormat
	 * @param array $args
	 * @return string
	 * Uses sprintf syntax to generate a query.
	 * Fills in placeholders using values in the $args array
	 */
	function encodeQuery($queryFormat, $args){
		foreach($args as &$arg){
			$arg = addslashes($arg);
		}
		$query = vsprintf($queryFormat, $args);
		
		return $query;
	}
}

?>