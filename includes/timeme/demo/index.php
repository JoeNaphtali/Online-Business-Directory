<?php
// Database Connection
include "../../dbh.inc.php";
?>

<html>

<head>
	<title>Page Visibility Test</title>
	<link rel="stylesheet" type="text/css" href="index.css">
	<script src="../timeme.js"></script>
	<script type="text/javascript">
		TimeMe.initialize({
			currentPageName: "my-home-page", // current page
			idleTimeoutInSeconds: 5, // stop recording time due to inactivity
			//websocketOptions: { // optional
			//	websocketHost: "ws://your_host:your_port",
			//	appId: "insert-your-made-up-app-id"
			//}
		});

		TimeMe.callAfterTimeElapsedInSeconds(4, function () {
			console.log("The user has been using the page for 4 seconds! Let's prompt them with something.");
		});

		TimeMe.callAfterTimeElapsedInSeconds(9, function () {
			console.log("The user has been using the page for 9 seconds! Let's prompt them with something.");
		});


		window.onload = function () {

			TimeMe.trackTimeOnElement('area-of-interest-1');
			TimeMe.trackTimeOnElement('area-of-interest-2');
			setInterval(function () {
				let timeSpentOnPage = TimeMe.getTimeOnCurrentPageInSeconds();
				document.getElementById('timeInSeconds').textContent = timeSpentOnPage.toFixed(2);

				var xmlhttp = new XMLHttpRequest();
				xmlhttp.open("POST", "../../time.inc.php", true);
				xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xmlhttp.onreadystatechange = function() {
					if (this.readyState === 4 || this.status === 200){ 
						console.log(this.responseText); // echo from php
					}       
				};
				let listing_id = 1;
				xmlhttp.send("timeSpent=" + timeSpentOnPage + "&listing_id=" + listing_id);

				if (TimeMe.isUserCurrentlyOnPage && TimeMe.isUserCurrentlyIdle === false) {
					document.getElementById('activityStatus').textContent = "You are actively using this page."
				} else {
					document.getElementById('activityStatus').textContent = "You have left the page."
				}

				let timeSpentOnElement = TimeMe.getTimeOnElementInSeconds('area-of-interest-1');
				document.getElementById('area-of-interest-time-1').textContent = timeSpentOnElement.toFixed(2);

				let timeSpentOnElement2 = TimeMe.getTimeOnElementInSeconds('area-of-interest-2');
				document.getElementById('area-of-interest-time-2').textContent = timeSpentOnElement2.toFixed(2);

			}, 37);
		}

	</script>
</head>

<body>
	<div class="top-level-message">
		<h1>TimeMe.js</h1>
		<h3>You have been active on this page for</h3>
	</div>
	<input type="button" name="Submit" value="Submit" id="formsubmit" onClick="readid(id)">
	<div class="time-message">
		<h1>
			<span id="timeInSeconds">0</span> <span>seconds</span>
		</h1>
		<h4 id="activityStatus">You are actively using this page.</h4>
	</div>
	<div>
		<h3>Demo</h3>
		Notice the timer above? It is tracking how long you are actively viewing this web page.
		It is smart enough to stop incrementing when you minimize the browser or if you switch to
		a different tab. Try it out! It also stops incrementing if you go idle for more than 5
		seconds (meaning you don't move the mouse or enter the keyboard for 5 seconds). While 5
		seconds is a relatively short time to gauge inactivity, it can be increased to a more
		realistic value (such as 60 seconds) to determine that a user is no longer viewing the page
		and has left the browser or computer altogether.
	</div>
	<div>
		<h3>Tracking specific elements</h3>
		TimeMe allows you to track how users are interacting <i>with specific elements</i> on
		your page. If you go idle, the timer also stops.

		<br />

		<div class="area-of-interest" id="area-of-interest-1">
			Interact with this element<br /><br />
			Interaction: <span id="area-of-interest-time-1"></span> seconds.
		</div>

		<div class="area-of-interest" id="area-of-interest-2">
			Interact with this element<br /><br />
			Interaction: <span id="area-of-interest-time-2"></span> seconds.
		</div>
	</div>
	<div>
		<h3>TimeMe.js</h3>
		TimeMe.js is a JavaScript library that accurately tracks how long users interact with a web page.
		It disregards time spent on a web page if the user minimizes the browser or
		switches to a different tab. This means a more accurate reflection of actual 'interaction' time by
		a user is being collected.
		<br /><br />
		Additionally, TimeMe.js disregards 'idle' time outs. If the user goes
		idle (no page mouse movement, no page keyboard input) for a customizable period of time,
		then TimeMe.js will automatically ignore this time. This means no time will be reported where a web page
		is open but the user isn't actually interacting with it (such as when they temporarily leave the computer).
		<br /><br />
		Furthermore - TimeMe supports tracking time for specific elements within a page. This means you
		can track and compare usage of different parts of the same web page. Multiple concurrent timers
		are supported.
		<br /><br />
		These components put together create a much more accurate representation of how
		long users are actually using a web page.
	</div>
	<div>
		<h3>Where do I get TimeMe.js?</h3>
		You can download the most recent copy at <a href="https://github.com/jasonzissman/TimeMe.js">the TimeMe Github
			project</a>.
	</div>
	<br /><br />
</body>

</html>