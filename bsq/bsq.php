<?php
$open = fopen($argv[1], "r");
$clean_grid = [];

if($open){
    while(($gets = fgets($open)) !== false){
        array_push($clean_grid,str_split(trim($gets)));
    }
    array_shift($clean_grid);
}

function bsq(&$clean_grid){
    $grid = $clean_grid;
    $count_lines= count($grid);
    $count_line_elements = count($grid[0]);
    $getmax = 0;

    $axeX = 0;
    $axeY = 0;
    
    for ($y=0; $y < $count_lines; $y++) { 
        for ($x=0; $x < $count_line_elements; $x++) { 
            
            if (!$x || !$y) {
                $a = 0;
                $b = 0;
                $c = 0;
            }else{
                $a = $grid[$y][$x-1] ?? 0;
                $b = $grid[$y-1][$x-1] ?? 0;
                $c = $grid[$y-1][$x] ?? 0;
            }
            
            $current_case = $grid[$y][$x];
            
            if($current_case ==='o'){
                $current_case = 0; 
                $grid[$y][$x] = $current_case;
            }elseif($current_case === '.'){
                $getMin = [$a, $b, $c];
                $value = min($getMin);
                $current_case = $value;

                $current_case++;
                $grid[$y][$x] = $current_case;

                if($current_case > $getmax){
                    $getmax = $current_case;
                    $axeY = $y;
                    $axeX = $x;
                }
            }
        }
    }
    
    $maxY = $getmax;
    
    for($maxY; $maxY > 0; $maxY--){
        $maxX = $getmax;
        $repx = $axeX;
   
        for($maxX; $maxX > 0; $maxX--){
            $clean_grid[$axeY][$repx] = 'x';
            $repx--;
        }
        $axeY--;
    }
    $line ='';
    $counttoprint = $count_lines;
    $tabtoprint = $clean_grid;
    for($i = 0; $i < $counttoprint; $i++){

        $line .= implode('', $tabtoprint[$i]).PHP_EOL;
    }
    echo $line;
}

bsq($clean_grid);
