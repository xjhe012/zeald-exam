<?php
namespace service;
require_once (dirname(__DIR__, 1) .'/model/ReportModel.php');
use model\ReportModel;
class ReportService {
    public function __construct(){
        $this->model = new ReportModel;
    }

    public function getAllTeam()
    {
        $data = $this->model->getAllTeam();
        return $data;

    }

    public function getBestThreePointShooter()
    {
        $data = $this->model->getBestThreePointShooter();
        return $data;
    }

    public function getBestThreePointShooterByTeam()
    {
        $data = $this->model->getBestThreePointShooterByTeam();
        $reformat_data = array();
        $final_data = array();

        foreach($data as $key => $val){
            $points = isset( $reformat_data[$val['name']]) ?  $reformat_data[$val['name']]['3pt'] : 0;
            $points_attempted = isset( $reformat_data[$val['name']]) ?  $reformat_data[$val['name']]['3pt_attempted'] : 0;
            !isset( $reformat_data[$val['name']]['contribute']) ?  $reformat_data[$val['name']]['contribute'] =0:'';
            !isset( $reformat_data[$val['name']]['notcontribute']) ?  $reformat_data[$val['name']]['notcontribute'] =0:'';
            $reformat_data[$val['name']]['team'] =$val['name'];
            $reformat_data[$val['name']]['3pt'] = $points + $val['3pt'];
            $reformat_data[$val['name']]['3pt_attempted'] = $points_attempted + $val['3pt_attempted'];
            if($val['3pt'] != 0 ){ $reformat_data[$val['name']]['contribute']++; }
            if($val['3pt'] == 0 ){ $reformat_data[$val['name']]['notcontribute']++; }
            
        }
        $ctr = 0;
        foreach($reformat_data as $a => $b){
            $final_data[$ctr]['team'] =$b['team'];
            $final_data[$ctr]['3pt'] =$b['3pt'];
            $final_data[$ctr]['3pt_attempted'] =$b['3pt_attempted'];
            $final_data[$ctr]['accuracy'] =number_format((float)(($b['3pt']/$b['3pt_attempted'])*100), 2, '.', '');;
            $final_data[$ctr]['contribute'] =$b['contribute'];
            $final_data[$ctr]['notcontribute'] =$b['notcontribute'];
            $ctr++;
        }
        return $final_data;
    }
}
?>