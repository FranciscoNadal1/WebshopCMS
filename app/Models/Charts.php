<?php

namespace Charts;

class ChartManager{


   static function Test(){
      return "Charts";
   }
   
   
   static function addTestChart($divID){

            $stocksTable = \Lava::DataTable();  // Lava::DataTable() if using Laravel
            
            $stocksTable->addDateColumn('Day of Month')
                        ->addNumberColumn('Projected')
                        ->addNumberColumn('Official');
            
            // Random Data For Example
            for ($a = 1; $a < 30; $a++) {
                $stocksTable->addRow([
                  '2015-10-' . $a, rand(800,1000), rand(800,1000)
                ]);
            }
            $chart = \Lava::LineChart('MyStocks', $stocksTable);
            echo \Lava::render('LineChart', 'MyStocks', $divID);
      
   }
   
    static function apiCalls($divID){
                            
                    $resultado = \DB::select("SELECT * FROM apiCalls order by Date");
                    if (!$resultado) {
                        echo 'No se pudo ejecutar la consulta: ' . mysql_error();
                        exit;
                    }



            $stocksTable = \Lava::DataTable();  
            
            $stocksTable->addDateColumn('Fecha')
                        ->addNumberColumn('Llamadas');
            
            for ($a = 0; $a < count($resultado); $a++) {
                $stocksTable->addRow([
                  $resultado[$a]->Date, $resultado[$a]->Number
                ]);
            }
            $chart = \Lava::AreaChart('MyStocks', $stocksTable);
            echo \Lava::render('AreaChart', 'MyStocks', $divID);
      
   }
      static function productsToday($divID){
                            
                    $results = \DB::select("SELECT * FROM ProductCalls, totalCsv  where   ProductCalls.Id = totalCsv.CODIGOINTERNO and Date = '" . date("d-m-y")."' order by Calls desc");
                       if (!$results) {
                        echo 'No se pudo ejecutar la consulta: ' . mysql_error();
                        exit;
                    }


                    $reasons = \Lava::DataTable();
                    
                    
                    
                    $reasons->addStringColumn('Productos')
                            ->addNumberColumn('Porcentaje');
                            
                     for ($a = 0; $a < count($results); $a++) {
                                    $reasons->addRow([$results[$a]->TITULO, $results[$a]->Calls]);
                                }
            
            
            


\Lava::PieChart('Productos', $reasons, [
    'title'  => 'Productos accedidos',
    'is3D'   => true,
    'slices' => [
        ['offset' => 0.2],
        ['offset' => 0.25],
        ['offset' => 0.3]
    ]
]);
            $chart = \Lava::PieChart('ProductosAccedidos', $reasons);
            echo \Lava::render('PieChart', 'ProductosAccedidos', $divID);
      
   }


  
}



?>