<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<title>Hello, world!</title>
</head>
<body>
	
	<div class="conatiner text-center pt-5">
		<form action="upload.php" method="post" enctype="multipart/form-data">
			Select image to upload:
			<input type="file" name="fileToUpload[]" id="fileToUpload" multiple>
			<input type="submit" value="Upload Image" name="submit">
		</form>
	</div>
	<div class="container">
		<div class="row">

			<?php

			$dir = new FilesystemIterator('uploads/');
			foreach($dir as $key => $file){
			?>
			<div class="col-sm">
				<div class="card">
					<div class="card-header"><img src="uploads/<?= $file->getFilename()?>" alt="image" style="width: 150px;"></div>
					<div class="card-body"><?= $file->getFilename() ?></div> 
					<div class="card-footer"><button class="removeBtn">X</button></div>
				</div>
			</div>

			<?php } ?>

		</div>
	</div>

	<script>

		let userRemove = document.getElementsByClassName("removeBtn")

		for(var i = 0; i < userRemove.length; i++) {
			(index => {
				userRemove[i].addEventListener("click", () => {
					console.log("Clicked index: " + index);
					let imageName = userRemove[index].parentElement.previousElementSibling.innerHTML
					userRemove[index].parentElement.parentElement.style.display = 'none';  
					removeFile(imageName)
				})
			})(i);
		}

		function removeFile(imageName){
			$.ajax({
				url: 'removeUploads.php',
				type: 'POST',
				dataType: "json",
				data: {
					name: imageName,
				}
			})
		}
		
	</script>

	<script
	src="https://code.jquery.com/jquery-3.4.0.js"
	integrity="sha256-DYZMCC8HTC+QDr5QNaIcfR7VSPtcISykd+6eSmBW5qo="
	crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>