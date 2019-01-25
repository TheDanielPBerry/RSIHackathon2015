<?php


$db = new mysqli('mysql5011.smarterasp.net', 'a118ff_hack15', '***REMOVED***', 'db_a118ff_hack15');

if($db->connect_errno) {
	die('Error.');
}
?>

<html><head>
<title>Apply</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="http://pingendo.github.io/pingendo-bootstrap/themes/default/bootstrap.css" rel="stylesheet" type="text/css">
   

<?php
$complete = isset($_POST["complete"]);
if($complete==true) {
	/*
	if($insert = $db->query("
	INSERT INTO applications (name, email, phone, jobid, created) 
	VALUES ('" . $_POST["name"] . "', '" . $_POST["email"] . "', '" . $_POST["phone"] . "', '" . $_POST["jobid"] . "', NOW())")) {
		*/
		
	if($insert = $db->query("INSERT INTO `applications` (`id`, `name`, `phone`, `email`, `jobid`, `time`) VALUES (NULL, '" . $_POST["name"] . "', '" . $_POST["phone"] . "', '" . $_POST["email"] . "', '" . $_POST["jobid"] . "', CURRENT_TIMESTAMP)")) {
	
	}
}
?>


   </head>
	
	
	<body>
		<?php 
			if($complete) {
				echo "<div style='color:white; background-color:green;'>Application Submitted</div>";
			}			
		?>
        <div class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-ex-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.html"><span>LED Career Services</span></a>
                </div>
                <div class="collapse navbar-collapse" id="navbar-ex-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="active">
                            <a href="index.html">Home</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
		<div class="section">
            <div class="container">
			
			<?php
if($result = $db->query("SELECT * FROM jobs WHERE jobid='" . $_GET["jobid"] . "'") or die($db->error)) {
	if($count = $result->num_rows) {
		$data = array();
		$i=0;
		while($row = mysqli_fetch_array($result)) {
			$data[$i] = $row;
			$i++;
		}
		for($i=0; $i<count($data); $i++) {
			echo "<div class=\"panel panel-default\">";
				echo "<div class=\"panel-body\">";
				  echo "<div class=\"col-md-6\">";
					echo "<h1 class=\"text-primary\">" . $data[$i]['jobtitle'] ."</h1>";
					echo "<h3 class=\"text-primary\">" . $data[$i]['companyname'] . "</h3>";
					echo "<p>" . $data[$i]['description'] . "</p>";
					echo "<p>Job Id: " . $data[$i]['jobid'] . "</p>";
				  echo "</div>";
				echo "</div>";
			  echo "</div>";
		}
	}
}
?>
			</div>
		</div>
		
		
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <p>
                                    <b>
                                        <font size="6">Contact Information</font>
                                    </b>
                                </p>
                            </div>
                        </div>
                        <form role="form" method="POST" action="apply.php?jobid=<?php echo $_GET["jobid"] ?>">
						<input type="hidden" value="true" name="complete" />
						<input type="hidden" value="<?php echo $_GET["jobid"]?>" name="jobid" />
                            <div class="form-group">
                                <label class="control-label" for="exampleInputEmail1">Name</label>
                                <input class="form-control" id="exampleInputEmail1" placeholder="Enter Name" type="text" name="name">
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="exampleInputPhoneNumber">Phone Number</label>
                                <input class="form-control" id="exampleInputPhoneNumber" placeholder="000-000-0000" type="text" name="phone">
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="exampleInputEmail">Email</label>
                                <input class="form-control" id="exampleInputEmail" placeholder="Enter Email" type="email" name="email">
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="exampleInputPassword1">Resume</label>
                                <input type="file" name="uploadfile" accept="text/html">
                            </div>
                            <button type="submit" class="btn btn-default">Apply</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <footer class="section section-primary">
      <div class="container">
        <div class="row">
          <div class="col-sm-6">
            <h1>LED Career Services</h1>
            <p>Website written by the League of Extraordinary Developers
              <br>Members: Jonathan Hoyle, Vivan Bennae, James Fulmer, Daniel Berry
              <br>Hackathon 2015</p>
          </div>
          <div class="col-sm-6">
            <p class="text-info text-right">
              <br>
              <br>
            </p>
            <div class="row">
              <div class="col-md-12 hidden-lg hidden-md hidden-sm text-left">
                <a href="https://instagram.com/uscaiken/"><i class="fa fa-3x fa-fw fa-instagram text-inverse"></i></a>
                <a href="https://twitter.com/USCAiken?ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor"><i class="fa fa-3x fa-fw fa-twitter text-inverse"></i></a>
                <a href="https://www.facebook.com/uscaiken"><i class="fa fa-3x fa-fw fa-facebook text-inverse"></i></a>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 hidden-xs text-right">
                <a href="https://instagram.com/uscaiken/"><i class="fa fa-3x fa-fw fa-instagram text-inverse"></i></a>
                <a href="https://twitter.com/USCAiken?ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor"><i class="fa fa-3x fa-fw fa-twitter text-inverse"></i></a>
                <a href="https://www.facebook.com/uscaiken"><i class="fa fa-3x fa-fw fa-facebook text-inverse"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </footer>
    

</body></html>
