<?php
class student_AD
{
    use Model;
    protected $table1 = 'advertisement';
    protected $table2 = 'company';
    protected $allowedColumns = [
        'CompanyId', 
        'advertisementId',
    ];
    
    function getAdDetails(){
        $query = 
            "SELECT 
                company.Name, 
                advertisement.advertisementId, 
                advertisement.image, 
                advertisement.position
            FROM company
            INNER JOIN advertisement
            ON company.CompanyId = advertisement.CompanyId
            WHERE advertisement.status = 'Active'";

        $result = $this->query($query);
        return $result;
    }

}