<?php
/**
 * Created by PhpStorm.
 * User: habar
 * Date: 10.03.2018
 * Time: 13:55
 */
require_once "C:\Users\habar\PhpstormProjects\PHP_Photo_colouring_NN\src\Network.php";
function main()
{
    $net = new Network();
    Network::train($net);
    Network::test($net);
}

try{
    main();
} catch (Exception $e){
    $e->getMessage();
}
