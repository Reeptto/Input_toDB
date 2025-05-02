<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $target_dir = "uploads/";
    $target_file = $target_dir. basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(string: pathinfo($target_file, PATHINFO_EXTENSION));


    # check if file is an actual image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    }else {
        echo "File is not an image.";
        $uploadOk = 0;
    }


    # Check file size
    if ($_FILES["image"]["size"] > 500000) {
        echo "Maaf, file terlalu besar";
        $uploadOk = 0;
    }


   # Allow certain file formats
    if (!in_array($imageFileType, ["jpg", "png", "jpeg", "gif"])) {
        echo "Maaf Hanya JPG, JPEG, PNG, & GIF format yang diperbolehkan";
        $uploadOk = 0;
    }


    # Process Upload
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars(basename($_FILES["image"]["name"])). " has been uploaded. <br>";
            echo "Full name: ". htmlspecialchars($full_name);
        }else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>

<form action="" method="POST" enctype="multipart/form-data">
    Full Name : <input type="text" name="full_name" id="" required><br>
    Select image to upload: <input type="file" name="image" id="" required><br>
    <input type="submit" value="Upload" name="submit">
</form>