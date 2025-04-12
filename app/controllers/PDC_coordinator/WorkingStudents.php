
<?php
class WorkingStudents
{
    use Controller;
    public function index()
    {
        $model = new Student_advertisement;
            $data = $model->findRecruitedList();
            //show($data);
            $this-> view('Coordinator/Application/workingStudents' , $data);

    }
}
