<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Test App</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>



</head>
<body class="bg-dark">

  <div class="container">
     <form action="getdetails.php" method="GET">
        <div style="margin:0 auto;" class="jumbotron ml-5 mt-5 mr-3">
				<h2  style="color:#e91e63;" class=" pb-4 border-bottom ">Welcome to the <span > "MesDépanneurs.fr"  </span> Test App </h2>
          <div  class="form-group">
				    <label for="zip" class="pt-3 text-primary"> Enter ZIP/PIN Code:</label>
				      <input  maxlength="5" class="form-control col-md-3 col-lg-3 col-sm-3 col-xs-3" type="text" id="zip" name="zip" required>
			         	<small id="emailHelp" class="form-text text-muted p-1"> * please enter a vaild code postal..</small>
	        </div>
          <div class="form-group ">
	 			   <input type="submit" class="btn btn-success col-md-2" value="Submit">
	      </div>
      </div>
    </form>
  </div>
	</body>
</html>
