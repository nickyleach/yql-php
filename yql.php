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
	 * @return mixed $response
	 * Returns the raw results of the YQL query
	 * Should be delegated to by other methods in child classes
	 */
	public function query((string)$query, (array)$args = array()){
		$queryUrl = self::yqlUrl."?q=" . urlencode(self::encodeQuery($query, $args))."&format=json&env=".urlencode("store://datatables.org/alltableswithkeys");
		
		$json = file_get_contents($queryUrl);
        if ($json !== false){
        	$data = json_decode($json, true);
        	
        	$response = $data['query']['results'];
        	
        	return $response;
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
	function encodeQuery((string)$queryFormat, (array)$args){
		return vsprintf($queryFormat, $args);
	}
}

?>
