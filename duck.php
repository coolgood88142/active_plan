<?php

class duck{
    public $duck_name = ['白鴨子','黃色小鴨'];
    public $duck_color = ['red','blue'];
    function __construct(){
        print "start";
    }

    function strat($name){
        $duck_array = [];
        // $count = 0;
        foreach($duck_swim as $color){
            foreach($duck_swim as $swim){
                $duck_array[$color] = $swim;
            }
        }
        // echo "鴨子陣列:" . $duck_array;

        foreach($duck_array as $duck){
            if($name==$color){
                echo "有這隻鴨子";
            }
        }
    }

}

class swim extends duck{
    public $duck_swim = ['Y','N'];
    function __construct() {
        parent::__construct();
        strat();

    }
}

$red = new duck();
$red->strat("red");

?>)