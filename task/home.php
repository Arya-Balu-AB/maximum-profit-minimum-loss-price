<?php 

session_start();
// connect to database
include("db_connect.php");

$sql = "SELECT DISTINCT(stock_name) FROM `stocks_list`";
$all_stocks = mysqli_query($conn,$sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profit/Loss Analyser</title>
    <link href="https://fonts.googleapis.com/css?family=Ek+Mukta:300,400,600|Open+Sans:400,800" rel="stylesheet">
    <!-- https://fonts.google.com/ -->
    <link href="css/bootstrap.min.css" rel="stylesheet" /> <!-- https://getbootstrap.com/ -->
    <link href="css/home/style.css" rel="stylesheet" />
    <!-- <link href="css/style.css" rel="stylesheet" /> -->
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script>

    function information() {

        var s = document.getElementById("stocks").value;
        if(s == 'none'){
            alert("Select stock");  
            return false;  
        }
        var bydate = document.getElementById("from_date").value;
        if(bydate == ''){
            alert("Select Buy Date");  
            return false;  
        }
        var sldate = document.getElementById("to_date").value;
        if(sldate == ''){
            alert("Select Sell Date");  
            return false;  
        }

        var stocks = $('#stocks').val();
        var buydate = $('#from_date').val();
        var selldate = $('#to_date').val();
        $.ajax({
            type: "POST",
            url: "logic.php",
            data: { stocks: stocks, buydate: buydate,  selldate: selldate}
        }).done(function (result) {
            $("#message").html(result);
        });
    }

</script>
</head>
<body>
    <div class="container">
      <div class="main">
      <?php if(isset($_SESSION["status"])){ ?>
            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading">Well done!</h4>
                <p><?php echo $_SESSION["status"] ?></p>
            </div>
        <?php  unset($_SESSION["status"]); } ?>
    <div class="row align-items-start">
    <div class="col-3">
        <select name="stocks" id="stocks" class="chosen-value">
        <option value="none"><?php echo "Select Stock";?></option>
        <?php while ($stocks = mysqli_fetch_array($all_stocks,MYSQLI_ASSOC)):;?>
        <option value="<?php echo $stocks["stock_name"];?>"><?php echo $stocks["stock_name"];?></option>
        <?php endwhile; ?>
        </select>
    </div>
    <div class="col-3 col-md-offset-* text-right">
    <input type="date" id="from_date" name="buydate" value="">
    </div>
    <div class="col-3 col-md-offset-* text-right">
    <input type="date" id="to_date" name="selldate" value="">
    </div>
    <div class="col-3 col-md-offset-* text-right">
    <input type="submit" id="Submit" name="submit" onClick="information()">
    </div>
  </div>
  </br>
  <div class="row align-items-end">
    <div class="col-12 text-center" id="message" class="chosen-value">
    </div>
  </div>
</div>
    </div>
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.backstretch.min.js"></script>
    <script src="js/custom.js"></script>
</body>
</html>