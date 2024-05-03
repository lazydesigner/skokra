<?php
session_start();


if(isset($_GET['post_id'])){
    echo '<script>alert("Continous Payment Failer is Detected ! Please Contact Our Executive to buy Tokens")</script>';
    // header('Location:' . get_url() . 'u/post-promote/' . $_GET['post_id']);
}

include '../routes.php';
include '../backend/user_task.php';

$rows = Get_User_Details::Price_plan();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.6.0/remixicon.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'" async>
    <meta name="description" content="">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <meta name="robots" content="noindex, nofollow">
    <link rel="stylesheet" href="<?= get_url() ?>assets/css/account/common.css">
    <link rel="stylesheet" href="<?= get_url() ?>assets/css/footer.css" defer>
    <link rel="stylesheet" href="<?= get_url() ?>assets/css/respontomobile.css" defer>
    <title>Skokra - Manage your ads</title>
    <style>
        .price-btn {
            width: 100%;
            height: auto;
            padding:2%;
            border-radius: 5px;
            /* border: 1px solid lightgrey; */
        }

        .price-btn button {
            width: 100%;
            height: 40px;
            border: 0;
            border-radius: 5px;
            background-color: dodgerblue;
            color: white;
            font-size: 1.1rem;
            font-weight: 500;
            cursor: pointer;
        }

        .price-flex {
            padding: 2%;
            width: 100%;
            display: flex;
        }

        .payment-btn {
            padding: 2%;
            width: 30%;
            height: auto;
            border: 1px solid lightgrey;
            border-radius: 5px;
            height: fit-content;
        }

        .price-grid {
            width: 70%;
            height: auto;
            padding:0 2% 2% 2%;
        }
        .price-grid p{margin: 0;}

        .price-items {
            width: auto;
            min-height: 50px;
            border: 1px solid lightgrey;
            border-radius: 5px;
            position: relative;
            padding: 1%;
            display: flex;
            align-items: center;
            margin:0 0 2% 0;
            justify-content: space-between;
            cursor: pointer;
        }
        .container h1{
            text-align: center;
            margin: 3% 0;
        }
        @media (min-width:320px) and (max-width:550px) {
            .price-grid,.payment-btn{width: 100%;}
            .price-flex{flex-wrap: wrap;}
        }
    </style>
</head>

<body>
    <?php include './dashboard/dash-nav.php' ?>

    <div class="container">
        <h1>Buy Tokens</h1>
        <div class="price-flex">
            <div class="price-grid">
                <?php foreach ($rows[0] as $row) { ?>
                    <div class="price-items">
                        <div><b><?= $row['number_of_credits'] + $row['free_tokens'] ?> Tokens</b> <br>
                        <?php if($row['free_tokens'] != 0){ ?><b><?= $row['number_of_credits'] .'+'. $row['free_tokens'].' Free' ?></b><?php }?>
                        </div>
                        <div> <?php if($row['free_tokens'] != 0){ ?><p style="text-decoration:line-through;color:grey"><?="Rs ".($row['number_of_credits'] + $row['free_tokens'])*$row['price_per_credit'] ?></p><?php }?>
                       <p style="font-weight: bold;" id="total"><?="Rs ".($row['number_of_credits'])*$row['price_per_credit'] ?></p></div>
                    </div>
                <?php } ?>
            </div>
            <div class="payment-btn">
            <div class="price-itemd" style="padding:4% 1%;border:0;display:flex;justify-content:space-between"><span><b>Total: </b></span> <span id="total_p"><b>0</b></span></div>
                <div class="price-btn">
                    <button>Pay Now</button>
                </div>
            </div>
        </div>
    </div>

    <?php include '../footer.php' ?>
    <?php 
$path = $_SERVER['DOCUMENT_ROOT'] . '/skokra.com/account/dashboard/private-area.php';

    if (file_exists($path)) {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/skokra.com/account/dashboard/private-area.php';
    } else {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/account/dashboard/private-area.php';
    }


?>
    <script src="../assets/js/common.js" defer></script>

    <script>
        const price_items = document.querySelectorAll('.price-items');
        const total = document.querySelectorAll('#total');
        price_items.forEach((items,i)=>{
            items.addEventListener('click',(e)=>{
                price_items.forEach(item=>{item.style.border='1px solid lightgrey'})
                e.target.style.border='1px solid dodgerblue';
                document.getElementById('total_p').innerHTML = '<b>'+ total[i].innerText+'</b>'
                 
            })
        })
    </script>
</body>

</html>