<?php
include '../../includes/Authenticate.php';
include '../../classes/student.php';

//check whether the user is logged in or not,
if (!Authenticate::isLoggedIn())
{
	Authenticate::logout();
}
//protects the student section
if (Authenticate::getUserType() != "STUDENT")
{
	Authenticate::redirect();
}

$queryResult = Student::viewChallenges();
date_default_timezone_set('Asia/Kolkata');
$currentTime = new DateTime();
$startTime = new DateTime();
$endTime = new DateTime();
$currentTime->setTimestamp(strtotime(date('Y-m-d H:i:s')));
$index = 0;


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Gnooble: Student</title>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:700,300,600,400' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="../../assets/css/main.css">
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-59768309-1', 'auto');
		ga('send', 'pageview');

	</script>
</head>
<body>

<nav class="navbar navbar-default navbar-inverse navbar-fixed-top">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">Gnooble</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
						<?php echo $_SESSION['username']; ?>
						<span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="#">Settings</a></li>
						<li><a href="#">Scoreboard</a></li>
						<li class="divider"></li>
						<li><a href="../../logout/">Logout</a></li>
					</ul>
				</li>
			</ul>
		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>

<div class="container-fluid">
	<div class="row">
		<section class="col-sm-3 col-md-2 sidebar"><ul class="nav nav-sidebar">
				<li><a href="/student/">Home <span class="sr-only">(current)</span></a></li>
				<li><a href="/student/practice/">Practice</a></li><li><a href="/student/submissions/">MySubmissions</a></li>
				<li  class="active"><a href="/student/contests/">Contests</a></li>
			</ul>

		</section>
		<section class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
			<h1 class="page-header">Practice</h1>
			<p class="lead">Start working on your coding skills right away.</p>



			<div class="table-responsive">
				<table class="table">
					<thead>
					<tr>
						<th>Sl no</th>
						<th>Contest Name</th>
						<th>Contest Description</th>
						<th>Starts On</th>
						<th>Ends On</th>
						<th>Enter Challenge</th>
					</tr>
					</thead>
					<?php if (($queryResult)): ?>
						<tbody>
						<?php foreach($queryResult as $result): ?>
							<tr>
								<td><?php echo ++$index; ?></td>
								<td><?php echo $result['cName']; ?></td>
								<td><?php echo $result["cDesc"]; ?></td>
								<td><?php echo ($result["startDate"]);?></td>
								<td><?php echo ($result["endDate"]);?></td>
								<td><?php


									$startTime->setTimestamp(strtotime(($result["startDate"])));
									$endTime->setTimestamp(strtotime($result["endDate"]));
									if ($currentTime>=$startTime && $currentTime<=$endTime)
										echo "<a href='viewchallenge/index.php?cid=".$result["cId"]."&type=".$result["Type"]."'"."</a>"."Enter Challenge";
									else
										echo "Contest Ended";

									?></td>

							</tr>
						<?php endforeach; ?>

						</tbody>
					<?php endif; ?>
				</table>
			</div>



		</section>
	</div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="../../assets/js/bootstrap.min.js"></script>
</body>
</html>