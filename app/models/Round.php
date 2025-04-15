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
    public function getRound(){
        $query = "SELECT round FROM $this->table WHERE active = 1 OR CURDATE() BETWEEN startDate AND endDate";
        $result = $this->query($query);
        return $result[0] -> round;
    }

    public function update($roundId, $startDate, $endDate, $active)
    {
        $query = "UPDATE $this->table SET startDate = :startDate, endDate = :endDate, active = :active WHERE roundId = :roundId";
        $params = [
            'startDate' => $startDate,
            'endDate' => $endDate,
            'roundId' => $roundId,
            'active' => $active
        ];
        return $this->query($query, $params);
    }
}
