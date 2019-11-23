<?php 
include('server.php');
	if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$update = true;
		$record = mysqli_query($db, "SELECT * FROM uebersicht WHERE id=$id");

		if (count($record) == 1 ) {
			$n = mysqli_fetch_array($record);
			$firma = $n['firma'];
			$adresse = $n['adresse'];
			$tel = $n['tel'];
			$email = $n['email'];
			$bemerkungen=$n['bemerkungen'];
			$webseite=$n['webseite'];
			$beworben=$n['beworben'];
			$absage=$n['absage'];
		}

	}
	//$nr = 1;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Adressen für Bewerbungen</title>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<!-- <link rel="stylesheet" type="text/css" href="style.css"> -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>
	<?php if (isset($_SESSION['message'])): ?>
		<div class="msg alert alert-success" role="alert">
			<?php 
				echo $_SESSION['message']; 
				unset($_SESSION['message']);
			?>
		</div>
	<?php endif ?>

<div class="container-fluid">  <!-- Hauptcontainer -->

<!-- Zusammenfassung aller Bewerbungen -->
<div class="shadow">
<div class="table-responsive-sm">
<table class="table table-sm table-hover">
	<thead class=thead-dark>
		<tr>
		<th scope="col">Adressen</th>
			<th scope="col">Beworben bei</th>
			<th scope="col">Offen</th>
			<th scope="col">Absage erhalten</th>
		</tr>
	</thead>
		<th>
			<?php 
			$adressen = mysqli_query($db, "SELECT count(*) as adressen FROM bewerbungen.uebersicht;"); 
			echo (count($adressen) == 1 ? mysqli_fetch_array($adressen)['adressen'] : 0);
			?>
		</th>
		<td>
			<?php 
			$bw = mysqli_query($db, "SELECT count(*) as bw FROM bewerbungen.uebersicht WHERE beworben = 1;"); 
			echo (count($bw) == 1 ? mysqli_fetch_array($bw)['bw'] : 0);
			?>
		</td>
		<td>
			<?php 
			$offen = mysqli_query($db, "SELECT count(*) as offen FROM bewerbungen.uebersicht WHERE beworben = 1 and absage = 0;"); 
			echo (count($offen) == 1 ? mysqli_fetch_array($offen)['offen'] : 0);
			?>
		</td>
		<td>
			<?php 
			$ae = mysqli_query($db, "SELECT count(*) as ae FROM bewerbungen.uebersicht WHERE absage = 1;"); 
			echo (count($ae) == 1 ? mysqli_fetch_array($ae)['ae'] : 0);
			?>
		</td>
</table>


<!-- Zentrale Übersicht aller Bewerbungen -->
<?php $results = mysqli_query($db, "SELECT * FROM uebersicht"); ?>


<div class="shadow">
<div class="table-responsive-sm">
<table class="table table-sm table-hover">
	<thead class=thead-dark>
		<tr>
		<th scope="col">Nr.</th>
			<th scope="col">Firma</th>
			<th scope="col">Adresse</th>
			<th scope="col">Tel</th>
			<th scope="col">Email</th>
			<th scope="col">Bemerkungen</th>
			<th scope="col">Webseite</th>
			<th scope="col">Beworben</th>
			<!-- <th colspan="2">Aktion</th> -->
			<th scope="col">Aktion</th>
		</tr>
	</thead>
	
	<?php while ($row = mysqli_fetch_array($results)) { ?>
		<tr>
			<th scope="row"><?php echo $row['id']; ?></th>
			<td><b>
			<?php echo ($row['absage'] == 1 ? '<span style="color:red;">Absage</span><br /><s>' : ""); ?>
			<?php echo $row['firma']; ?>
			<?php echo ($row['absage'] == 1 ? '</s>' : ""); ?>
			</b></td>
			<td>				
				<?php if (strlen($row['adresse']) > 0) { ?>
				<a href="https://maps.google.com/maps?q=<?php echo $row['adresse']; ?>" target="_blank"><?php echo nl2br($row['adresse']); ?></a>
				<?php } ?>
			</td>
			<td><?php echo $row['tel']; ?></td>
			<td><a href="mailto:<?php echo $row['email']; ?>"><?php echo $row['email']; ?></a></td>
			<td><?php echo nl2br($row['bemerkungen']); ?></td>
			<td>
				<?php if (strlen($row['webseite']) > 0) { ?>
				<a href="<?php echo $row['webseite']; ?>" target="_blank"><?php echo $row['webseite']; ?></a>
				<?php } ?>
			</td>
			<td><?php echo ($row['beworben'] == 0 ? '<span class="badge badge-danger">Nein</span>' : '<span class="badge badge-success">Ja</span>'); ?></td>
			<td>
				<a href="index.php?edit=<?php echo $row['id']; ?>#formular" class="btn btn-primary" >Bearbeiten</a>
			</td>
<!-- 			<td>
				<a href="server.php?del=<?php echo $row['id']; ?>" class="btn btn-danger">Löschen</a>
			</td> -->
		</tr>
	<?php } ?>
</table>
</div>	
</div>

<div class="row" id="formular">
	<div class="w-25 p-3">&nbsp;</div>
  <div class="w-50 p-3 shadow mb-5 bg-white rounded">
    <div class="card">
		<form method="post" action="server.php" >

			<input type="hidden" name="id" value="<?php echo $id; ?>">

			<div class="form-group">
				<label>Firma</label>
				<input class="form-control" type="text" name="firma" value="<?php echo $firma; ?>">
			</div>
			<div class="form-group">
				<label>Adresse</label>
				<!-- <input type="text" name="adresse" value="<?php echo $adresse; ?>"> -->
				<textarea class="form-control" name="adresse" rows="2"><?php echo $adresse; ?></textarea>
			</div>
			<div class="form-group">
				<label>Tel</label>
				<input class="form-control" type="text" name="tel" value="<?php echo $tel; ?>">
			</div>
			<div class="form-group">
				<label>Email</label>
				<input class="form-control" type="text" name="email" value="<?php echo $email; ?>">
			</div>
			<div class="form-group">
				<label>Bemerkungen</label>
				<!-- <input type="text" name="bemerkungen" value="<?php echo $bemerkungen; ?>"> -->
				<textarea  class="form-control" name="bemerkungen" rows="5"><?php echo $bemerkungen; ?></textarea>
			</div>
			<div class="form-group">
				<label>Webseite</label>
				<input class="form-control" type="text" name="webseite" value="<?php echo $webseite; ?>">
			</div>
			<div class="form-group">
				<label>Beworben</label>
				<input class="form-control" type="checkbox" name="beworben" value="<?php echo $beworben; ?>"<?php if ($beworben == 1) echo ' checked="checked"'; ?>">
			</div>
			<div class="form-group">
				<label>Absage erhalten</label>
				<input class="form-control" type="checkbox" name="absage" value="<?php echo $absage; ?>"<?php if ($absage == 1) echo ' checked="checked"'; ?>">
			</div>
			<div class="form-group">

				<?php if ($update == true): ?>
					<button class="btn btn-danger btn-lg" type="submit" name="update" >Update</button>
				<?php else: ?>
					<button class="btn btn-danger btn-lg" type="submit" name="save" >Speichern</button>
				<?php endif ?>
			</div>
		</form>
		</div>
	</div>
	<div class="w-25 p-3">&nbsp;</div>
</div>

</div> <!-- Main Container ".container-fluid" -->

	<!-- Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>