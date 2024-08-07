<?php
require_once "../classes/dbh.classes.php";
require_once "../classes/ReviewModel.php";
$RevModel = new ReviewModel();

if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_POST['review_id'])){

        $review_id = htmlspecialchars($_POST["review_id"], ENT_QUOTES, 'UTF-8');

        $hide = $RevModel->hideComment($review_id);
        $response = '';
        if($hide != false){
            $response = "success";
        }else{
            $response = "Already hidden";
        }

        echo $response;
    } 
    if(isset($_POST['review_id_unhide'])){
        $review_id = htmlspecialchars($_POST["review_id_unhide"], ENT_QUOTES, 'UTF-8');

        $hide = $RevModel->unhideComment($review_id);
        $response = '';
        if($hide != false){
            $response = "success";
        }else{
            $response = "Already hidden";
        }

        echo $response;
    }

}