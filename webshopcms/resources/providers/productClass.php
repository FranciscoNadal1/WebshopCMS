<?php

class Products{
        
    public  $id;
    public  $name;
    public  $PictureUrl;
    public  $AdditionalProductPictures;
    public  $AdditionalPictureCount;
    public  $Published;
    public  $FullDescription;
    public  $ShortDescription;
    public  $price;
    public  $sku;
    public  $PartNumber;
    public  $EANUpc;
    public  $CreatedOnUtc;
    public  $UpdatedOnUtc;
    public  $Stock;
    public  $StockPalma;
    public  $Weight;
    public  $WeightMeasurement;
    public  $Length;
    public  $Width;
    public  $VolumeMeasurement;
    public  $CategoryId;
    public  $CategoryName;
    public  $manufacturerId;
    public  $ManufacturerName;
    public  $LifeCycleCode;
    public  $LifeCycle;

   function __construct($sku, $name, $FullDescription, $stock) {
       $this->sku = $sku;
       $this->name = $name;
       $this->FullDescription = $FullDescription;
       $this->stock = $stock;
       
       print "En el constructor BaseClass\n";
   }
}

?>