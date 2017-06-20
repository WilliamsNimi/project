<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
<title>OpenRoom | edit-ad</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/bootstrap-select.css">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
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

		<link rel="stylesheet" type="text/css" href="css/easy-responsive-tabs.css " />
    <script src="js/easyResponsiveTabs.js"></script>
</head>
<body>
	<?php
		if(isset($_SESSION['email']))
			include 'includes/sessionHeader.php';
		else
			include 'includes/headerbanner.php';
	?>
		<?php 
			include'php/db.php';
			if(isset($_GET['edit_id']))
			{
				$editQuery = "SELECT * FROM ads WHERE id = '$_GET[edit_id]' ";
				$run = mysqli_query($connection,$editQuery);
				while($rows = mysqli_fetch_assoc($run)){
					$name = $rows['name'];
					$adTitle = $rows['adTitle'];
					$mobileNum = $rows['MobileNum'];
					$price = $rows['price'];
					$id = $rows['id'];
				}
			}
		?>
		
	<!-- Submit Ad -->
	<div class="submit-ad main-grid-border">
		<div class="container post-ad-form col-md-12 col-md-offset-3">
			<h2 class="head">Edit Ad</h2>
			<form id="upload" method="POST" enctype="multipart/form-data" action="php/edit-ad.php">
				<input type="hidden" value="<?php echo $id; ?>" name="id">
				<label>Your Name <span>*</span></label>
				<input type="text" class="name" placeholder="" required="" name="name" value="<?php echo $name; ?>">
				<div class="clearfix"></div>
				<label>Your Mobile No <span>*</span></label>
				<input type="text" class="phone" placeholder="" required="" name="mobileNum" value="<?php echo $mobileNum; ?>">
				<div class="clearfix"></div>
				<label>Select Category <span>*</span></label>
				<select class="" name="category">
				  <option value="RealEstate">Real Estate</option>
				</select>
				<div class="clearfix"></div>
				<label>Ad Title <span>*</span></label>
				<input type="text" class="phone" placeholder="" required="" name="title" value="<?php echo $adTitle; ?>">
				<div class="clearfix"></div>
				<label>Ad Description <span>*</span></label>
				<textarea class="mess" placeholder="Write few lines about your product" required="" name="description"></textarea>
				<div class="clearfix"></div>
				<div class="upload-ad-photos">
				<label>Photos for your ad :</label>	
				<div class="photos-upload-view">
					<input type="file" id="fileselect" name="fileselect" multiple="multiple" />

					<div id="messages">
					<p>Status Messages</p>
					</div>
				</div>
				<label>Price<span>*</span></label>
				<input type="text" class="phone" placeholder="" required="" name="price" value="<?php echo $price; ?>">
				<div class="clearfix"></div>
				<label>Select Location <span>*</span></label>
				<select class="" name="location">
				  <option value="Alakahia">Alakahia</option>
				  <option value="Aluu">Aluu</option>
				  <option value="Choba">Choba</option>
				</select>
					<div class="clearfix"></div>
						<script src="js/filedrag.js"></script>
						<p class="post-terms">By clicking <strong>post Button</strong> you accept our <a href="terms.php" target="_blank">Terms of Use </a> and <a href="privacy.php" target="_blank">Privacy Policy</a></p>
						<input type="submit" value="Update">
					<div>
						<p id="errorMessage">
							<?php 
								if(!empty($_SESSION['errorMessage'])) {echo $_SESSION['errorMessage'];}
									unset($_SESSION['errorMessage']);		
							?>
						<p>
					</div>
				</div>
			</form>
		</div>
	</div>
	<!-- // Submit Ad -->
	<!--footer section start-->		
		<?php include 'includes/footer.php';?>
        <!--footer section end-->
		
		
		<script type="text/javascript" src="js/script.js"></script>
		
</body>
</html>