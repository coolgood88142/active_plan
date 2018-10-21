<?php

class duck{
    public $duck_name = ['白鴨子','黃色小鴨'];
    public $duck_fly = ['Y','N'];
    public $can_fly;

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
            $text="";
            if($name==$color){
                $text = $name . "是鴨子" . $swim_array[0];
                echo $text;
                echo "<br/>";
                    
            }else{
                $text = $name . "不是鴨子" . $swim_array[1];
                echo $text;
                echo "<br/>";
            }
            break;
        }

        $isfly_text="";
        $fly_array = $this->duck_fly;
        if($name=="red"){          
            $isfly_text = $this->isfly($name,$fly_array[0]);
        }else{
            $isfly_text = $this->isfly($name,$fly_array[1]);
        }

    }

    public function isfly($name,$duckfly){
        if($duckfly=='Y'){
            $this->can_fly = new flywithwings();
            $this->can_fly = $this->can_fly->flywithwings();
        }else{
            $this->can_fly = new flynoway();
            $this->can_fly = $this->can_fly->flynoway();
        }
        echo $name . "鴨子" . $this->can_fly;
        
    }

}

class swim extends duck{
    public $duck_color = ['red','blue'];
    public $duck_swim = ['會游泳','不會游泳'];
    function __construct() {
        parent::__construct();
    }
}

class flywithwings implements fly{   
    public function flywithwings(){
        return "會飛";
    }

    public function flynoway(){
        return;
    }
}

class flynoway implements fly{
    public function flywithwings(){
        return;
    }

    public function flynoway(){
        return "不會飛";
    }
}

interface fly{
    public function flywithwings();
    
    public function flynoway();
}

$red = new swim();
$red->strat("red");

echo "<br/>";

$yellow = new swim();
$yellow->strat("yellow");

?>