
<?php
require('Database.php');

class DbFunction{
	
	
	function import($data){
		$db = Database::getInstance();
		$mysqli = $db->getConnection();
		$insertRow =[];
      foreach ($data as $key => $val) {
      	if($key == 1){
      		continue;
      	}
			$query = "insert into csvdata(rank,keyword,product_id,productName,category1,category2,category3,category4,category5,price,registerDate,storeName,productLink,storeLink,imageLink)values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
			$stmt= $mysqli->prepare($query);
			if(false===$stmt){
			
				trigger_error("Error in query: " . mysqli_connect_error(),E_USER_ERROR);
			}
			
			else{
				//print_r($val);die;
				$rank = $val['A'] ;
				$keyword = $val['B'] ;
				$product_id = $val['C'] ;
				$productName = $val['D'] ;
				$category1 = $val['E'] ?? '' ;
				$category2 = $val['F'] ?? '';
				$category3 = $val['G'] ?? '';
				$category4 = $val['H'] ?? '';
				$category5 = '' ;
				$price = $val['I'] ;
				$registerDate = $val['J'] ;
				$storeName = $val['K'] ;
				$productLink = $val['L'] ;
				$storeLink = $val['M'] ;
				$imageLink = $val['N'] ;
				$stmt->bind_param('isissssssisssss',$rank,$keyword,$product_id,$productName,$category1,$category2,$category3,$category4,$category5,$price,$registerDate,$storeName,$productLink,$storeLink,$imageLink);
				$stmt->execute();
				
			}
      }
		return 1;
	}

	function getKeyeordProduct(){
		$db = Database::getInstance();
		$mysqli = $db->getConnection();
		$keywords = "SELECT keyword FROM csvdata1 WHERE created_at IN (SELECT max(created_at) FROM csvdata1) group by keyword";
		$stmt= $mysqli->query($keywords);
		$row = $stmt->fetch_all();
		$keyw = [];
		$products= [];
		if(count($row)){
			foreach ($row as $key => $val) {
				$keyw[] = $val[0];
			}
			foreach ($keyw as $key => $values) {
				$keywords = "SELECT rank, keyword, product_id, productName, registerDate, storeName, productLink, storeLink, imageLink FROM csvdata1 WHERE created_at IN (SELECT max(created_at) FROM csvdata1) AND keyword ='".$values."'";
				$stmts= $mysqli->query($keywords);
				$products[$values] = $stmts->fetch_all();
			}
		}
		return $products;
	}

	function rankRatio($rank,$productID,$keyword){
		$db = Database::getInstance();
		$mysqli = $db->getConnection();
		$query = "SELECT rank FROM csvdata1 WHERE created_at < (SELECT max(created_at) FROM csvdata1) AND keyword = '".$keyword."' AND product_id =".$productID." LIMIT 1";
		$stmts= $mysqli->query($query);
		$rankCount = $stmts->fetch_array();
		$rank = $rankCount['rank'];
		return $rank;
	}

	function productGraph($productID){
		$db = Database::getInstance();
		$mysqli = $db->getConnection();
		$query = "SELECT DISTINCT rank , created_at FROM csvdata1 WHERE created_at IN (SELECT max(created_at) FROM csvdata1) AND product_id =".$productID." ORDER BY rank asc";
		$stmts= $mysqli->query($query);
		$rankdata = $stmts->fetch_all();
		return $rankdata;
	}
}

?>



