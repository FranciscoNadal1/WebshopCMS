@if(isset($_REQUEST['code']))
    <?php 
        $code = $_REQUEST['code'];
    ?>
@endif

<?php




?>

   
<?php
/*

$_REQUEST['code'] = $code;

    $target_dir = "../public/productImages/home/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    
    $target_file = $target_dir . $_REQUEST['code'] . ".jpg";
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
        
    */    
        try{
        
        echo $code;
       \DB::table('home')->where('CODIGOINTERNO', '=',  $code)->delete();
       
       
       
        echo "Se ha borrado el pc";
echo "

<meta http-equiv='refresh' content='0; URL=/admin/editPCs' />

";
}catch(\Exception $e){
    echo $e;
    echo "Ha fallado la actualización";
}
  
    /*
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    if ($_FILES["fileToUpload"]["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
    */
?>







@extends('mainTemplates/adminTemplate')



    @section('content')
    
    



    @endsection