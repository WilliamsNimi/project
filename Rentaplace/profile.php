<!DOCTYPE html>
<?php
	session_start()
?>
<html>
<head>
<title></title><!-- change title dynamically-->
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/bootstrap-select.css">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" type="text/css" href="css/jquery-ui1.css">
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //for-mobile-apps -->
<!--fonts-->
<link href='//fonts.googleapis.com/css?family=Ubuntu+Condensed' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<!--//fonts-->	
<!-- js -->
<script type="text/javascript" src="js/jquery.min.js"></script>
<!-- js -->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-select.js"></script>
<script>
  $(document).ready(function () {
    var mySelect = $('#first-disabled2');

    $('#special').on('click', function () {
      mySelect.find('option:selected').prop('disabled', true);
      mySelect.selectpicker('refresh');
    });

    $('#special2').on('click', function () {
      mySelect.find('option:disabled').prop('disabled', false);
      mySelect.selectpicker('refresh');
    });

    $('#basic2').selectpicker({
      liveSearch: true,
      maxOptions: 1
    });
  });
</script>
<script type="text/javascript" src="js/jquery.leanModal.min.js"></script>
<link href="css/jquery.uls.css" rel="stylesheet"/>
<link href="css/jquery.uls.grid.css" rel="stylesheet"/>
<link href="css/jquery.uls.lcd.css" rel="stylesheet"/>
<!-- Source -->
<script src="js/jquery.uls.data.js"></script>
<script src="js/jquery.uls.data.utils.js"></script>
<script src="js/jquery.uls.lcd.js"></script>
<script src="js/jquery.uls.languagefilter.js"></script>
<script src="js/jquery.uls.regionfilter.js"></script>
<script src="js/jquery.uls.core.js"></script>

    <script src="js/tabs.js"></script>
	
<script type="text/javascript">
$(document).ready(function () {    
var elem=$('#container ul');      
	$('#viewcontrols a').on('click',function(e) {
		if ($(this).hasClass('gridview')) {
			elem.fadeOut(1000, function () {
				$('#container ul').removeClass('list').addClass('grid');
				$('#viewcontrols').removeClass('view-controls-list').addClass('view-controls-grid');
				$('#viewcontrols .gridview').addClass('active');
				$('#viewcontrols .listview').removeClass('active');
				elem.fadeIn(1000);
			});						
		}
		else if($(this).hasClass('listview')) {
			elem.fadeOut(1000, function () {
				$('#container ul').removeClass('grid').addClass('list');
				$('#viewcontrols').removeClass('view-controls-grid').addClass('view-controls-list');
				$('#viewcontrols .gridview').removeClass('active');
				$('#viewcontrols .listview').addClass('active');
				elem.fadeIn(1000);
			});									
		}
	});
});
</script>
</head>
<body>
	<?php include 'includes/sessionHeader.php';?>
	<?php include 'php/db.php'?>
	

	<?php
	$result = mysqli_query($connection, "SELECT id,email,adTitle,adDescription,Photos,MobileNum,Town,date,price from ads");
	while($rows = mysqli_fetch_assoc($result))
	{
		if($rows['email'] == $_SESSION['email'])
		{
				echo"
			<div class='ads-display col-md-9 col-md-offset-1'>
			<div class='wrapper'>					
				<div class='bs-example bs-example-tabs' role='tabpanel' data-example-id='togglable-tabs'>
					<div>
						<div role='tabpanel' class='tab-pane fade in active' id='home' aria-labelledby='home-tab'>
							<div>
								<div id='container'>
									<div class=clearfix'></div>
									<ul class='list'>
										<a href='single.php?single_id=$rows[id]'>
											<li>
												<img src='php/uploads/$rows[Photos]' title='' alt='' />
												<section class='list-left'>
													<h1 class='title'>$rows[adTitle]</h1>
													<p class='title'>$rows[adDescription]
													</p>
													<p><span class='glyphicon glyphicon-earphone'></span>$rows[MobileNum]</p>
													<span class='adprice'>₦ $rows[price]</span>
												</section>
												<section class='list-right'>
													<span class='date'>$rows[date]</span>
													<span class='cityname'>$rows[Town]</span>
												</section>
												<div class='col-md-6'>
													<a class='btn btn-success' href='edit-ad.php?edit_id=$rows[id]'>Edit</a>
													<a class='btn btn-danger' href='profile.php?del_id=$rows[id]'>Delete</a>
												</div>
												<div class='clearfix'></div>
											</li> 
										</a>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>";
		}
	}
	mysqli_close($connection);
	?>
	<?php
	include('php/db.php');
	if(isset($_GET['del_id']))
	{
		$selectQuery = "SELECT Photos FROM ads WHERE id = '$_GET[del_id]'";
		$result = mysqli_query($connection, $selectQuery);
		$rows = mysqli_fetch_assoc($result);
		$imagePath = "php/uploads/".$rows['Photos'];
		$deleteQuery = "DELETE FROM ads WHERE id = '$_GET[del_id]' ";
		if(mysqli_query($connection,$deleteQuery))
		{
			unlink($imagePath);
	?>
			<script> window.location = "profile.php";</script>
	<?php }
	}
	
	?>
	
	
	
<!--footer section start-->		
	<?php include 'includes/footer.php';?>
<!--footer section end-->
</body>
</html>