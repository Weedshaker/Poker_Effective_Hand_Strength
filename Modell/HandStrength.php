<?php

namespace ownPoker\MainBundle;
require 'Modell/ownPokerCore.php';


class HandStrength{
    
    protected $ahead = 0;
    protected $tied = 0;
    protected $behind = 0;
    protected $hp = array(  'ahead' => array('ahead' => 0, 'tied' => 0, 'behind' => 0), 
                            'tied' => array('ahead' => 0, 'tied' => 0, 'behind' => 0), 
                            'behind' => array('ahead' => 0, 'tied' => 0, 'behind' => 0));
    protected $hpTotal = array('ahead' => 0, 'tied' => 0, 'behind' => 0);
    protected $index = '';
    
    protected $ownPokerCore;
    
    function __construct($players,$stage,$pCards,$tCards){
        $this->ownPokerCore = new \ownPoker\MainBundle\ownPokerCore($players, $stage, $pCards, $tCards);
    }
    
    /*
     * getHandStrength
     * https://en.wikipedia.org/wiki/Poker_Effective_Hand_Strength_%28EHS%29_algorithm
     *  ahead = tied = behind = 0
     *  ourrank = Rank(ourcards, boardcards)
     *  for each case(oppcards) {
     *
     *      opprank = Rank(oppcards, boardcards)
     *      if (ourrank>opprank) ahead += 1
     *      else if (ourrank==opprank) tied += 1
     *      else behind += 1
     *
     *  }
     *  handstrength=(ahead+tied/2)/(ahead+tied+behind)
     *  return(handstrength) 
     */
    public function getHandStrength($pCards = false, $table = false, $handPotential4 = false, $handPotential3 = false){
        if ($pCards !== false && $table !== false) {
            $this->ownPokerCore->pCards = $pCards;
            $this->ownPokerCore->table = $table;
        }else{
            $pCards = $this->ownPokerCore->pCards;
            $table = $this->ownPokerCore->table;
        }

        $ourrank = $this->ownPokerCore->goForRanks();
        $hands = $ourrank;
        $ourrank = $ourrank['ranks'][0];
        $possibleDeck = array_values(array_diff($this->ownPokerCore->initialDeck, $pCards, $table));
        for ($i = 0; $i < count($possibleDeck); $i++) {
            for ($y = $i + 1; $y < count($possibleDeck); $y++) {
                $oCards = array($possibleDeck[$i], $possibleDeck[$y]);
                $opprank = $this->ownPokerCore->goForRanks($oCards, $table);
                $opprank = $opprank['ranks'][0];
                if ($ourrank > $opprank) {
                    $this->ahead++;
                    $this->index = 'ahead';
                }elseif($ourrank == $opprank){
                    $this->tied++;
                    $this->index = 'tied';
                }else{
                    $this->behind++;
                    $this->index = 'behind';
                }
                /*
                 * getHandPotential
                 * https://en.wikipedia.org/wiki/Poker_Effective_Hand_Strength_%28EHS%29_algorithm
                 *  integer array HP[3][3] //initialize to 0
                 *  integer array HPTotal[3] //initialize to 0
                 *  ourrank = Rank(ourcards,boardcards)
                 *  //Consider all two card combinations of the remaining cards for the opponent.
                 *  for each case(oppcards){
                 *
                 *      opprank = Rank(oppcards,boardcards)
                 *      if(ourrank>opprank) index = ahead
                 *      else if(ourrank=opprank) index = tied
                 *      else index = behind
                 *      HPTotal[index] += 1
                 *      // All possible board cards to come.
                 *      for each case(turn,river){ //Final 5-card board
                 *
                 *          board = [boardcards,turn,river]
                 *          ourbest = Rank(ourcards,board)
                 *          oppbest = Rank(oppcards,board)
                 *          if(ourbest>oppbest) HP[index][ahead]+=1
                 *          else if(ourbest=oppbest) HP[index][tied]+=1
                 *          else HP[index][behind]+=1
                 *
                 *      }
                 *  }
                 *  //Ppot: were behind but moved ahead.
                 *  Ppot = (HP[behind][ahead]+HP[behind][tied]/2+HP[tied][ahead]/2)/(HPTotal[behind]+HPTotal[tied])
                 *  //Npot: were ahead but fell behind.
                 *  Npot = (HP[ahead][behind]+HP[tied][behind]/2+HP[ahead][tied]/2)/(HPTotal[ahead]+HPTotal[tied])
                 *  return(Ppot,Npot)
                 */
                if(count($table) < 5 && count($table) > 2 && $handPotential4 === 'true'){
                    $this->hpTotal[$this->index]++;
                    $possibleBoard = array_values(array_diff($possibleDeck, $oCards));
                    for ($x = 0; $x < count($possibleBoard); $x++) {
                        if(count($table) == 3 && $handPotential3 === 'true'){
                            for ($z = $x + 1; $z < count($possibleBoard); $z++) {
                                $tableCards = array_merge($table, array($possibleBoard[$x], $possibleBoard[$z]));
                                $ourbest = $this->ownPokerCore->goForRanks($pCards, $tableCards);
                                $ourbest = $ourbest['ranks'][0];
                                $oppbest = $this->ownPokerCore->goForRanks($oCards, $tableCards);
                                $oppbest = $oppbest['ranks'][0];
                                if ($ourbest > $oppbest) {
                                    $this->hp[$this->index]['ahead']++;
                                }elseif($ourbest == $oppbest){
                                    $this->hp[$this->index]['tied']++;
                                }else{
                                    $this->hp[$this->index]['behind']++;
                                }
                            }
                        }
                        if(count($table) == 4){
                            $tableCards = array_merge($table, array($possibleBoard[$x]));
                            $ourbest = $this->ownPokerCore->goForRanks($pCards, $tableCards);
                            $ourbest = $ourbest['ranks'][0];
                            $oppbest = $this->ownPokerCore->goForRanks($oCards, $tableCards);
                            $oppbest = $oppbest['ranks'][0];
                            if ($ourbest > $oppbest) {
                                $this->hp[$this->index]['ahead']++;
                            }elseif($ourbest == $oppbest){
                                $this->hp[$this->index]['tied']++;
                            }else{
                                $this->hp[$this->index]['behind']++;
                            }
                        }
                    }
                }
            }
        }
        $handstrength = ($this->ahead + $this->tied / 2) / ($this->ahead + $this->tied + $this->behind);
        // getHandPotential
        $Ppot = 0;
        $Npot = 0;
        if(count($table) < 5 && $handPotential4 === 'true'){
            // Ppot: were behind but moved ahead.
            //Ppot = (HP[behind][ahead]+HP[behind][tied]/2+HP[tied][ahead]/2)/(HPTotal[behind]+HPTotal[tied])
            $Ppot = ($this->hp['behind']['ahead'] + $this->hp['behind']['tied'] / 2 + $this->hp['tied']['ahead'] / 2) / ($this->hpTotal['behind'] + $this->hpTotal['tied']);
            // Npot: were ahead but fell behind.
            //Npot = (HP[ahead][behind]+HP[tied][behind]/2+HP[ahead][tied]/2)/(HPTotal[ahead]+HPTotal[tied])
            $Npot = ($this->hp['ahead']['behind'] + $this->hp['tied']['behind'] / 2 + $this->hp['ahead']['tied'] / 2) / ($this->hpTotal['ahead'] + $this->hpTotal['tied']);
        }
        return array('Ppot' => $Ppot,'Npot' => $Npot, 'handstrength' => $handstrength, 'ahead' => $this->ahead, 'tied' => $this->tied, 'behind' => $this->behind, 'hands' => $hands);
    }

}

?>