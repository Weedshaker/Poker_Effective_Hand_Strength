<?php
    header('content-type:application/json');
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    ini_set('max_execution_time', 700);

    require 'Modell/HandStrength.php';

    /*private $initialDeck = array(
        '2|♥','3|♥','4|♥','5|♥','6|♥','7|♥','8|♥','9|♥','10|♥','J|♥','Q|♥','K|♥','A|♥',
        '2|♦','3|♦','4|♦','5|♦','6|♦','7|♦','8|♦','9|♦','10|♦','J|♦','Q|♦','K|♦','A|♦',
        '2|♣','3|♣','4|♣','5|♣','6|♣','7|♣','8|♣','9|♣','10|♣','J|♣','Q|♣','K|♣','A|♣',
        '2|♠','3|♠','4|♠','5|♠','6|♠','7|♠','8|♠','9|♠','10|♠','J|♠','Q|♠','K|♠','A|♠'
    );*/
    // dummy variables
    $players = 2;
    $stage = 'testing';
    $pCards = array('A|♦','5|♥');
    $tCards = array('3|♦','8|♣','8|♦');

    // only wars needed for rates are $pCards and $tCards
    $pokerAlgorithms = new \ownPoker\MainBundle\HandStrength($players, $stage, $pCards, $tCards);

    //print_r($pokerAlgorithms->getHandStrength($pCards, $tCards, false, false));
    if($_POST['pCards'] && $_POST['tCards']){
        echo json_encode($pokerAlgorithms->getHandStrength($_POST['pCards'], $_POST['tCards'], $_POST['Ppot'], $_POST['Npot']));
    }else{
        echo json_encode('noData');
    }
    exit();
?>