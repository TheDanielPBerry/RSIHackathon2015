<?php

$db = new mysqli('mysql5011.smarterasp.net', 'a118ff_hack15', '***REMOVED***', 'db_a118ff_hack15');
$dataCount=0;

if($db->connect_errno) {
	die('Error');
}
?>
<html><head>
<title>Search Results</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://pingendo.github.io/pingendo-bootstrap/themes/default/bootstrap.css" rel="stylesheet" type="text/css">
  </head><body>
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
	<!---
    <div class="section">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="jumbotron">
              <h1>LED Career Services</h1>
            </div>
          </div>
        </div>
      </div>
    </div>
	--->
    <div class="section">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <form role="form" action="results.php" method="GET">
              <div class="form-group">
				<?php 
					if($_GET["tag"]=="jobtitle") {
						echo "<h4>Job Title</h4>";
					}
					if($_GET["tag"]=="companyname") {
						echo "<h4>Company: </h4>";
					}
					if($_GET["tag"]=="location") {
						echo "<h4>Location: </h4>";
					}
					if($_GET["tag"]=="description") {
						echo "<h4>Keyword: </h4>";
					}
					if($_GET["tag"]=="jobid") {
						echo "<h4>Job Id: </h4>";
					}
					echo "<br/>";
					
				?>
                <input class="form-control" id="exampleInputEmail1" name="q" value="<?php echo $_GET["q"] ?>" type="text" />
				<input type="hidden" name="tag" value="<?php echo $_GET["tag"] ?>" />
				<input type="hidden" name="order" value="<?php echo $_GET["order"] ?>" />
				<input type="hidden" name="p" value="0" />
              </div>
              <button type="submit" class="btn btn-default">Search</button>
              <a class="btn btn-default" href="index.html">New Search</a>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="section">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <p class="text-">Sort by:
			<form action="results.php" method="GET">
			<input type="hidden" value="<?php echo $_GET["tag"] ?>" name="tag" />
			<input type="hidden" value="<?php echo $_GET["q"] ?>" name="q" />
			<input type="hidden" name="p" value="0" />
              <select size="1" name="order" id="crit">
                <option value="jobTitle" selected="">Job Title</option>
                <option value="companyName">Company</option>
                <option value="location">Location</option>
              </select>
			  <input type="submit" value="Sort"/>
			  </form>
            </p>
          </div>
        </div>
      </div>
    </div>
	
    <div class="section">
      <div class="container">
        <div class="row">
          <div class="panel-group" id="collapse1">
		  
		  
		  
<?php
$page = $_GET["p"];
if($result = $db->query("SELECT * FROM jobs WHERE " . $_GET["tag"] . " LIKE '%" . $_GET["q"] . "%' ORDER BY " . $_GET["order"]) or die($db->error)) {
	if($count = $result->num_rows) {
		$data = array();
		$i=0;
		while($row = mysqli_fetch_array($result)) {
			$data[$i] = $row;
			$i++;
		}
		$dataCount=count($data);
		for($i=$page; ($i<$dataCount) && $i<(10 + $page); $i++) {
			echo "<div class=\"panel panel-default\">";
			  echo "<div class=\"panel-heading\">";
				echo "<a class=\"panel-title collapsed\" data-toggle=\"collapse\" data-parent=\"#collapse" . $i . "\" href=\"#collapsable" . $i . "\">" . $data[$i]['jobtitle'] . " - " . $data[$i]['location'] . "</a>";
			  echo "</div>";
			  echo "<div class=\"panel-collapse collapse\" id=\"collapsable" . $i . "\">";
				echo "<div class=\"panel-body\">";
				  echo "<div class=\"col-md-6\">";
					echo "<!-- 16:9 aspect ratio -->";
					echo "<div class=\"embed-responsive embed-responsive-16by9\">";
					  echo "<img class=\"embed-responsive-item\" src=\"images/magnify.jpg\" width=\"450\" height=\"450\" />";
					echo "</div>";
				  echo "</div>";
				  echo "<div class=\"col-md-6\">";
					echo "<h1 class=\"text-primary\">" . $data[$i]['jobtitle'] ."</h1>";
					echo "<h3 class=\"text-primary\">" . $data[$i]['companyname'] . "</h3>";
					echo "<p>" . $data[$i]['description'] . "</p>";
					echo "<a class=\"btn btn-default\" href=\"apply.php?jobid=" . $data[$i]['jobid'] . "\">Apply</a>";
				  echo "</div>";
				echo "</div>";
			  echo "</div>";
			  echo "</div>";
		}
	}
}

?>



          </div>
        </div>
      </div>
    </div>
    <div class="section">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <ul class="pager">
              <li>
			  <?php
				if($page>0) {
					echo "<a href=\"results.php?order=" . $_GET["order"] . "&tag=" . $_GET["tag"] . "&q=" . $_GET["q"] . "&p=" . ($page-10) . "\">←  Prev</a>";
				}
				echo "</li>";
				echo "<li>";
				if(($page+10)<$dataCount) {
					echo "<a href=\"results.php?order=" . $_GET["order"] . "&tag=" . $_GET["tag"] . "&q=" . $_GET["q"] . "&p=" . ($page+10) . "\">Next  →</a>";
				}
			?>
              </li>
            </ul>
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















