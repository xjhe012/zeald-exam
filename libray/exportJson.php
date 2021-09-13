<?php 
namespace library;

class exportJson{
    public function export($data)
    {
        header('Content-type: application/json');
        return json_encode($data);
    }
}

?>