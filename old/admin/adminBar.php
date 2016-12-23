<?php

namespace Admin\adminBar;

require_once  $_SERVER["DOCUMENT_ROOT"] . '/autoload.php';


class adminBar{
    
    public static function convert($size)
            {
                $unit=array('b','kb','mb','gb','tb','pb');
                return @round($size/pow(1024,($i=floor(log($size,1024)))),2).' '.$unit[$i];
            }
            
    public  function getBar($rustart){

//echo $twig->render('index.html', array('the' => 'variables', 'go' => 'here'));
    
    
        echo '
         <footer>
            <div class="navbar navbar-inverse navbar-fixed-bottom">
                <div class="container">
                    <div class="navbar-collapse collapse" id="footer-body">
                        
                    </div>
                  	<div class="navbar-header">
                  	
                  	<ul class="nav navbar-nav">

                
        ';




        echo "<li>";
                echo adminBar::timer($rustart);
                echo "</li><li>";
                
                echo adminBar::convert(memory_get_usage(true)); // 123 kb
        
        echo '              </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
        ';

    }

public static function timer($rustart){    
/*
    $app->before(function(){
        $this->rustart = getrusage();

});    
*/

//    $app->after(function(){
        function rutime($ru, $rus, $index) {
            return ($ru["ru_$index.tv_sec"]*1000 + intval($ru["ru_$index.tv_usec"]/1000))  -  ($rus["ru_$index.tv_sec"]*1000 + intval($rus["ru_$index.tv_usec"]/1000));
        }
        
        $ru = getrusage();
        /*
        echo "This process used " . rutime($ru, $rustart, "utime") .
            " ms for its computations\n";
        echo "It spent " . rutime($ru, $rustart, "stime") .
            " ms in system calls\n";
            */
            /*
        $this->time = microtime();
        $this->time = explode(' ', $this->time);
        $this->time = $this->time[1] + $this->time[0];
        $this->finish = $this->time;
        $total_time = round(($this->finish - $this->start), 4);
        echo 'Page generated in '.$total_time.' seconds.';
        */

//});
    
    return "This process used " . rutime($ru, $rustart, "utime") .
            " ms for its computations\n"
            .
            "It spent " . rutime($ru, $rustart, "stime") .
            " ms in system calls\n"
            ;
    }




}
?>