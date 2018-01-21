
@if(isset($_REQUEST['submit']))
   

<?php

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
        
        
                \DB::insert('insert into home (TITULO, CODIGOINTERNO,CODFAMILIA, TITULOFAMILIA,    CODSUBFAMILIA,TITULOSUBFAMILIA, CODFABRICANTE,NOMFABRICANTE,PRECIO,STOCK) 
                values (?, ?, ?, ?, ?, ?, ?, ?,?,?)', 
                [
                    $_REQUEST['name'],$_REQUEST['code'],"PC","PC y TPV",    "ele" ,"PCs electroaita","electroaita","electroaita" ,$_REQUEST['precio'],$_REQUEST['stock']
                ]);
                
                \DB::insert('insert into productData (code, description, specifications) values (?, ?, ?)', [$_REQUEST['code'],$_REQUEST['com'],$_REQUEST['tec']]);
                
               
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
?>


@endif





@extends('mainTemplates/adminTemplate')



    @section('content')
    
    
    <form action="#" method="post" enctype="multipart/form-data">
    Select image to upload:
    
    
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        
        <br>
        
        
        Código:
        <input type="text" name="code" id="code" value="{{ \Tools::hexadecimalAzar(10) }}">
        
        <br>
        
        Nombre:
        <input type="text" name="name" id="name">
        
        <br>
        
        Stock:
        <input type="text" name="stock" id="stock">
        
        <br>
        
        
        Precio:
        <input type="text" name="precio" id="precio">
        
        <br>
        
        
        Ficha técnica:
        <textarea name="tec" id="tec"></textarea>
        
        <br>
        Ficha comercial:
        <textarea name="com" id="com"></textarea>
        
        <br>       
        
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload Image" name="submit">
    </form>





    @endsection