<?php

namespace App\Controller;

use App\Entity\Activity;
use App\Repository\ActivityRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\Length;

class MainController extends AbstractController
{
    /**
     * @Route("/main", name="main")
     */
    public function index()
    {
        $dayActivityFinal=MainController::findByDateFormat('d',$this->getUser()->getEmail());
        $dayActivityPrimary=[];
        $dayActivitySecondary=[];
        $dayActivityTertiary=[];
        $i=0;
            foreach($dayActivityFinal as $activity){
            if(count($dayActivityFinal)>2){
                if($i<count($dayActivityFinal)/3){
                    array_push($dayActivityPrimary,[

                        'activityName'=>$activity['activityName'],
                        'duration'=>$activity['duration'],
                        'percent'=>$activity['percent']
                    ]);
                }
                elseif($i<(count($dayActivityFinal)/3)*2){
                    array_push($dayActivitySecondary,[
                        'activityName'=>$activity['activityName'],
                        'duration'=>$activity['duration'],
                        'percent'=>$activity['percent']
                    ]);
                }
                else{
                    array_push($dayActivityTertiary,[
                        'activityName'=>$activity['activityName'],
                        'duration'=>$activity['duration'],
                        'percent'=>$activity['percent']
                    ]);
                }
            }
            elseif(count($dayActivityFinal)===2){
                if($i===0){
                    array_push($dayActivityPrimary,[
                        'activityName'=>$activity['activityName'],
                        'duration'=>$activity['duration'],
                        'percent'=>$activity['percent']
                    ]);
                }else{
                    array_push($dayActivitySecondary,[
                        'activityName'=>$activity['activityName'],
                        'duration'=>$activity['duration'],
                        'percent'=>$activity['percent']
                    ]);
                }
            }
            else{
                array_push($dayActivityPrimary,[
                    'activityName'=>$activity['activityName'],
                    'duration'=>$activity['duration'],
                    'percent'=>$activity['percent']
                ]);;
            }
            $i++;
        }
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'dayActivityPrimary'=>$dayActivityPrimary,
            'dayActivitySecondary'=>$dayActivitySecondary,
            'dayActivityTertiary'=>$dayActivityTertiary,
        ]);
    }
    /**
     * 
     * @Route("/main/create",name="create_activity")
     * 
     */
    public function createActivity(EntityManagerInterface $manager,Request $request) :
    Response {
        $user = $this->getUser()->getEmail();
        $activity=new Activity();
        $activity->setEmail($user);
        $array=json_decode($request->getContent(),true);
        $activity->setActivityName($array['activityName']);
        $activity->setStartDate(new DateTime());
        $activity->setEndDate(null);
        $manager->persist($activity);
        $manager->flush();
        return $this->json(['code'=>200,'user'=>$user],200);
    }
    /**
     * 
     * @Route("/main/end",name="end_activity")
     * 
     */
    public function endActivity(EntityManagerInterface $manager,Request $request) :
    Response {
        $user = $this->getUser()->getEmail();
        $repoActivity=$this->getDoctrine()->getRepository(Activity::class);
        $lastActivity=$repoActivity->findOneBy(
            ['email'=>$user],
            ['id'=>'DESC'],
        );
        
        $lastActivity->setEndDate(new DateTime());
        $manager->flush();
        return $this->json(['code'=>200,'user'=>$user],200);
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
                if(date_format($activity->getEndDate(),$string)===date_format(new DateTime(),$string)){
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
