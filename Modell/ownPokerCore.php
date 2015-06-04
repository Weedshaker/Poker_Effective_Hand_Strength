<?php

namespace ownPoker\MainBundle;
// Using the PokerCore.php Lib from https://github.com/mrAndersen/PokerAlgorithms.git for Rates
require 'lib/PokerAlgorithms/src/Poker/MainBundle/PokerCore.php';


class ownPokerCore extends \Poker\MainBundle\PokerCore{
    
    // Adjustments to \Poker\MainBundle\PokerCore (make $iterations protected instead of private)
    protected $iterations = 1;
    protected $straightNo = 4;
    protected $probability = Array ('HighCard' =>  50.11, 'Pairs' => 42.26, 'TwoPairs' => 4.75, 'Triples' => 2.11, 'Straight' => 0.39, 'Flush' => 0.196, 'FullHouse' => 0.1441, 'Four' => 0.024, 'StraightFlush' => 0.0015);
    function __construct($players,$stage,$pCards,$tCards){
        parent::__construct($players,$stage,$pCards,$tCards);
        $this->pCards = $pCards;
        $this->table = $tCards;
    }
    // Adjustments to \Poker\MainBundle\PokerCore (make checkFlush protected instead of private)
    protected function checkFlush($doubleSuites)
    {
        if(isset($doubleSuites[5]) || isset($doubleSuites[6]) || isset($doubleSuites[7])){return true;}
    }
    // Adjustments to \Poker\MainBundle\PokerCore (make checkStraight protected instead of private)
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

        $sortedSizes = array_unique($sortedSizes);
        sort($sortedSizes);
        
        $counter = 0;
        for ($i = 1; $i < count($sortedSizes); $i++) {
            if ($sortedSizes[$i-1] + 1 == $sortedSizes[$i]) {
                $counter++;
                if ($counter == $this->straightNo) {
                    return true;
                }
            }else{
                $counter = 0;
            }
        }
        return false;
    }
    // High card
    protected function checkHighCard(){
        //$compareAbleCards = array_merge($this->table,$this->pCards);
        $compareAbleCards = $this->pCards;
        foreach($compareAbleCards as $key=>$val){
            $size = explode('|',$val);
            $sizes[] = $size[0];
            $suite[] = $size[1];
        }
        foreach($sizes as $k=>$v){
            //if($v == 'A' || $v == 'K' || $v == 'Q' || $v == 'J'){
            if($v == 'A' || $v == 'K'){
                return true;
            }
        }
        return false;
    }
    // Ranking: http://en.wikipedia.org/wiki/List_of_poker_hands
    public function goForRates(){
        // get checkHighCard
        $result['HighCard'] = $this->checkHighCard();
        // get PokerCore goForRates result
        $pokerCoreResult = parent::goForRates();
        // filter and fit to true are false
        $result = array_merge($result, $pokerCoreResult['rates']);
        // add Straight flush
        if($result['Straight'] == true && $result['Flush'] == true){
            $result['StraightFlush'] = true;
        }else{
            $result['StraightFlush'] = false;
        }
        // set all to true and false
        $pattern = array('/^[1-9].*/', '/^[0].*/');
        $replace = array(true, false);
        $result = preg_replace($pattern, $replace, $result);
        return $result;
    }
    public function goForRanks($pCards = false, $table = false){
        if ($pCards !== false && $table !== false) {
            $this->pCards = $pCards;
            $this->table = $table;
        }
        $ranks = false;
        $rates = $this->goForRates();
        foreach($rates as $key => $val){
            if(isset($this->probability[$key]) && $val == true){
                $ranks[$key] = 100 / ($this->probability[$key] / $this->probability['StraightFlush']);
            }
        }
        if(is_array($ranks)){
            arsort($ranks);
            // add highcard to other Ranks
            foreach ($ranks as $key => $value) {
                if ($key !== 'HighCard' && isset($ranks['HighCard'])) {
                    $ranks[$key] += $ranks['HighCard'];
                }
                continue;
            }
            $ranks = array_values($ranks);
        }else{
            $ranks = array(0);
        }
        return array('rates' => $rates, 'ranks' => $ranks);
    }
}

?>