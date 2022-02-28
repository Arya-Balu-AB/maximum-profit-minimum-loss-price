<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profit/Loss Analyser</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400" rel="stylesheet" />
    <!-- https://fonts.google.com/ -->
    <link href="css/bootstrap.min.css" rel="stylesheet" /> <!-- https://getbootstrap.com/ -->
    <link href="fontawesome/css/all.min.css" rel="stylesheet" /> <!-- https://fontawesome.com/ -->
    <link href="css/style.css" rel="stylesheet" />
</head>
<body>
    <div class="tm-container">
        <div>
            
        <?php if(isset($_SESSION["status"])){ ?>
            <div class="alert alert-danger" role="alert">
                <h4 class="alert-heading">Something went wrong</h4>
                <p><?php echo $_SESSION["status"] ?></p>
            </div>
        <?php  unset($_SESSION["status"]); } ?>
            <div class="main">
            <section class="tm-content">
                <form enctype="multipart/form-data" method="POST" action="import_csv.php" >
                <h1 style="text-align:center">Stocks List</h1>
                    <div class="dotted">
                        <input type="file" name="file" id="file" accept=".csv">
                        <input type="submit" class="btn btn-primary" id="submit" name="import">
                    </div>
                </form>
            </section>
            </div>
        </div>
        <div class="tm-bg">
            <div class="tm-bg-right"></div>
            <div class="tm-bg-right"></div>
        </div>
    </div>

    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.backstretch.min.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>