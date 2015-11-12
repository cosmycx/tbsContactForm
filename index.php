<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
   
    <title>Contact Form Example, Bootstrap, PHP, Javascript</title>

    <!-- Bootstrap -->
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

	<!--styles-->
	<link href='http://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="modalFormCustom.css">
	<!--end styles-->
  </head>
<body>
<div class="container-fluid">

<!--php//////////////////////////////////////////////////////////////////////////////////////////////////-->
<?php
	// define variables and set to empty values
$firstNameErr = $lastNameErr= $userEmailErr= $messageErr ="" ;
$firstName = 	$lastName  	= $userEmail = 	 $message= $displaySent="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
//check if fields are empty---------------------------------------------------------
	if (empty($_POST["firstName"])) {
		$firstNameErr = "*First Name is required";
	} else {
		$firstName = test_input($_POST["firstName"]);
			//testing 
			//if (!preg_match("/^[a-zA-Z ]*$/",$firstName)) {
		     //$firstNameErr = "Only letters and white space allowed";}
	}

	if (empty($_POST["lastName"])) {
		$lastNameErr = "*Last Name is required";
	} else {
		$lastName = test_input($_POST["lastName"]);
		    //testing 
			//if (!preg_match("/^[a-zA-Z ]*$/",$lastName)) {
		    //$lastNameErr = "Only letters and white space allowed";}
	}

	if (empty($_POST["userEmail"])) {
		$userEmailErr = "*Email is required";
	} else {
		$userEmail = test_input($_POST["userEmail"]);
		     // check if e-mail address is well-formed
		if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
			$userEmailErr = "Invalid email format"; 
		}
	}

	if (empty($_POST["message"])) {
		$messageErr = "*Message is required";
	} else {
		$message = test_input($_POST["message"]);
	}
//end check if fields are empty, fields are full then ready to send email------------
	if (//send email----------------------------------------
		(!empty($_POST["firstName"]))&&
		(!empty($_POST["lastName"]))&&
		(!empty($_POST["userEmail"]))&&(filter_var($userEmail, FILTER_VALIDATE_EMAIL))&&
		(!empty($_POST["message"]))
		){	
		    $to = ""; // !!insert your Email address
		    $from = $_POST['userEmail']; // this is the sender's Email address
		    $first_name = $_POST['firstName'];
		    $last_name = $_POST['lastName'];
		    $subject = "Website Form Message";//email subject
		    $message = $first_name . " " . $last_name . " wrote the following:" . "\n\n" . $_POST['message'];
		    //$subject2 = "Copy of your form submission";
			//$message2 = "Here is a copy of your message " . $first_name . "\n\n" . $_POST['message'];
		    $headers = "From:" . $from;
		    if(mail($to,$subject,$message,$headers)){
		    	$displaySent= "Email sent. Thank you.";
		    	$_POST = array();	
		    }
		    //$headers2 = "From:" . $to;	
		    //mail($from,$subject2,$message2,$headers2); // sends a copy of the message to the sender
		    //You can also use header('Location: thank_you.php'); to redirect to another page.		
		}//endif send email----------------------------------
}//end server request post

		function test_input($data) {//clean for html display and email
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}// end test input
?>
		<!-- end php//////////////////////////////////////////////////////////////////////////////////////////////////-->
		<div class="row">

 			<h1 class="text-center">Twitter Bootstrap Contact Form</h1>	
 			<h2 class="text-center">PHP, HTML, and Javascript</h2>		
		</div><!--end row-->

</div><!--end container fluid-->

<div class="container"><!--###############################################################################################-->
	<div class="row"><br>
			<ul class="list-group">
		  <li class="list-group-item">1. Contact form to use with Bootstrap, Inline or Modal.</li>
		  <li class="list-group-item">2. Inline or Modal option.</li>
		  <li class="list-group-item">3. Code order: PHP, HTML, Javascript.</li>
		  <li class="list-group-item">Note: This contact form is just a sample, and does not send email unless code is edited, see PHP code comments.</li>
		</ul>
	</div><!--end row-->

	<!-- start inline form //////////////////////////////////////////////////////////////////////////////////////////////-->
	<div class="row" >
		<div class="col-md-6 formBackground">
			<h3>Contact Sample Form:</h3>
			<form id="contactUs" method="post"><!--<?php// echo htmlspecialchars($_SERVER["PHP_SELF"]);?>-->
				<div class="form-group">
			    	<label class="control-label">First Name:</label>
				    <input type="text" name="firstName" id="firstName" class="form-control" 
				    placeholder="First Name *required">
				  	<span class="text-danger"><?php echo $firstNameErr;?></span>
				</div>

			  	<div class="form-group">
			    	<label class="control-label">Last Name:</label>
				    <input type="text" name="lastName"  id="lastName" class="form-control" 
				    placeholder="Last Name *required">
				  	<span class="text-danger"><?php echo $lastNameErr;?></span>
			  	</div>

			  	<div class="form-group">
				    <label class="control-label">Email address:</label>
				    <input type="email" name="userEmail" id="userEmail" class="form-control"  placeholder="Email *required">
				   	<span class="text-danger"><?php echo $userEmailErr;?></span>
			  	</div>

			   <div class="form-group">
				   <label class="control-label">Message:</label>
				   <textarea name="message" id="message" class="form-control" rows="5" placeholder="Message *required" maxlength="300"></textarea>
				   <span class="text-danger"><?php echo $messageErr;?></span>
			   </div>

	 			<div class="form-group">
					<button type="submit" id="emailSent" class="btn btn-primary">Submit</button>
		      		<p><b id="sentText"><?php echo $displaySent?></b></p>
				</div>

			</form>
		</div><!--end column md--> 
		<div class="col-md-6">
			<!-- Large modal -->
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">Large modal</button>

			<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
			  <div class="modal-dialog modal-lg">
			    <div class="modal-content">
			      <h3>Contact Sample Form:</h3>

						<form id="contactUs" method="post"><!--<?php// echo htmlspecialchars($_SERVER["PHP_SELF"]);?>-->
							<div class="form-group">
						    	<label class="control-label">First Name:</label>
							    <input type="text" name="firstName" id="firstName" class="form-control" 
							    placeholder="First Name *required">
							  	<span class="text-danger"><?php echo $firstNameErr;?></span>
							</div>

						  	<div class="form-group">
						    	<label class="control-label">Last Name:</label>
							    <input type="text" name="lastName"  id="lastName" class="form-control" 
							    placeholder="Last Name *required">
							  	<span class="text-danger"><?php echo $lastNameErr;?></span>
						  	</div>

						  	<div class="form-group">
							    <label class="control-label">Email address:</label>
							    <input type="email" name="userEmail" id="userEmail" class="form-control"  placeholder="Email *required">
							   	<span class="text-danger"><?php echo $userEmailErr;?></span>
						  	</div>

						   <div class="form-group">
							   <label class="control-label">Message:</label>
							   <textarea name="message" id="message" class="form-control" rows="5" placeholder="Message *required" maxlength="300"></textarea>
							   <span class="text-danger"><?php echo $messageErr;?></span>
						   </div>

				 			<div class="form-group">
								<button type="submit" id="emailSent" class="btn btn-primary">Submit</button>
					      		<p><b id="sentText"><?php echo $displaySent?></b></p>
							</div>
						</form>

			    </div>
			  </div>
			</div>
		</div><!--end column md--> 

	</div><!--end row--> 
	<!-- end inline form //////////////////////////////////////////////////////////////////////////////////////////////-->
	<script type="text/javascript">

	if (sessionStorage) {//if text on form before then load on page
					window.onbeforeunload = function() {
					sessionStorage.sfName = document.getElementById('firstName').value;
					sessionStorage.slName = document.getElementById('lastName').value;
					sessionStorage.sEmail = document.getElementById('userEmail').value;
					sessionStorage.sMessage = document.getElementById('message').value;
							   
							    // 
							}

					window.onload = function() {
						
						if (document.getElementById('sentText').textContent) {//testing if form was submitted
							sessionStorage.clear();					
						}
							else{//form not submitted, save text in case of refresh
								if ( typeof (sessionStorage.sfName) != 'undefined')
								document.getElementById('firstName').value = sessionStorage.sfName;

								if ( typeof (sessionStorage.slName) != 'undefined')
								document.getElementById('lastName').value = sessionStorage.slName;

								if ( typeof (sessionStorage.sEmail) != 'undefined')
								document.getElementById('userEmail').value = sessionStorage.sEmail;

								if ( typeof (sessionStorage.sMessage) != 'undefined')
								document.getElementById('message').value = sessionStorage.sMessage;	
							}//end else
									
					}//end onload
								
	}//end session storage
				else{
					//no support of local storage!.
				}
	</script>        
	<!-- end form //////////////////////////////////////////////////////////////////////////////////////////////-->

</div><!--###############################################################################################-->

<!--Jquery -->		
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Bootstrap Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>

</body>
</html>