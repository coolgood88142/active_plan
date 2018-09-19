<?php

class duck{
    public $duck_name = ['白鴨子','黃色小鴨'];
    public $duck_color = ['red','blue'];
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
            foreach($swim_array as $key => $swim){
                if($name==$color){
                    $name = $name . "是鴨子" . $swim;
                    echo $name;
                    echo "<br/>";
                    break;
                }else{
                    $name = $name . "不是鴨子" . $swim;
                    echo $name;
                    echo "<br/>";
                }
            }
        }
        $fly = new fly();
        $fly->isfly($name);
    }

}

class swim extends duck{
    public $duck_swim = ['會游泳','不會游泳'];
    function __construct() {
        parent::__construct();
        strat();
    }
}

class fly implements duck{
    public $duck_fly = ['Y','N'];
    function isfly($name) {
        $fly_array = $this->duck_fly;
        foreach($fly_array as $key => $fly){
            if($name=="red"){
                echo "red鴨子會飛";
                break;
            }
        }
    }
}

$red = new duck();
$red->strat("red");

$yellow = new duck();
$yellow->strat("yellow");

?>