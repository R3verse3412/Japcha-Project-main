<?php
    require_once 'classes/dbh.classes.php';
    require_once 'classes/TermsAndConditionModel.php';
    $term_model = new TermsModel();
    $terms = $term_model->getTerms();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms & Conditions</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
</head>
<style>
</style>
<body>
 

<div class="container mt-5 pb-4">
    <h2 class="text-center mb-4">Terms and Conditions</h2>

    <div class="card">
        <div class="card-body">

            <h4 class="card-title">Conditions of Use</h4>
            <p class="card-text">
            <?=$terms['condition_']?>
            </p>

            <h4 class="card-title">Privacy Policy</h4>
            <p class="card-text">
            <?=$terms['privacy']?>
            </p>

            <h4 class="card-title">Age Restriction</h4>
            <p class="card-text">
            <?=$terms['restrictions']?>
            </p>

            <h4 class="card-title">Disputes</h4>
            <p class="card-text">
                <?=$terms['disputes']?>
            </p>

            <h4 class="card-title">Indemnification</h4>
            <p class="card-text">
                <?=$terms['idemnification']?>
            </p>

            <h4 class="card-title">Limitation on Liability</h4>
            <p class="card-text">
                <?=$terms['liability']?>
            </p>
        </div>
    </div>
</div>

    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  
</body>
</html>
