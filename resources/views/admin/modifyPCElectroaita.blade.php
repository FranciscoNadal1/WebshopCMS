@if(isset($_REQUEST['code']))
    <?php 
        $code = $_REQUEST['code'];
    ?>
@endif

<?php



$result = \DB::select("SELECT * FROM home where CODIGOINTERNO ='" . $code . "'");
$data = \DB::select("SELECT * FROM productData where code ='" . $code . "'");

?>
@if(isset($_REQUEST['submit']))
   
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
        \DBData::insertProductSpecifications($code, $_REQUEST['tec']);
        \DBData::insertProductDescription($code, $_REQUEST['com']);
        \DB::table('home')->where('CODIGOINTERNO', $code)
        ->update(['TITULO' => $_REQUEST['name'],
        'STOCK' => $_REQUEST['stock'],
        'PRECIO' => $_REQUEST['precio']
        ]);
         \MailData::addMail("Update","Information","El producto : " . $code . " ha sido modificado");
        echo "Se ha realizado la modificación";
echo "

<meta http-equiv='refresh' content='0; URL=/admin/editPCs' />

";
}catch(\Exception $e){
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


@endif





@extends('mainTemplates/adminTemplate')



    @section('content')
    
    
    <form action="./{{ $result[0]->CODIGOINTERNO }}" method="post" enctype="multipart/form-data">
    Select image to upload:
    
    
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        
        <br>
        
        
        Código:
        <input type="text" disabled name="code" id="code" value="{{ $result[0]->CODIGOINTERNO }}">
        
        <br>
        
        Nombre:
                <input type="text" name="name" id="name" value="{{ $result[0]->TITULO }}">
        
        <br>
        
        Stock:
        <input type="text" name="stock" id="stock" value="{{ $result[0]->STOCK }}">
        
        <br>
        
        
        Precio:
        <input type="text" name="precio" id="precio" value="{{ $result[0]->PRECIO }}">
        
        <br>
        
        
        Ficha técnica:
        <textarea name="tec" id="tec">{{$data[0]->specifications}}</textarea>
        
        <br>
        Ficha comercial:
        <textarea name="com" id="com">{{$data[0]->description}}</textarea>
        
        <br>       
        
        <input disabled type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Generar PC" name="submit">
    </form>





    @endsection