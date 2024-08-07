<?php
require_once "../classes/dbh.classes.php";
require_once "../classes/TermsAndConditionModel.php";

$terms_model = new TermsModel();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['liablity'])){
        $liability = htmlspecialchars($_POST["liablity"], ENT_QUOTES, 'UTF-8');
        $update = $terms_model->updateLiability($liability);

        $response = '';

        if($update != false){
            $response = 'succeess';
        }else{
            $response = 'error';
        }

        echo  $response;

    }

    if(isset($_POST['idemnification'])){
        $idemnification = htmlspecialchars($_POST["idemnification"], ENT_QUOTES, 'UTF-8');
        $update = $terms_model->updateIdemnification($idemnification);

        $response = '';

        if($update != false){
            $response = 'succeess';
        }else{
            $response = 'error';
        }

        echo  $response;

    }

    if(isset($_POST['dispute'])){
        $dispute = htmlspecialchars($_POST["dispute"], ENT_QUOTES, 'UTF-8');
        $update = $terms_model->updateDispute($dispute);

        $response = '';

        if($update != false){
            $response = 'succeess';
        }else{
            $response = 'error';
        }

        echo  $response;

    }


    if(isset($_POST['restrictions'])){
        $restrictions = htmlspecialchars($_POST["restrictions"], ENT_QUOTES, 'UTF-8');
        $update = $terms_model->updateRestrictions($restrictions);

        $response = '';

        if($update != false){
            $response = 'succeess';
        }else{
            $response = 'error';
        }

        echo  $response;

    }


    if(isset($_POST['privacy'])){
        $privacy = htmlspecialchars($_POST["privacy"], ENT_QUOTES, 'UTF-8');
        $update = $terms_model->updatePrivacy($privacy);

        $response = '';

        if($update != false){
            $response = 'succeess';
        }else{
            $response = 'error';
        }

        echo  $response;

    }

    if(isset($_POST['condition'])){
        $condition = htmlspecialchars($_POST["condition"], ENT_QUOTES, 'UTF-8');
        $update = $terms_model->updateCondition($condition);

        $response = '';

        if($update != false){
            $response = 'succeess';
        }else{
            $response = 'error';
        }

        echo  $response;

    }


    if(isset($_POST['title_'])){
        $title = htmlspecialchars($_POST["title_"], ENT_QUOTES, 'UTF-8');
        $update = $terms_model->updateTitle($title);

        $response = '';

        if($update != false){
            $response = 'succeess';
        }else{
            $response = 'error';
        }

        // echo  $response;
        echo "success";

    }
}