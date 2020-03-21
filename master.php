<?php 
require("./_connections/adm_blw.php"); 

$loginFormAction = $_SERVER['PHP_SELF'];

	if (isset($_GET['accesscheck'])) {

		$_SESSION['PrevUrl'] = $_GET['accesscheck'];

	}




/////////////////////////////////////


	if (isset($_POST['userName'])) {

	echo "into here";

	    $loginUsername = $_POST['userName'];

		$password = $_POST['Password'];

		$MM_fldUserAuthorization = "";

		$MM_redirectLoginSuccess = "mstrcity.php";

		$MM_redirectLoginFailed = "master.php";

		$MM_redirecttoReferrer = false;

		//mysqli_select_db($database_admin_buy_local, $admin_buy_local);
		mysqli_select_db($admin_buy_local, $database_admin_buy_local);



	//$citysite = "Any Town";

	$citysite = "Youngtown";

	//$citysite = "El Mirage";

	//$citysite = "Surprise";

	//$citysite = "Buckeye";

	//$citysite = "Goodyear";

	//$citysite = "Avondale";

	//$citysite = "Maricopa";

	//$citysite = "Peoria";

	//$citysite = "Sun City";

	//$citysite = "Sun City West";

	//$citysite = "Glendale";

	//$citysite = "Phoenix";

	//$citysite = "Paradise Valley";

	//$citysite = "Scottdale";

	//$citysite = "Tempe";

	//$citysite = "Mesa";

	//$citysite = "Chandler";

  

		echo $LoginRS__query= "SELECT id_city, user_admin, password FROM master_admin WHERE user_admin = '".$_POST['userName']."' AND password ='".$_POST['Password']."' AND city_name = '$citysite'" ;

			

   

 $LoginRS = mysqli_query($admin_buy_local, $LoginRS__query) or die(mysqli_error());


/*AQUI VA EL CODIGO PARA GUARDAR TODAS LAS VARIBLES EN SESION ANTES DE PASAR A LA PAGINA DEL ADMINISTRADOR*/

		if($row = mysqli_fetch_array($LoginRS)){

			//primero capturo los datos del usuario y los guardo en variables de arreglo

			$id_city = $row['id_city'];

			$user_admin = $row['user_admin'];							

			$city_name = $row['city_name'];							

			$logo = $row['logo'];

			//variables de sesion para control de pantallas

		    $_SESSION['id_city'] = $id_city;//IDENTIFICADOR UNICO DEL USUARIO

			$_SESSION['user_admin'] = $user_admin;//IDENTIFICADOR UNICO DEL USUARIO

			$_SESSION['city_name'] = $city_name;//IDENTIFICADOR UNICO DEL USUARIO

			$_SESSION['logo'] = $logo;//IDENTIFICADOR UNICO DEL USUARIO

		}

		///////////////////////////////////////////////////////////////////////////

		echo "encontro usurio ".$loginFoundUser = mysqli_num_rows($LoginRS);

		

			echo $citymstr = $_SESSION['id_city'];


		if ($loginFoundUser) {

			$loginStrGroup = "";

			

			//declare two session variables and assign them

			$_SESSION['MM_Username'] = $loginUsername;

			$_SESSION['MM_UserGroup'] = $loginStrGroup;	      

			

			//header("Location: " . $MM_redirectLoginSuccess);
			echo '<script>location.href="./'.$MM_redirectLoginSuccess.'";</script>';

		} else {

			header("Location: ". $MM_redirectLoginFailed. "?sec=1");

		}


		/////////////////

  

		/*////////////////////////////////////////////////////////////////////*/




	}


	/////////////////////



 ?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

	<!-- Starts META Tags -->

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<title>Buy Local Weekly - Master Login Area</title>

	<link href="_css/master.css" rel="stylesheet" type="text/css" />

	<link href='http://fonts.googleapis.com/css?family=Oswald|Six+Caps|Fjalla+One|Roboto+Condensed' rel='stylesheet' type='text/css'>

	<!-- Ends META Tags -->

</head>



<body>

	<!-- Site's Top section -->

	<div id="TopBorder">

    </div>

	<!-- Site's external borders -->

	<div id="Wrapper">

		<!-- Site's Top & menu section -->

    	<div id="TopHangers">

        </div>

		<!-- Site's Top & menu box name section -->

    	<div id="TopBox">

        	<div id="BssName">BUY LOCAL WEEKLY</div>

        </div>

		<!-- Site's Top & menu options section -->

		<div id="TopMenu">

			<div id="MenuLocation">

            	<ul>

					<li ID="MainMenuD"><a href="#">Business Admin</a></li>

					<li ID="MainMenuC"><a href="how.php">How It Works</a></li>

					<li ID="MainMenuB"><a href="search.php">List Businesses</a></li>

					<li ID="MainMenuA"><a href="index.php">Home</a></li>

				</ul>

			</div>

		</div>

		<!-- Site's logo & city name section -->

		<div ID="SiteLogo">

   	    	<a href="index.php"><img src="_images/sublogo.jpg" width="250" height="100" /></a>

		</div>

		<!-- Site's Cty name section -->

		<div ID="CityName">

			<?php echo 	$citysite; ?>

		</div>

		<!-- Ribbon & welcome message section -->

		<div class="ribbon">

   	    	<div class="ribbon-stitches-top">

       	    </div>

       		<div class="ribbon-stitches-left">

            </div>

   	        <strong class="ribbon-content">

       	    	<h1>MASTER ADMIN AREA</h1>

			</strong>

            <div class="ribbon-stitches-bottom">

        	</div>

		</div>

		<!-- Date expiration reminder section -->

		<div id="MasterBox">

			<div id="loginmtr">

			<?

				$sec = $_GET['sec'];

				if ($sec == "1") {

					echo ('Sorry! Incorrect username and/or password. Verify your credentials and city.');

				} else if ($sec == "2") {

					echo ('You are not authorised to access this page. Please, validate your username and password.');

				}

			?>

            </div>

			<form id="loginform" name="loginform" method="POST" action="<?php echo $loginFormAction; ?>">

				<table width="450" border="0" cellspacing="8" cellpadding="0">

					<tr>

						<td>

                        	<div align="right">

								<label for="Username">Username :</label>

							</div>

						</td>

						<td>

                        	<div align="left">

								<input name="userName" type="text" id="userName" size="25" />

							</div>

						</td>

					</tr>

					<tr>

						<td>

                        	<div align="right">

								<label for="Password">Password :</label>

							</div>

						</td>

						<td>

                        	<div align="left">

								<input name="Password" type="password" id="Password" size="25" maxlength="25" />

							</div>

						</td>

					</tr>

					<tr>

						<td>&nbsp;</td>

						<td>

                        	<input type="submit" name="Enter" id="Enter" value="Acess Admin Area" />

						</td>

					</tr>

					<tr>

						<td>

                        	<div align="right"></div>

						</td>

						<td>

                        	<div align="left">

                            	<span class="RecoverID"><a href="recover.php">Forgot Username and/or Password</a></span>

							</div>

						</td>

					</tr>

				</table>

				<div align="center"></div>

			</form>

			<div align="center"></div>

        </div>

 	</div>

	<!-- Site's bottom section -->

	<div id="BottomWrapper">

		<a href="about.php">About BuyLocalWeekly</a>   |   <a href="contact.php">Contact Us</a>   |   <a href="addbusiness.php">Add My Business</a>   |   <a href="#">Business Admin</a>   |   <a href="#">Master Admin</a>

	</div>

</body>

</html>