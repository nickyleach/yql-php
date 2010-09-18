<?

require_once('yql.php');

/**
 * yqlData class.
 *
 * @extends yql
 * Data-collection methods
 */
class yqlData extends yql {
	
	/**
	 * Returns HTML for the given url and xpath
	 * 
	 * @access public
	 * @param string $url
	 * @param string $xpath (optional)
	 * @return array 
	 * Returns the the HTML (or partial if xpath is specified) of the url
	 */
	public function scrape($url, $xpath=null){
		$data = yql::query("select * from html where url = '%s' " . ( $xpath ? "and xpath='%s'" : "" ), array($url, $xpath));
		
		return $data['query']['results'];
	}
}

?>