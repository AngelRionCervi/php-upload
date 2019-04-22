<?php
if (!file_exists('uploads/')) {
    mkdir('uploads/', 0777, true);
}
$target_dir = "uploads/";

for ($i = 0; $i<count($_FILES["fileToUpload"]["name"]); $i++){

	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"][$i]);
	var_dump($target_file);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
	$file_name = $target_dir.rtrim(basename($target_file, $imageFileType),'.').'-'.uniqid().'.'.$imageFileType; //gives the file a uniq id

	if(isset($_POST["submit"])) {
	    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"][$i]); //check if image
	    if($check !== false) {
	    	echo "File is an image - " . $check["mime"] . ".";
	    	$uploadOk = 1;
	    } else {
	    	echo "File is not an image.";
	    	$uploadOk = 0;
	    }
	}

	if (file_exists($target_file)) { //file shouldnt exist anyway
		echo "Sorry, file already exists.";
		$uploadOk = 0;
	}

	if ($_FILES["fileToUpload"]["size"][$i] > 1000000) { // if not > 1mo
		echo "Sorry, your file is too large.";
		$uploadOk = 0;
	}

	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "gif" ) { //check for correct extensions
		echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		$uploadOk = 0;
	}

	if ($uploadOk == 0) { // if error file is not upload
		echo "Sorry, your file was not uploaded.";
	} else {
	    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $file_name)) { //if no errors when movie de file from tmp to upload/
	    	echo "The file " . $_FILES["fileToUpload"]["name"][$i] . " has been uploaded.";
	    } else {
	    	echo "Sorry, there was an error uploading your file.";
	    }
	}
}
