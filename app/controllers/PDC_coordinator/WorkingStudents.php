
<?php
class WorkingStudents
{
    use Controller;
    public function index()
    {
        $studentadvertisementModel = new student_advertisement;
        $studentModel = new student;
        $advertisementModel = new C_Advertisement;
        $companyModel = new company;
        $recrutedStudentsModel = new student_company;

        $data = $studentadvertisementModel->find(['JobStatus' => "Confirmed"]);

        if ($data == false || empty($data)) {
            $this->view('Coordinator/Application/workingStudents');
        } else {
            $applicationData = [];

            foreach ($data as $appdetail) {
                $student = $studentModel->findStudent($appdetail->StudentId);
                $studentName = (!empty($student) && isset($student[0]->Name)) ? $student[0]->Name : 'Unknown Student';
                $studentDegree = (!empty($student) && isset($student[0]->DegreeName)) ? $student[0]->DegreeName : 'Unknown degree name';

                $advertisement = $advertisementModel->find($appdetail->AdvertisementId);
                $advertisementPosition = (!empty($advertisement) && isset($advertisement[0]->position)) ? $advertisement[0]->position : 'Unknown Position';
                $companyID = (!empty($advertisement) && isset($advertisement[0]->CompanyId)) ? $advertisement[0]->CompanyId : 'Unknown Company';

                $company = $companyModel->findById($companyID);
                $companyName = (!empty($company) && isset($company[0]->Name)) ? $company[0]->Name : 'Unknown Company';

                $recrutedStudent = $recrutedStudentsModel->findByStudentId(['StudentId' => $appdetail->StudentId]);
                $startDate = (!empty($recrutedStudent) && isset($recrutedStudent[0]->StartDate)) ? $recrutedStudent[0]->StartDate : 'Unknown Start Date';
                $endDate = (!empty($recrutedStudent) && isset($recrutedStudent[0]->EndDate)) ? $recrutedStudent[0]->EndDate : 'Unknown End Date';

                $applicationData[] = [
                    'student_id' => $appdetail->StudentId,
                    'student_name' => $studentName,
                    'degree_name' => $studentDegree,
                    'position' => $advertisementPosition,
                    'company_name' => $companyName,
                    'advertisement_id' => $appdetail->AdvertisementId,
                    'start_date' => $startDate,
                    'end_date' => $endDate
                ];
            }
            $this->view('Coordinator/Application/workingStudents', ['applicationData' => $applicationData]);
        }
    }
}
