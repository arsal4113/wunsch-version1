<?php

namespace Feeder\View\Cell;

use App\Application;
use Cake\I18n\Time;
use Cake\View\Cell;
use Feeder\Model\Table\FeederFizzyBubblesTable;

/**
 * SurpriseItems cell
 *
 * @property FeederFizzyBubblesTable $FeederFizzyBubbles
 */
class FizzyBubblesCell extends Cell
{
    /**
     * display
     */
    public function display()
    {
        $this->loadModel('Feeder.FeederFizzyBubbles');
        $feederFizzyBubbles = $this->FeederFizzyBubbles->find()
            ->where([
                'FeederFizzyBubbles.active' => true,
                'OR' => [['FeederFizzyBubbles.use_on' => 'BOTH'], ['FeederFizzyBubbles.use_on' => 'HOMEPAGE']]
            ])
            ->orderAsc('sort_order')
            ->cache('fizzy_both_homepage', Application::SHORT_TERM_CACHE)
            ->toArray();

        $time = Time::now();
        $remove = [];
        foreach($feederFizzyBubbles as $fizzyBubble){
            if(($fizzyBubble->start_time > $time || $fizzyBubble->end_time < $time) &&
                ($fizzyBubble->start_time !== null && $fizzyBubble !== null)){
                array_push($remove, $fizzyBubble);
            }
        }
        if(!empty($remove)){
            $feederFizzyBubbles = array_diff($feederFizzyBubbles, $remove);
            $feederFizzyBubbles = array_values($feederFizzyBubbles);
        }

        $this->set('fizzyBubbles', $feederFizzyBubbles);
    }
}
