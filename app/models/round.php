<?php
class round
{
	use Model;

	protected $table = 'round';

	protected $allowedColumns = [
        'roundId',
        'round',
        'active',
	];

    public function getRound(){
        $query = "SELECT round FROM $this->table WHERE active = 1";
        $result = $this->query($query);
        return $result[0] -> round;
    }
}
