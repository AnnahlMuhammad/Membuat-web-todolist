<?php 

namespace Helper{

    class InputHelper{
        static public function input(string $info){
            echo "$info : ";
            $result = fgets(STDIN);
            return trim($result);
        }
    }

}

?>