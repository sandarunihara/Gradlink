<?php
    class complaint
    {
        
        use Model;

        protected $table = 'complaint';

        protected $allowedColumns = [
            'ComplaintId',
            'Topic',
            'Description',
            'Status',
            'CompanyId',
            'StudentId',
            'CreatedAt',
            'reply'
        ];

        public function findAllNotReviewed()
        {
            $query = "SELECT complaint.*, 
                 company.Name AS CompanyName, 
                 student.Name AS StudentName,
                 complaint.CreatedAt AS CreatedAt,
                 complaint.Status AS ComplaintStatus
          FROM $this->table 
          LEFT JOIN company ON complaint.CompanyId = company.CompanyId
          LEFT JOIN student ON complaint.StudentId = student.StudentId
          WHERE complaint.Status = 'notReviewed' 
          ORDER BY complaint.CreatedAt DESC";
            $result = $this->query($query);
            return $result;
        }


    }