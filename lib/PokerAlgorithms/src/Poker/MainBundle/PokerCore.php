<?php

namespace Poker\MainBundle;


class PokerCore
{
    //private $iterations = 1000;
    protected $iterations = 1000;
    public $initialDeck = array(
        '2|♥','3|♥','4|♥','5|♥','6|♥','7|♥','8|♥','9|♥','10|♥','J|♥','Q|♥','K|♥','A|♥',
        '2|♦','3|♦','4|♦','5|♦','6|♦','7|♦','8|♦','9|♦','10|♦','J|♦','Q|♦','K|♦','A|♦',
        '2|♣','3|♣','4|♣','5|♣','6|♣','7|♣','8|♣','9|♣','10|♣','J|♣','Q|♣','K|♣','A|♣',
        '2|♠','3|♠','4|♠','5|♠','6|♠','7|♠','8|♠','9|♠','10|♠','J|♠','Q|♠','K|♠','A|♠'
    );
    private $players = 2;
    private $steadyDeck = array();
    private $stage = '';
    public $pCards = array();
    public $table = array();

    function __construct($players,$stage,$pCards,$tCards)
    {
        $this->players = $players;
        $this->stage = $stage;
        $this->pCards = $pCards;
        $this->table = array();
        $this->tCards = $tCards;
        $this->prepareDeck($stage,$pCards,$tCards);
    }

    private function filterDeck($pCards,$tCards)
    {
        $newDeck = $this->initialDeck;
        foreach($newDeck as $key=>$val){
            if(in_array($val,$pCards) or in_array($val,$tCards)){
                unset($newDeck[$key]);
            }
        }
        return $newDeck;
    }

    private function imitateOtherPlayers($deck)
    {
        for($i = 1;$i <= $this->players*2; $i++){
            unset($deck[array_rand($deck,1)]);
        }
        return $deck;
    }

    private function prepareDeck()
    {
        $this->table = array();
        $newDeck = $this->filterDeck($this->pCards,$this->tCards);
        $newDeck = $this->imitateOtherPlayers($newDeck);
        if($this->stage == 'flop'){
            $card = array_rand($newDeck,1);
            $this->table[] = $newDeck[$card]; unset($newDeck[$card]);
            $card = array_rand($newDeck,1);
            $this->table[] = $newDeck[$card]; unset($newDeck[$card]);
        }

        if($this->stage == 'turn'){
            $card = array_rand($newDeck,1);
            $this->table[] = $newDeck[$card]; unset($newDeck[$card]);
        }

        $this->table = array_merge($this->table,$this->tCards);
        $this->steadyDeck = $newDeck;

        return true;
    }

    private function checkPair($double)
    {
        if($this->checkFour($double)){return true;}
        if($this->checkTriple($double)){return true;}
        if($this->checkDouble($double)){return true;}
        if(isset($double[2]) and $double[2] >= 1){return true;}
    }

    private function checkFullHouse($double)
    {
        if($this->checkTriple($double) and $this->checkDouble($double)){return true;}
        if($this->checkFour($double) and $this->checkPair($double)){return true;}
        if($this->checkFour($double) and $this->checkTriple($double)){return true;}
    }

    private function checkTriple($double)
    {
        if(isset($double[3]) and ($double[3]) >= 1){return true;}
        if($this->checkFour($double)){return true;}
    }

    private function checkFour($double)
    {
        if(isset($double[4])){return true;}
    }

    private function checkDouble($double)
    {
        if($this->checkFour($double)){return true;}
        if(isset($double[2]) and $double[2] >= 2){return true;}
        if(isset($double[3]) and $double[3] > 1){return true;}
        if(isset($double[2]) and isset($double[3]) and $double[2] >= 1 and $double[3] >=1){return true;}
    }

    protected function checkFlush($doubleSuites)
    {
        if(isset($doubleSuites[5])){return true;}
    }

    protected function checkStraight($sizes)
    {
        foreach($sizes as $k=>$v){
            if($v == 'J'){
                $sortedSizes[$k] = 11;
            }elseif($v == 'Q'){
                $sortedSizes[$k] = 12;
            }elseif($v == 'K'){
                $sortedSizes[$k] = 13;
            }elseif($v == 'A'){
                $sortedSizes[$k] = 14;
            }else{
                $sortedSizes[$k] = (int)$v;
            }
        }

        sort($sortedSizes);
        
        if($sortedSizes[0] + 1 == $sortedSizes[1] &&
            $sortedSizes[1] + 1 == $sortedSizes[2] &&
            $sortedSizes[2] + 1 == $sortedSizes[3] &&
            $sortedSizes[3] + 1 == $sortedSizes[4] &&
            $sortedSizes[4] + 1 == $sortedSizes[5]
        ){
            return true;
        }else{
            return false;
        }
    }

    public function test()
    {
        $cards = array('J|♥','J|♦','J|♣','2|♥','2|♠','2|♣');
        foreach($cards as $key=>$val){
            $size = explode('|',$val);
            $sizes[] = $size[0];
        }
        $result = array_count_values($sizes);
        $doubles = array_count_values($result);

        $test = $this->checkFullHouse($doubles);
        return $test;
    }

    public function goForRates()
    {
//        $this->test();
        $pairs = 0; $twoPairs = 0; $triple = 0; $four = 0; $fullhouse = 0; $flush = 0; $straight = 0;
        for($i = 1; $i <= $this->iterations;$i++){
            $result = array(); $sizes = array(); $doubles = array(); $suite = array(); $sortedSizes = array();
            $compareAbleCards = array_merge($this->table,$this->pCards);

            foreach($compareAbleCards as $key=>$val){
                $size = explode('|',$val);
                $sizes[] = $size[0];
                $suite[] = $size[1];
            }

            $result = array_count_values($sizes);
            $doubles = array_count_values($result);

            $suites = array_count_values($suite);
            $doubleSuites = array_count_values($suites);




            if($this->checkFour($doubles)){$four += 1;}
            if($this->checkFullHouse($doubles)){$fullhouse += 1;}
            if($this->checkTriple($doubles)){$triple += 1;}
            if($this->checkDouble($doubles)){$twoPairs += 1;}
            if($this->checkPair($doubles)){$pairs += 1;}
            if($this->checkFlush($doubleSuites)){$flush +=1;}
            if($this->checkStraight($sizes)){$straight +=1;}


            $log[] = $compareAbleCards;
            $this->prepareDeck();
        }
        $res['rates']['Pairs'] = $pairs / $this->iterations * 100;
        $res['rates']['TwoPairs'] = $twoPairs / $this->iterations * 100;
        $res['rates']['Triples'] = $triple / $this->iterations * 100;
        $res['rates']['Straight'] = $straight / $this->iterations * 100;
        $res['rates']['Flush'] = $flush / $this->iterations * 100;
        $res['rates']['FullHouse'] = $fullhouse / $this->iterations * 100;
        $res['rates']['Four'] = $four / $this->iterations * 100;



        $res['log'] = $log;

        return $res;
    }


}