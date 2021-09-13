<?php 
namespace model;
class ReportModel{
    public function getAllTeam()
    {
        $teamSql = "SELECT * FROM team";
        $data = query($teamSql);
        return $data;
    }

    public function getBestThreePointShooter()
    {
        $sql = "SELECT a.name AS player_name,b.name AS team_name,
                c.age,a.name AS player_number,a.pos,
                c.`3pt`,c.`3pt_attempted`
                FROM `roster` a 
                INNER JOIN `team` b ON b.code = a.team_code
                INNER JOIN `player_totals` c ON c.player_id = a.id
                WHERE c.age >30 AND ((c.3pt/c.3pt_attempted)*100) >35";
        $data = query($sql) ?: [];

        return $data;
      
    }
    public function getBestThreePointShooterByTeam()
    {
        $sql = "SELECT 	a.name,c.3pt,c.3pt_attempted,b.name AS player
        FROM `team`  a
        INNER JOIN `roster`  b ON b.team_code = a.code
        INNER JOIN `player_totals` c ON c.player_id = b.id
        ";
        $data = query($sql) ?: [];

        return $data;
      
    }
}

?>