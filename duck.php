<?php

class duck implements fly{
    public $duck_name = ['白鴨子','黃色小鴨'];
    public $duck_fly = ['Y','N'];
    public function flywithwings(){
        return "會飛";
    }

    public function flynoway(){
        return "不會飛";
    }

    
    function __construct(){
        print "start";
        echo "<br/>";
    }

    function strat($name){
        $color_array = $this->duck_color;
        $swim_array = $this->duck_swim;
        // $count = 0;
        // foreach($duck_swim as $color){
        //     foreach($duck_swim as $swim){
        //         $duck_array[$color] = $swim;
        //     }
        // }
        // echo "鴨子陣列:" . $duck_array;

        foreach($color_array as $key => $color){
            
                if($name==$color){
                    $name = $name . "是鴨子" . $swim_array[0];
                    echo $name;
                    echo "<br/>";
                    break;
                }else{
                    $name = $name . "不是鴨子" . $swim_array[1];
                    echo $name;
                    echo "<br/>";
            }
        }

        if($name=="red"){
            isfly($name,$duck_fly[0]);
        }else{
            isfly($name,$duck_fly[1]);
        }

    }

    function isfly($name,$duck_fly){
        $can_fly="";
        if($duck_fly=='Y'){
            $can_fly = $this->flywithwings();
        }else{
            $can_fly = $this->flynoway();
        }
        echo $name . "鴨子" . $can_fly;
    }

}

class swim extends duck{
    public $duck_color = ['red','blue'];
    public $duck_swim = ['會游泳','不會游泳'];
    function __construct() {
        parent::__construct();
    }
}

interface fly{
    public function flywithwings();
    public function flynoway();
}

$red = new swim();
$red->strat("red");

$yellow = new swim();
$yellow->strat("yellow");

?>