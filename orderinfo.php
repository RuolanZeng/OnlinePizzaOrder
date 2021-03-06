<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Order Info</title>
	<link href="http://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	<link href="http://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="assets/css/htmleaf-demo.css">
	<link href="assets/css/bootstrap.min.css" rel="stylesheet">   
    <link href="assets/css/offcanvas.css" rel="stylesheet">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
	<style type="text/css">
		.box{
			width: 20px;
			height: 20px;
			padding: 2px;
			border:1px solid #ccc;
			border-radius: 2px;
		}
	</style>
	<script type="text/javascript">
		function resetValue(){
			
		}
	</script>

</head>
<body>

	<nav class="navbar navbar-fixed-top navbar-inverse" style="background-color:#ff471a">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php" style="color: #ffffff; font-size:25px;"><i class="fas fa-utensils"></i> Pizza to Go</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <!-- <ul class="nav navbar-nav">
            <li><a href="#">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
          </ul> -->
          <ul id="upright" class="nav navbar-nav navbar-right">
            <li id="upright1" class="dropdown">
              <?php
                session_start();
                if (isset($_SESSION['username'])) {
                  echo "<a href='logout.php' style='color: #ffffff;font-size:16px;'><b>Log out</b></a>";
                }else{
                  echo "<a href='signup.php' style='color: #ffffff;font-size:16px;'><b>Register</b></a>";
                }
              ?>
            </li>
          </ul>
          <ul id="upright" class="nav navbar-nav navbar-right">
            <li id="upright1" class="dropdown">
              <?php
                session_start();
                if (!isset($_SESSION['username'])) {
                  echo "<a href='signin.php' style='color: #ffffff;font-size:16px;'><b>Log In</b></a>";
                }
              ?>
            </li>
          </ul>
          <ul id="upright" class="nav navbar-nav navbar-right">
            <li id="upright1" class="dropdown">
              <?php
                session_start();
                if (isset($_SESSION['username'])) {
                  if (isset($_SESSION['admin'])) {
                    echo "<a href='#' class='dropdown-toggle' data-toggle='dropdown' style='color: #ffffff;font-size:16px;'><b> Admin User: ".$_SESSION['username']."</b><span class='caret'></span></a>";
                    echo "<ul id='drop' class='dropdown-menu'>";
                    echo "<li><a role='menuitem' href='editmenu.php''>EDIT MENU</a></li>";
                    echo "<li><a role='menuitem' href='cart.php''>CART</a></li>";
                    echo "<li><a role='menuitem' href='orderinfo.php''>ORDER INFO</a></li>";
                    echo "</ul>";
                  }else{
                    echo "<a href='#' class='dropdown-toggle' data-toggle='dropdown' style='color: #ffffff;font-size:16px;'><b> Normal User: ".$_SESSION['username']."</b><span class='caret'></span></a>";
                    echo "<ul id='drop' class='dropdown-menu'>";
                    echo "<li><a role='menuitem' href='cart.php'>CART</a></li>";
                    echo "<li><a role='menuitem' href='orderinfo.php'>ORDER INFO</a></li>";
                    echo "</ul>";
                  } 
                }
              ?>
            </li>
          </ul>
        </div><!-- /.nav-collapse -->
      </div><!-- /.container -->
    </nav><!-- /.navbar --><br>

		
		<div class="container">
			<div class="row">
				<div class="col-md-12" style="padding:2em 0;">
					<h1>Order Info</h1>
					<div class="table-responsive">
						<table class="table table-bordered table-striped" id="mytable">
						    <thead>
						      <tr>
								<td>Order Num</td>
								<td>Date</td>
								<td>Total Price</td>
								<td>Detail</td>
							</tr>
						    </thead>
						    <tbody>
						      <?php
								      $con = mysqli_connect("localhost","root","root" , "OnlinePizzaOrder");
								      session_start();
								      $email = $_SESSION['email'];
								      $sql="SELECT DISTINCT O_date, O_price FROM Orders WHERE Email = '$email'";
								      $result = mysqli_query($con,$sql);
								      $i=0;
								      while($row = mysqli_fetch_array($result)){
								      	$i++;
								      	echo "<tr>";
								      	echo "<td>".$i."</td>";
								      	echo "<td>".$row[O_date]."</td>";
								      	echo "<td>".$row[O_price]."</td>";
								      	echo "<td>";
								      	$date = $row[O_date];
								      	$price = $row[O_price];
								      	$sql2 = "SELECT P_Id,P_count FROM Orders WHERE Email = '$email' AND O_date = '$date' AND O_price = '$price'";
								      	$result2 = mysqli_query($con,$sql2);
								      	while($row2 = mysqli_fetch_array($result2)){
								      		$P_id = $row2['P_Id'];
								      		$count = $row2['P_count'];
								      		$sql3 = "SELECT * FROM Products WHERE P_Id = '$P_id'";
								      		$result3 = mysqli_query($con,$sql3);
								      		while($row3 = mysqli_fetch_array($result3)){
								      			echo "<p><img style='max-height:270px;max-width:200px;' src='uploads/".$row3['Image']."'></p>";
								      			echo "<p> Product Name:".$row3['Name']."</p>";
								      			echo "<p> Product Price:".$row3['Price']."</p>";
								      			echo "<p> Product Count:".$count."</p>";
								      		}
								      	}
								  }
								  	
								    echo "</td>";
								    echo "</tr>";
					            ?>
						    </tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		
	
	<script src="http://cdn.bootcss.com/jquery/1.11.0/jquery.min.js" type="text/javascript"></script>
	<script>window.jQuery || document.write('<script src="assets/js/jquery-1.11.0.min.js"><\/script>')</script>
	<script type="text/javascript" src="assets/js/bootstable.js"></script>
	
</body>
</html>