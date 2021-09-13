<?php
use Illuminate\Support;

use service\PlayerService as PlayerService;
use service\FormatService as FormatService;
require_once (dirname(__DIR__, 1) .'\service\PlayerService.php');
require_once (dirname(__DIR__, 1) .'\service\FormatService.php');
// retrieves & formats data from the database for export
class Exporter {

    function getPlayerStats($search) {
        $PlayerService = new PlayerService();
        $data = $PlayerService->getPlayerStats($search);
        return $data;
    }

    function getPlayers($search) {
        $PlayerService = new PlayerService();
        $data = $PlayerService->getPlayers($search);
        return $data;
    }

    public function format($data, $format = 'html') {
        $FormatService = new FormatService();
        // return the right data format
        switch($format) {
            case 'xml':
                $data =  $FormatService->exportXml($data);
                return $data;
                break;
            case 'json':
                $data =  $FormatService->exportJson($data);
                return $data;
                break;
            case 'csv':
                $data =  $FormatService->exportCsv($data);
                return $data;
                break;
            default: // html
                $data =  $FormatService->exportHTML($data);
                return $data;
                break;
        }
    }
  
}

?>