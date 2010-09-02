<?

require_once('yql.php');

/**
 * yqlGeo class.
 * 
 * @extends yql
 * Geo-specific queries
 */
class yqlGeo extends yql {
	/**
	 * Return place data for string
	 * 
	 * @access public
	 * @param string $string
	 * @return array 
	 * Returns place data based on an input string
	 * e.g. - New York, NY
	 */
	function geocode($string){
		$query = "select * from geo.places where text='%s'";
		
		$response = self::query($query, array($string));
		
		return $response['place'];
	}
	
	/**
	 * Return latitude and longitude for string
	 * 
	 * @access public
	 * @param string $string
	 * @return array ('lat'=>'', 'long'=>'')
	 * Returns latitude and longitude based on an input string
	 * e.g. - New York, NY
	 */
	function latLongByLocationString($string){
		$response = self::geocode($string);
		
		return array('lat'=>$response['centroid']['latitude'],
					 'long'=>$response['centroid']['longitude']);
	}
	
	/**
	 * Return place data for ip address
	 * 
	 * @access public
	 * @param string $ip
	 * @return array
	 * Returns place data based on an ip address
	 */
	function geoIP($ip){
		$query = "select * from ip.location where ip='%s'";
		
		$response = self::query($query, array($ip));
		
		return $response['Response'];
	}
	
	/**
	 * Return latitude and longitude for ip address
	 * 
	 * @access public
	 * @param string $ip
	 * @return array ('lat'=>'', 'long'=>'')
	 * Returns latitude and longitude based on an ip address
	 */
	function latLongByIP($ip){
		$response = self::geoIP($ip);
		
		return array('lat'=>$response['Latitude'],
					 'long'=>$response['Longitude']);

	}
}

?>
