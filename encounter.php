<?php

class Encounter {

    const RESULT_WINNER = 1;
    const RESULT_LOSER = -1;
    const RESULT_DRAW = 0;
    const RESULT_POSSIBILITIES  = [self::RESULT_WINNER, self::RESULT_LOSER, self::RESULT_DRAW];

    public function probabilityAgainst(int $levelPlayerOne, int $againstLevelPlayerTwo){

        return 1/(1+(10 ** (($againstLevelPlayerTwo - $levelPlayerOne)/400)));
    }


    public function setNewLevel(int &$levelPlayerOne, int $againstLevelPlayerTwo, int $playerOneResult){

        if (!in_array($playerOneResult, self::RESULT_POSSIBILITIES)) {
            trigger_error(sprintf('Invalid result. Expected %s',implode(' or ', self::RESULT_POSSIBILITIES)));
        }
    
        $levelPlayerOne += (int) (32 * ($playerOneResult - $this->probabilityAgainst($levelPlayerOne, $againstLevelPlayerTwo)));
    }
}

$greg = 400;
$jade = 800;

$encounter = new Encounter();
$probabityAgainst = ($encounter->probabilityAgainst($greg, $jade))*100;
echo sprintf('Greg à %.2f%% chance de gagner face a Jade. ',$probabityAgainst);

$encounter->setNewLevel($greg, $jade, $encounter::RESULT_WINNER);
$encounter->setNewLevel($greg, $jade, $encounter::RESULT_LOSER);

echo sprintf('Les niveaux des joueurs ont évolués vers %s pour Greg et %s pour Jade',$greg,$jade);


