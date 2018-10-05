 <?php
 include_once('ClassStaff.php');
 include_once('common_functions.php');

 class Resource extends Database{

 	private $resID;
	private $resCategory;
	private $resSupplier;
	private $resName;
	private $resVersion;
	private $resQty;
	private $resDesc;
	private $staffID;
	private $resPrice;
	private $dateofp;
	private $resimage;
	private $resStatus;
	private $lostQty;

	function __construct(){
		parent::__construct();
	}

	public function setResource ($res){

		$this->resCategory = $res['resCategory'] ;
		$this->resSupplier = $res['resSupplier'];
		$this->resName = $res['resName'];
		$this->resVersion = $res['resVersion'];
		$this->resQty = $res['resQty'];
		$this->resDesc = $res['resDesc'];
		$this->staffID = $res['staffID'];
		$this->resPrice = $res['resPrice'];
		$this->dateofp = $res['dateofp'];
		// $this->resimage = $res['resimage'];
		$this->resStatus = $res['resStatus'];
		$this->lostQty = $res['lostQty'];

	}

	public function getProperty($propertyName){

		return $this->{$propertyName};
	}


//  }

// class ResourceManager extends Database{

// 	// private $resID;
// 	// private $resCategory;
// 	// private $resName;
// 	// private $resVersion;
// 	// private $resQty;
// 	// private $resDesc;
// 	// private $staffID;
// 	// private $resPrice;
// 	// private $dateofp;
// 	// private $resimage;
// 	// private $resStatus;

// 	function __construct(){
// 		parent::__construct();

// 		// $this->resCategory = $resCategory ;
// 		// $this->resName = $resName;
// 		// $this->resVersion = $resVersion;
// 		// $this->resQty = $resQty;
// 		// $this->resDesc = $resDesc;
// 		// $this->staffID = $staffID;
// 		// $this->resPrice = $resPrice;
// 		// $this->dateofp = $dateofp;
// 		// $this->resimage = $resimage;
// 		// $this->resStatus = $resStatus;
// 	}

// 	public function getProperty($propertyName){

// 		return $this->{$propertyName};
// 	}

	public function resourceAdd(){

	 $resQuery = "INSERT INTO resources (
	   resID,
	   resCategory,
	   resSupplier,
	   resName,
	   resVersion,
	   resQty,
	   resDesc,
	   staffID,
	   resPrice,
	   dateofp,
	   resImage,
	   resStatus 
	   ) VALUES  (
	   NULL, '".
	   $this->getProperty('resCategory')."','".
	   $this->getProperty('resSupplier')."','".
	   $this->getProperty('resName')."','".
	   $this->getProperty('resVersion')."','".
	   $this->getProperty('resQty')."','".
	   $this->getProperty('resDesc')."','".
	   $this->getProperty('staffID')."','".
	   $this->getProperty('resPrice')."','".
	   $this->getProperty('dateofp')."','".
	   $this->getProperty('resimage')."','".
	   $this->getProperty('resStatus')."')";

	   Database::$DB_CONN->query($resQuery);

	}

	public function resourceUpdate($resID){

		$resCategory =$this->getProperty('resCategory');
		$resSupplier =$this->getProperty('resSupplier');
		$resName =$this->getProperty('resName');
		$resVersion=$this->getProperty('resVersion');
		$resQty=$this->getProperty('resQty');
		$resDesc=$this->getProperty('resDesc');
		$staffID=$this->getProperty('staffID');
		$resPrice=$this->getProperty('resPrice');
		$dateofp=$this->getProperty('dateofp');
		$resStatus=$this->getProperty('resStatus');
		$lostQty =$this->getProperty('lostQty');

	 $resQuery = "UPDATE resources
	 			SET resCategory = '".$resCategory."',
	 			resSupplier = '".$resSupplier."',
	 			resName = '".$resName."',
	 			resVersion = '".$resVersion."',
	 			resQty = '".$resQty."',
	 			resDesc = '".$resDesc."',
	 			staffID = '".$staffID."',
	 			resPrice = '".$resPrice."',
	 			dateofp = '".$dateofp."',
	 			resStatus = '".$resStatus."',
	 			lostQty = '".$lostQty."'
	 			WHERE resID = ".$resID;

	   Database::$DB_CONN->query($resQuery);

	   // resImage".$this->getProperty('resimage').",

	}

	public static function getDate($year, $month, $date){

		return $year.'-'.$month.'-'.$date;
	}

	public function loadResource ($resID){


		$this->resID = $resID;
		//Database Query
		$loadResQuery = "SELECT * FROM resources WHERE resID =".$resID;
		$loadResult = Database::$DB_CONN->query($loadResQuery);

		$row = $loadResult->fetch_assoc();

		$this->resCategory = $row['resCategory'] ;
		$this->resSupplier = $row['resSupplier'];
		$this->resName = $row['resName'];
		$this->resVersion = $row['resVersion'];
		$this->resQty = $row['resQty'];
		$this->resDesc = $row['resDesc'];
		$this->staffID = $row['staffID'];
		$this->resPrice = $row['resPrice'];
		$this->dateofp = $row['dateofp'];
		// $this->resimage = $row['resimage'];
		$this->resStatus = $row['resStatus'];
		$this->lostQty = $row['lostQty'];

	}

	public function loadAllResources (){


		
		//Database Query
		$loadResQuery = "SELECT * FROM resources";
		$loadResult = Database::$DB_CONN->query($loadResQuery);

		if ($loadResult->num_rows > 0) {
			$resources = [];
			while($row = $loadResult->fetch_assoc()) {
				array_push($resources, array(

				'resID' => $row['resID'],
				'resCategory' => $row['resCategory'],
				'resSupplier' => $row['resSupplier'],
				'resName' => $row['resName'],
				'resVersion' => $row['resVersion'],
				'resQty' => $row['resQty'],
				'resDesc' => $row['resDesc'],
				'staffID' => $row['staffID'],
				'resPrice' => $row['resPrice'],
				'dateofp' => $row['dateofp'],
				'lostQty' => $row['lostQty'],
				'resStatus' => $row['resStatus'],
			));
			}
		}else{
			return null;
		}

		return $resources;

	}

	public function loadAllResources_Category ($resCategory){


		
		//Database Query
		$loadResQuery = "SELECT * FROM resources WHERE resCategory='".$resCategory."'";
		$loadResult = Database::$DB_CONN->query($loadResQuery);

		if ($loadResult->num_rows > 0) {
			$resources = [];
			while($row = $loadResult->fetch_assoc()) {
				array_push($resources, array(

				'resID' => $row['resID'],
				'resSupplier' => $row['resSupplier'],
				'resName' => $row['resName'],
				'resVersion' => $row['resVersion'],
				'resQty' => $row['resQty'],
				'resDesc' => $row['resDesc'],
				'staffID' => $row['staffID'],
				'resPrice' => $row['resPrice'],
				'dateofp' => $row['dateofp'],
				'lostQty' => $row['lostQty'],
				'resStatus' => $row['resStatus'],
			));
			}
		}else{
			return null;
		}

		return $resources;

	}

	public function loadAllResources_Date ($fromDate, $toDate){


		
		//Database Query
		$loadResQuery = "SELECT * FROM resources WHERE dateofp BETWEEN '".$fromDate."' AND '".$toDate."'
		ORDER by dateofp";
		$loadResult = Database::$DB_CONN->query($loadResQuery);

		if ($loadResult->num_rows > 0) {
			$resources = [];
			while($row = $loadResult->fetch_assoc()) {
				array_push($resources, array(

				'resID' => $row['resID'],
				'resSupplier' => $row['resSupplier'],
				'resName' => $row['resName'],
				'resVersion' => $row['resVersion'],
				'resQty' => $row['resQty'],
				'resDesc' => $row['resDesc'],
				'staffID' => $row['staffID'],
				'resPrice' => $row['resPrice'],
				'dateofp' => $row['dateofp'],
				'lostQty' => $row['lostQty'],
				'resStatus' => $row['resStatus'],
			));
			}
		}else{
			return null;
		}

		return $resources;

	}

	public static function getAllStaff(){

		$allStaffQuery = "SELECT userid, fname, lname FROM users";

		$allStaffResult = Database::$DB_CONN->query($allStaffQuery);

		if ($allStaffResult->num_rows > 0){
			return $allStaffResult;
		}
	}

	public static function getStaff($staffID){
		$StaffQuery = "SELECT fname, lname FROM users WHERE userid =".$staffID;

		$StaffResult = Database::$DB_CONN->query($StaffQuery);

		if ($StaffResult->num_rows > 0){
			return $StaffResult;
		}

	}

	public static function searchResources($search){

		$searchQuery = "SELECT resID, resCategory, resName, resVersion, resQty, staffID, resStatus from resources
			WHERE 
			resID LIKE '%".$search."%' OR
			resSupplier LIKE '%".$search."%' OR
			resCategory LIKE '%".$search."%' OR
			resName LIKE '%".$search."%' OR
			resVersion LIKE '%".$search."%' OR
			resQty LIKE '%".$search."%' OR
			staffID LIKE '%".$search."%' OR
			resStatus LIKE '%".$search."%'";

		$searchResult = Database::$DB_CONN->query($searchQuery);
		// var_dump($searchResult);

		if ($searchResult->num_rows > 0){
			return $searchResult;
		}else{
			return false;
		}
	}

	public static function deleteResources($resID){

		$deleteQuery = "DELETE FROM resources WHERE resID = ".$resID;

		$deleteResult = Database::$DB_CONN->query($deleteQuery);

		set_success_msg('Successfully Deleted.');
	}

	public static function selectLastRow(){

		// $lastrowQuery = "SELECT    resID
		// 				FROM      resources
		// 				ORDER BY  resID DESC
		// 				LIMIT     1";

		// $lastrowResult = Database::$DB_CONN->query($lastrowQuery);

		// if ($lastrowResult->num_rows > 0){
		// 	return $lastrowResult;
		// }

		$lastrowQuery = "SHOW TABLE STATUS LIKE 'resources'";

		$lastrowResult = Database::$DB_CONN->query($lastrowQuery);

		$row = $lastrowResult->fetch_assoc();

		echo $row['Auto_increment'];

	}

	public function getAvailCount($total, $lostQty){

		$remainingCount = $total - $lostQty;
		return $remainingCount;
	}

	function categoryCount($resCategory){

		$categoryCountQuery = "SELECT COUNT(*) FROM resources WHERE resCategory = '".$resCategory."'";
		$categoryCountResult = Database::$DB_CONN->query($categoryCountQuery);

		$row = $categoryCountResult->fetch_assoc();

		return $row['COUNT(*)'];

	}
}
class ResourceManager{

}

	// $resMang = new ResourceManager('Furnitures', 'Chair', 'Wooden', 5, '2ft height', 1234, 12.00, '2018-08-31', 'hhhhhsa.jpg', 1);


	//$resMang->resourceAdd();

	//ResourceManager::getAllStaff();

	// ResourceManager::searchResources('e');

	//ResourceManager::deleteResources(20);

 ?>