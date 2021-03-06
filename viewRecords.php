<?php
	include("functions.php");
	if(isset($_POST['submit'])){
		if($_POST['submit']=='updateRecord'){
			update_values("records",
							"r_time1='".to24Hour($_POST['t1'])."',
							r_time2='".to24Hour($_POST['t2'])."',
							r_time3='".to24Hour($_POST['t3'])."',
							r_time4='".to24Hour($_POST['t4'])."'"
							
							,"r_id = '".$_POST['rId']."'");
		}
	}else{
		echo '<meta http-equiv="refresh" content="0; URL=index.php">
		<meta name="keywords" content="automatic redirection">';
	}
?>

<!DOCTYPE html>
<html>
	<header>
		<title>View Records</title>
	</header>
	<style>
		td {
			text-align: center;
		}
		#bg {
			top: 0;
			left: 0;
			
			background-color: black;
			opacity: 0.5;
			position: fixed;
			width: 100%;
			height: 100%;
		}
		#addForm {
			width : 25%;
			height: 40%;
			border: 3px solid #73AD21;
			padding: 10px; z-index: 1;
			position: fixed;
			top: 35%;
			left: 35%;
			background-color: white;
			padding: 20px;
			overflow:auto;
		}
		.inp {
			width: 100%;
			text-align: center;
		}
		.toHide {
			display:block;
		}
		@media print{
			.toHide {
				display:none;
			}
		}
	</style>
	<script src="script_functions.js">
	</script>
	
	<body>
		<button type="button" id="viewBtn" onclick="redirectPage('viewBtn','adminPage.php');">Back To Admin Page</button>
		<h2 class="toHide">View Records</h2>
		
		
		
		<table width="99%" border="0" style="text-align: center;">
			<!--Update Record-->
				<div id="bg" style="display: none;"></div>
				<div id="addForm"  style="display:none; z-index: 2;">
					<button onclick="changeDisplay('addForm','none');changeDisplay('bg','none')"> X </button>
					<p>
					<form method="POST" action="viewRecords.php">
						<h4>Edit User Record</h4>
							<input readonly="true" class="" id="rId" type="text" name="rId" value="" required="true">
							<input readonly="true" class="" id="uId" type="text" name="uId" value="" required="true">
						<h5>User Name</h5>
							<input readonly="true" id="uName" class="inp" type="text" name="uName" value="" placeholder="1000 characters max" required="true" width="20" height="20">
						
						<h5>Login AM</h5>
							<input class="inp" type="text" id="t1" name="t1" value="" required="true">
						<h5>Logout AM</h5>
							<input class="inp" type="text" id="t2" name="t2" value="" required="true">
						<h5>Login PM</h5>
							<input class="inp" type="text" id="t3" name="t3" value="" required="true">
						<h5>Logout PM</h5>
							<input class="inp" type="text" id="t4" name="t4" value="" required="true">
						
						<br><br>
						<button type="submit" name="submit" value="updateRecord"> OK </button>
					</form>
					</p>
				</div>
			
			
			<!--Columns-->
			<tr>
				<th>Date</th>	<th>Log In</th>	<th>Log Out</th>	<th>Log In</th>	<th>Log Out</th>	<th>Actions</th>
			</tr>
			
			
				
			<!--Rows-->
			<?php
				//Filters
				$filters = "ORDER BY r_date DESC";
				
				$result = return_values("*","dtr_view","where u_id='".$_POST['uId']."' ".$filters,3);
				
				for($n=0;$n<sizeof($result);$n++){
					//Column Data
					echo '
						<tr>
							<td>'.$result[$n][1].'</td>
						</tr>
						<tr>
							<td></td>
										<td>'.$result[$n][4].'</td>
										<td>'.$result[$n][5].'</td>
										<td>'.$result[$n][6].'</td>
										<td>'.$result[$n][7].'</td>
										
										<td class="toHide">
											<button type="button" id="addBtn" 
											onclick="
												changeDisplay(\'addForm\',\'block\');
												changeDisplay(\'bg\',\'block\');
												addUnit(\'rId\',\''.$result[$n][0].'\');
												addUnit(\'uId\',\''.$result[$n][2].'\');
												addUnit(\'uName\',\''.$result[$n][3].'\');
												addUnit(\'t1\',\''.$result[$n][4].'\');
												addUnit(\'t2\',\''.$result[$n][5].'\');
												addUnit(\'t3\',\''.$result[$n][6].'\');
												addUnit(\'t4\',\''.$result[$n][7].'\');
											">Edit</button>
										</td>
						</tr>
					';
				}
			?>
			
		</table>
	</body>
</html>