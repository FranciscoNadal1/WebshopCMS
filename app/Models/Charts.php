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
        try{                            
                            $resultado = \DB::select("SELECT * FROM apiCalls order by Date");
                          
        
        
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
        }catch(\Exception  $e){
            echo $e;
            return;
        }
      
   }
   
    static function productsToday($divID){
           try{                         
                            $results = \DB::select("SELECT * FROM ProductCalls, totalCsv  where   ProductCalls.Id = totalCsv.CODIGOINTERNO and Date = '" . date("d-m-y")."' order by Calls desc");
                              
                                  
                              
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
              }catch(\Exception  $e){
                  echo $e;
            return;
            }
   }

    static function CategoriesToday($divID){
           try{                         
                            $resultsCat = \DB::select("SELECT TITULOSUBFAMILIA, SUM(Calls) as Calls FROM ProductCalls, totalCsv  where   ProductCalls.Id = totalCsv.CODIGOINTERNO and Date = '" . date("d-m-y")."' group by TITULOSUBFAMILIA order by Calls asc");
                                                
                            $reasonsCat = \Lava::DataTable();
                            
                            
                            
                            $reasonsCat->addStringColumn('Categorias')
                                    ->addNumberColumn('Llamadas');
                                    
                             for ($a = 0; $a < count($resultsCat); $a++) {
                                            $reasonsCat->addRow([$resultsCat[$a]->TITULOSUBFAMILIA, $resultsCat[$a]->Calls]);
                                        }
                    
        
                \Lava::BarChart('CategoriasAccedidas', $reasonsCat, [
                    'title'  => '',
                    'is3D'   => true,
                    'slices' => [
                        ['offset' => 0.2],
                        ['offset' => 0.25],
                        ['offset' => 0.3]
                    ]
                ]);
                    $chart = \Lava::BarChart('CategoriasAccedidas', $reasonsCat);
                    echo \Lava::render('BarChart', 'CategoriasAccedidas', $divID);
              }catch(\Exception  $e){
                  echo $e;
            return;
            }
   }    
  
}



?>