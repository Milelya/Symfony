<?php

namespace App\Controller;

use App\Entity\Activity;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class StatisticsController extends AbstractController
{
    /**
     * @Route("/statistics", name="statistics")
     */
    public function index()
    {
        return $this->render('statistics/index.html.twig', [
            'controller_name' => 'StatisticsController',
        ]);
    }
    /**
     * @Route("/statistics/week",name="week_resume")
     */
    public function weekResume(){
        $activityFinal=StatisticsController::findByDateFormat('W',$this->getUser()->getEmail());
        $activityPrimary=[];
        $activitySecondary=[];
        $activityTertiary=[];
        $i=0;
            foreach($activityFinal as $activity){
            if(count($activityFinal)>2){
                if($i<count($activityFinal)/3){
                    array_push($activityPrimary,[

                        'activityName'=>$activity['activityName'],
                        'duration'=>$activity['duration'],
                        'percent'=>$activity['percent']
                    ]);
                }
                elseif($i<(count($activityFinal)/3)*2){
                    array_push($activitySecondary,[
                        'activityName'=>$activity['activityName'],
                        'duration'=>$activity['duration'],
                        'percent'=>$activity['percent']
                    ]);
                }
                else{
                    array_push($activityTertiary,[
                        'activityName'=>$activity['activityName'],
                        'duration'=>$activity['duration'],
                        'percent'=>$activity['percent']
                    ]);
                }
            }
            elseif(count($activityFinal)===2){
                if($i===0){
                    array_push($activityPrimary,[
                        'activityName'=>$activity['activityName'],
                        'duration'=>$activity['duration'],
                        'percent'=>$activity['percent']
                    ]);
                }else{
                    array_push($activitySecondary,[
                        'activityName'=>$activity['activityName'],
                        'duration'=>$activity['duration'],
                        'percent'=>$activity['percent']
                    ]);
                }
            }
            else{
                array_push($activityPrimary,[
                    'activityName'=>$activity['activityName'],
                    'duration'=>$activity['duration'],
                    'percent'=>$activity['percent']
                ]);;
            }
            $i++;
        }
        return $this->render('statistics/weekResume.html.twig', [
            'controller_name' => 'MainController',
            'activityPrimary'=>$activityPrimary,
            'activitySecondary'=>$activitySecondary,
            'activityTertiary'=>$activityTertiary,
        ]);
    }
    /**
     * @Route("/statistics/month",name="month_resume")
     */
    public function monthResume(){
        $activityFinal=StatisticsController::findByDateFormat('m',$this->getUser()->getEmail());
        $activityPrimary=[];
        $activitySecondary=[];
        $activityTertiary=[];
        $i=0;
            foreach($activityFinal as $activity){
            if(count($activityFinal)>2){
                if($i<count($activityFinal)/3){
                    array_push($activityPrimary,[

                        'activityName'=>$activity['activityName'],
                        'duration'=>$activity['duration'],
                        'percent'=>$activity['percent']
                    ]);
                }
                elseif($i<(count($activityFinal)/3)*2){
                    array_push($activitySecondary,[
                        'activityName'=>$activity['activityName'],
                        'duration'=>$activity['duration'],
                        'percent'=>$activity['percent']
                    ]);
                }
                else{
                    array_push($activityTertiary,[
                        'activityName'=>$activity['activityName'],
                        'duration'=>$activity['duration'],
                        'percent'=>$activity['percent']
                    ]);
                }
            }
            elseif(count($activityFinal)===2){
                if($i===0){
                    array_push($activityPrimary,[
                        'activityName'=>$activity['activityName'],
                        'duration'=>$activity['duration'],
                        'percent'=>$activity['percent']
                    ]);
                }else{
                    array_push($activitySecondary,[
                        'activityName'=>$activity['activityName'],
                        'duration'=>$activity['duration'],
                        'percent'=>$activity['percent']
                    ]);
                }
            }
            else{
                array_push($activityPrimary,[
                    'activityName'=>$activity['activityName'],
                    'duration'=>$activity['duration'],
                    'percent'=>$activity['percent']
                ]);;
            }
            $i++;
        }
        return $this->render('statistics/monthResume.html.twig', [
            'controller_name' => 'MainController',
            'activityPrimary'=>$activityPrimary,
            'activitySecondary'=>$activitySecondary,
            'activityTertiary'=>$activityTertiary,
        ]);
    }
    /**
     * @Route("/statistics/year",name="year_resume")
     */
    public function yearResume(){
        $activityFinal=StatisticsController::findByDateFormat('Y',$this->getUser()->getEmail());
        $activityPrimary=[];
        $activitySecondary=[];
        $activityTertiary=[];
        $i=0;
            foreach($activityFinal as $activity){
            if(count($activityFinal)>2){
                if($i<count($activityFinal)/3){
                    array_push($activityPrimary,[

                        'activityName'=>$activity['activityName'],
                        'duration'=>$activity['duration'],
                        'percent'=>$activity['percent']
                    ]);
                }
                elseif($i<(count($activityFinal)/3)*2){
                    array_push($activitySecondary,[
                        'activityName'=>$activity['activityName'],
                        'duration'=>$activity['duration'],
                        'percent'=>$activity['percent']
                    ]);
                }
                else{
                    array_push($activityTertiary,[
                        'activityName'=>$activity['activityName'],
                        'duration'=>$activity['duration'],
                        'percent'=>$activity['percent']
                    ]);
                }
            }
            elseif(count($activityFinal)===2){
                if($i===0){
                    array_push($activityPrimary,[
                        'activityName'=>$activity['activityName'],
                        'duration'=>$activity['duration'],
                        'percent'=>$activity['percent']
                    ]);
                }else{
                    array_push($activitySecondary,[
                        'activityName'=>$activity['activityName'],
                        'duration'=>$activity['duration'],
                        'percent'=>$activity['percent']
                    ]);
                }
            }
            else{
                array_push($activityPrimary,[
                    'activityName'=>$activity['activityName'],
                    'duration'=>$activity['duration'],
                    'percent'=>$activity['percent']
                ]);;
            }
            $i++;
        }
        return $this->render('statistics/yearResume.html.twig', [
            'controller_name' => 'MainController',
            'activityPrimary'=>$activityPrimary,
            'activitySecondary'=>$activitySecondary,
            'activityTertiary'=>$activityTertiary,
        ]);
    }
    /**
     * @Route("/statistics/alltime",name="alltime_resume")
     */
    public function alltimeResume(){
        $activityFinal=StatisticsController::findByDateFormat('all',$this->getUser()->getEmail());
        $activityPrimary=[];
        $activitySecondary=[];
        $activityTertiary=[];
        $i=0;
            foreach($activityFinal as $activity){
            if(count($activityFinal)>2){
                if($i<count($activityFinal)/3){
                    array_push($activityPrimary,[

                        'activityName'=>$activity['activityName'],
                        'duration'=>$activity['duration'],
                        'percent'=>$activity['percent']
                    ]);
                }
                elseif($i<(count($activityFinal)/3)*2){
                    array_push($activitySecondary,[
                        'activityName'=>$activity['activityName'],
                        'duration'=>$activity['duration'],
                        'percent'=>$activity['percent']
                    ]);
                }
                else{
                    array_push($activityTertiary,[
                        'activityName'=>$activity['activityName'],
                        'duration'=>$activity['duration'],
                        'percent'=>$activity['percent']
                    ]);
                }
            }
            elseif(count($activityFinal)===2){
                if($i===0){
                    array_push($activityPrimary,[
                        'activityName'=>$activity['activityName'],
                        'duration'=>$activity['duration'],
                        'percent'=>$activity['percent']
                    ]);
                }else{
                    array_push($activitySecondary,[
                        'activityName'=>$activity['activityName'],
                        'duration'=>$activity['duration'],
                        'percent'=>$activity['percent']
                    ]);
                }
            }
            else{
                array_push($activityPrimary,[
                    'activityName'=>$activity['activityName'],
                    'duration'=>$activity['duration'],
                    'percent'=>$activity['percent']
                ]);;
            }
            $i++;
        }
        return $this->render('statistics/alltimeResume.html.twig', [
            'controller_name' => 'MainController',
            'activityPrimary'=>$activityPrimary,
            'activitySecondary'=>$activitySecondary,
            'activityTertiary'=>$activityTertiary,
        ]);
    }


    public function findByDateFormat($string,$userEmail){
        $repoActivity=$this->getDoctrine()->getRepository(Activity::class);
        $user=$userEmail;
        $activityByUser=$repoActivity->findBy(
            ['email'=>$user]
        );
        $allActivityDuration=0;
        $todayActivity=[];
        foreach($activityByUser as $activity){
            if($activity->getEndDate()!== null){
                if($string!=="all"){
                    if(date_format($activity->getEndDate(),$string)===date_format(new DateTime(),$string)){
                        $startStamp=$activity->getStartDate()->getTimeStamp();
                        $endStamp=$activity->getEndDate()->getTimeStamp();
                        $duration=$endStamp-$startStamp;
                        array_push($todayActivity,[
                            'activityName'=>strtolower($activity->getActivityName()),
                            'duration'=>$duration]);
                        $allActivityDuration+=$duration;
                    }
                }else{
                    $startStamp=$activity->getStartDate()->getTimeStamp();
                        $endStamp=$activity->getEndDate()->getTimeStamp();
                        $duration=$endStamp-$startStamp;
                        array_push($todayActivity,[
                            'activityName'=>strtolower($activity->getActivityName()),
                            'duration'=>$duration]);
                        $allActivityDuration+=$duration;
                }
            }
        }

        $dayActivity=[];
        $activityGlobalNameColumn = array_column($todayActivity, 'activityName');
        $uniqueActivityColumn=array_unique($activityGlobalNameColumn);
        $activityColumn=[];
        foreach($uniqueActivityColumn as $activity){
            array_push($activityColumn,$activity);
        }
        if(count($activityColumn)>0){
            for($a=0;$a<count($activityColumn);$a++){
                $totalDuration=0;
                for($b=0;$b<count($todayActivity);$b++){
                    if($todayActivity[$b]['activityName']===$activityColumn[$a]){
                            $totalDuration+=$todayActivity[$b]['duration'];
                    }
                }
                array_push($dayActivity,['activityName'=>$activityColumn[$a],'duration'=>$totalDuration]);
            }
        }
        
        
        $dayActivityFinal=[];
        if($dayActivity){
            $activityNameColumn = array_column($dayActivity, 'activityName');
            $durationColumn = array_column($dayActivity, 'duration');
            array_multisort($durationColumn, SORT_DESC,$activityNameColumn, SORT_ASC,  $dayActivity);
            foreach($dayActivity as $activity){
                $textDuration="";
                if($activity['duration']>=3600){
                    $hourRest=$activity['duration']%3600;
                    $textDuration.=((int)($activity['duration']/3600))."H";
                    if($hourRest>=60){
                        $minRest=$hourRest%60;
                        $textDuration.=" ".((int)($hourRest/60))."min ".$minRest."s";
                    }else{
                        $textDuration+="0min "+$hourRest+"s";
                    }
                }elseif($activity['duration']>=60){
                    $minRest=$activity['duration']%60;
                    $textDuration.=((int)($activity['duration']/60))."min ".$minRest."s";
                
                }else{
                    $textDuration.=$activity['duration']."s";
                }
                array_push($dayActivityFinal,[
                    'activityName'=>$activity['activityName'],
                    'duration'=>$textDuration,
                    'percent'=>($activity['duration']*100/$allActivityDuration)+40
                ]);
            }
        }
        return $dayActivityFinal;
    }

    
}
