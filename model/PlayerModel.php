<?php 
namespace model;
class PlayerModel{
    public function getPlayerStats($where)
    {
        $sql = "
            SELECT roster.name, player_totals.*
            FROM player_totals
                INNER JOIN roster ON (roster.id = player_totals.player_id)
            WHERE $where";
        $stmt->bind_param("sss", $firstname, $lastname, $email);
        $data = query($sql) ?: [];

        return $data;
    }

    public function getPlayer($where)
    {
        $sql = "
            SELECT roster.*
            FROM roster
            WHERE $where";
        $data = query($sql) ?: [];

        return $data;
      
    }
}

?>