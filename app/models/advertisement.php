<?php
    class advertisement
    {
        
        use Model;

        protected $table = 'advertisement';

        protected $allowedColumns = [
    
                'AdvertisementId',
                'Position',
                'Status',
                'Description',
                'NumOfInterns',
                'WorkingMode',
                'Qualifications',
                'StartDate',
                'EndDate',
                'Image',
                'CompanyId',
                'AssitantId',
        ];
    }