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

    public function getRound(){
        $query = "SELECT round FROM $this->table WHERE active = 1 OR CURDATE() BETWEEN startDate AND endDate";
        $result = $this->query($query);
        return $result[0] -> round;
    }
}
