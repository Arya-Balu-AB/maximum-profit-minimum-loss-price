<?php 
// connect to database
include("db_connect.php");

	//Stock Buy Sell calculation
	function stockbuysell($price,$n,$date){
		if($n == 1)
		return;
		
		$i = 0;
		$maxprofit = 0;
		$counter = 0;
		$mean_stock_price = 0;

		while($i < $n-1){
		while (($i < $n - 1) && ($price[$i + 1] <= $price[$i]))
		$i++;
		if ($i == $n - 1)
		break;
		$buy = $i++;
		while (($i < $n) && ($price[$i] >= $price[$i - 1]))
		$i++;
		$sell = $i - 1;

		$buyDate = date('d-m-Y',strtotime($date[$buy]));
		$sellDate = date('d-m-Y',strtotime($date[$sell]));
		
		$mp = $price[$sell] - $price[$buy];
		$msp = array($mp);
		$maxprofit += $msp[0];
		$counter = $counter + 1;
		$mean_stock_price = $maxprofit/$counter;

		echo "Buy at : '".$buyDate."' and Sell at :'".$sellDate."' and profit :'".$mp."'<br>";
		}

		$variance = 0.0;
		$average = array_sum($price)/$n;
		foreach($price as $i)
		{
			$variance += pow(($i - $average), 2);
		}
		$standard_deviation = (float)sqrt($variance/$n);

		echo "<hr>";
		echo "Maximum profit is: ".$maxprofit;
		echo "<hr>";
		echo "Maximum profit made by joe(200 shares):".$maxprofit*200;
		echo "<hr>";
		echo "Mean Stock Price is: ".$mean_stock_price;
		echo "<hr>";
		echo "Standard Deviation of the Stock Prices is: ".$standard_deviation;
	}
	
	$stock = mysqli_real_escape_string($conn,$_POST['stocks']);
	$buydate = mysqli_real_escape_string($conn,$_POST['buydate']); 
	$selldate = mysqli_real_escape_string($conn,$_POST['selldate']); 

	$sql_date_select = "SELECT date FROM `stocks_list` WHERE date ='".$buydate."' AND stock_name = '".$stock."'";
	$date_select_query = mysqli_query($conn,$sql_date_select);

	$empty_date = ''; 
	while($row = mysqli_fetch_array($date_select_query)){
		$empty_date = $row['date'];
	}
	
	if($empty_date == '')
	{
		$prev_date = "SELECT DATE_SUB('".$buydate."', INTERVAL 1 DAY) AS previous_date";
		$prev_date_query = mysqli_query($conn,$prev_date);

		$previous_date = '';
		while($row = mysqli_fetch_array($prev_date_query)) {
			$previous_date = $row['previous_date'];
		}
		$sql_select = "SELECT date,price FROM `stocks_list` WHERE stock_name ='".$stock."' AND date BETWEEN '".$previous_date."' AND '".$selldate."'";
	}else{
		$sql_select = "SELECT date,price FROM `stocks_list` WHERE stock_name ='".$stock."' AND date BETWEEN '".$buydate."' AND '".$selldate."'";
	}
	$query = mysqli_query($conn,$sql_select);
	
	$prices_data = [];
	$dates_data = [];
	
	while($row = mysqli_fetch_assoc($query)){

		$prices_data[] = $row['price'];
		$dates_data[] = $row['date'];
	}
	
	if($prices_data && $dates_data){

		$price = $prices_data;
		$date = $dates_data;
		$n = sizeof($price);
		echo stockbuysell($price,$n,$date);
	}else{
		echo "There is No data on this Stock :'".$stock."' on this \n Buy Date :'".date('d-m-Y',strtotime($buydate))."' AND Sell Date : '".date('d-m-Y',strtotime($selldate))."'";
	}
?>
