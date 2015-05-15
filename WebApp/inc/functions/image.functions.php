<?php

	function uploadImage($diagnosisID, $description, $connection) {

		$target_dir = 'images/';
		$target_file = $target_dir . basename($_FILES["image"]["name"]);

		//make path for file to be stored in the database for fetching purposes
		$target_file_db_path = 'images/' . basename($_FILES["image"]["name"]);

		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		$uploadOk = 1;

		// Check if file already exists
		if (file_exists($target_file)) {
			$imageUploadStatus = "Sorry, file already exists.";
			$uploadOk = 0;
		}
		// Check if $uploadOk is still set to 1
		if ($uploadOk == 1) {

			if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file))
			{

				if( insertImageToDB($target_file_db_path, $diagnosisID, $description, $connection) ) {
					return getImageID ($target_file_db_path, $connection);//success
				}
				else
					return 0;

			}
			else 
				return 0;

		} else
			return 0;


	}//end of upload Image

	function insertImageToDB($target_file_db_path, $diagnosisID, $description, $connection) {

		$diagnosisID = mysqli_real_escape_string($connection, $diagnosisID);
		$description = mysqli_real_escape_string($connection, $description);
		$target_file_db_path = mysqli_real_escape_string($connection, $target_file_db_path);

		$sql = "INSERT INTO images
				VALUES (NULL, NULL, $diagnosisID, '$target_file_db_path', '$description')";

		if (mysqli_query($connection, $sql)) {
		    return 1; //successfully executed query
		}
		else 
			return 0; //Error in executing query

	}//end of function

	//Currently does not delete the physical file. Only erases path from DB.
	//Change it to delete physical file as well, later.
	function deleteImageFromDB ($imageID, $connection) {

		$imageID = mysqli_real_escape_string($connection, $imageID);

		$sql = "DELETE 
				FROM images 
				WHERE imageID = $imageID";

		if (mysqli_query($connection, $sql)) {
		    return 1; //successfully executed query
		}
		else 
			return 0; //Error in executing query

	}//End of Function	


	//Currently does not delete the physical file. Only erases path from DB.
	//Change it to delete physical file as well, later.
	function deleteThumbnailFromDB ($imageID, $connection) {

		$imageID = mysqli_real_escape_string($connection, $imageID);

		$sql = "DELETE 
				FROM thumbnails 
				WHERE imageID = $imageID";

		if (mysqli_query($connection, $sql)) {
		    return 1; //successfully executed query
		}
		else 
			return 0; //Error in executing query

	}//End of Function	


	function getImageDetails ($imageID, $connection) {

		$imageID = mysqli_real_escape_string($connection, $imageID);

		$sql = "SELECT *
				FROM images
				WHERE imageID = $imageID";
		$result = mysqli_query($connection, $sql);

		//single dimensional array enough to return the result

		if (mysqli_num_rows($result) == 1) {
		    while($row = mysqli_fetch_assoc($result)) {
		        $result_arr = array (	'imageID' => $row['imageID'],
		        							'originalID' => $row['originalID'],
		        							'diagnosisID' => $row['diagnosisID'],
		        							'image' => $row['image'],
		        							'description' => $row['description'] );
		    }//End While
		}//End If

		return $result_arr;

	}//End of Function*/

	function getThumbnailDetails ($imageID, $connection) {

		$imageID = mysqli_real_escape_string($connection, $imageID);

		$sql = "SELECT *
				FROM thumbnails
				WHERE imageID = $imageID";
		$result = mysqli_query($connection, $sql);

		//single dimensional array enough to return the result

		if (mysqli_num_rows($result) == 1) {
		    while($row = mysqli_fetch_assoc($result)) {
		        $result_arr = array (	'imageID' => $row['imageID'],
		        						'thumbImage' => $row['thumbImage']);
		    }//End While
		    return $result_arr;
		}//End If

	}//End of Function*/

	function getImageID ($image, $connection) {

		$image = mysqli_real_escape_string($connection, $image);

		$sql = "SELECT imageID
				FROM images
				WHERE image = '$image'";
		$result = mysqli_query($connection, $sql);

		//single dimensional array enough to return the result

		if (mysqli_num_rows($result)) {

		    $row = mysqli_fetch_assoc($result);
			return $row['imageID'];

		}

		return 0;

	}//End of Function*/


	function generateThumbnail($imageID, $image, $connection) {

		/*======generate thumbnail==============*/
		
		$image_size = getimagesize($image); // it will get the dimensions for the image

		$image_width = $image_size[0];//width of image
		$image_height = $image_size[1];//height of image

		$height_width_ratio = $image_height / $image_width; //simple ratio to keep proportions intact while reducing photo

		$new_width = 100;
		$new_height = $new_width * $height_width_ratio;

		$new_image = imagecreatetruecolor($new_width, $new_height); // it need the two paramters as specified
		$old_image = imagecreatefromjpeg($image);  // creates the new file from the path specified

		imagecopyresized($new_image, $old_image , 0, 0, 0, 0, $new_width, $new_height, $image_width, $image_height);

		$image_path_name = 'thumbnails/'.basename($image); //specifying the path of the file and its basename

		imagejpeg($new_image, $image_path_name); //creating a jpeg file acting as thumbnail

		/*=====================================*/



		/*====upload thumbnail path to DB ====*/

		$sql = "INSERT INTO thumbnails
				VALUES ($imageID, '$image_path_name')";

		if (mysqli_query($connection, $sql)) {
		    return 1; //successfully executed query
		}
		else 
			return 0; //Error in executing query

		/*====================================*/


	}//end of function

?>