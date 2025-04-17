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


        public function findAllReviewed()
        {
            $query = "SELECT complaint.*, 
                 company.Name AS CompanyName, 
                 student.Name AS StudentName,
                 complaint.CreatedAt AS CreatedAt,
                 complaint.Status AS ComplaintStatus
          FROM $this->table 
          LEFT JOIN company ON complaint.CompanyId = company.CompanyId
          LEFT JOIN student ON complaint.StudentId = student.StudentId
          WHERE complaint.Status = 'Reviewed' 
          ORDER BY complaint.CreatedAt DESC";
            $result = $this->query($query);
            return $result;
        }

        public function markReviewed($id)
        {
            $query = "UPDATE $this->table SET Status = 'Reviewed' WHERE ComplaintId = :id";
            return $this->query($query, ['id' => $id]);
            // return $result;

        }

        public function addReply($id, $reply)
        {
            $query = "UPDATE $this->table SET reply = :reply, Status = 'Reviewed' WHERE ComplaintId = :id";
            $params = [
                'reply' => $reply,
                'id' => $id
            ];
            return $this->query($query, $params);
        }
        
    }