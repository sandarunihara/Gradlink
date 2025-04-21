<?php
class round
{
    use Model;

    protected $table = 'round';

    protected $allowedColumns = [
        'roundId',
        'round',
        'active',
        'from',
        'to'
    ];

    public function findall()
    {
        $query = "SELECT * FROM $this->table";

        $result = $this->query($query);
        return $result;
    }
    public function getRound()
    {
        $query = "SELECT round FROM $this->table WHERE active = 1 OR CURDATE() BETWEEN startDate AND endDate";
        $result = $this->query($query);

        return $result[0]->round;
    }

    public function getActiveRound()
    {
        $query = "SELECT * FROM $this->table WHERE active = 1";
        $result = $this->query($query);
        return $result[0];
    }

    public function update($roundId, $startDate, $endDate, $active, $vacancy)
    {
        $query = "UPDATE $this->table SET startDate = :startDate, endDate = :endDate, active = :active, vacancy = :vacancy WHERE roundId = :roundId";
        $params = [
            'startDate' => $startDate,
            'endDate' => $endDate,
            'roundId' => $roundId,
            'active' => $active,
            'vacancy' => $vacancy
        ];
        return $this->query($query, $params);
    }
    

    public function deactivateAllRoundsExcept($roundId)
    {
        $query = "UPDATE $this->table SET active = 0 WHERE roundId != :roundId";
        return $this->query($query, ['roundId' => $roundId]);

    }

    
    public function getRoundStatus($roundId)
    {
        $query = "SELECT active FROM $this->table WHERE roundId = :roundId";
        $params = ['roundId' => $roundId];
        return $this->query($query, $params)[0]->active;
    }

    public function getRoundById($roundId)
    {
        $query = "SELECT * FROM $this->table WHERE roundId = :roundId";
        $params = ['roundId' => $roundId];
        return $this->query($query, $params)[0];
    }
}
