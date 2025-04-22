<?php

class StudentImport
{
    use Model;

    protected $table = 'student_import';
    protected $allowedColumns = [
        'StudentId',
        'Name',
        'DegreeName',
        'Email',
        'NIC',
        'ContactNum',
        'Status'
    ];

    public function importStudents($data)
    {
        $errors = [];
        $success = true;

        foreach ($data as $student) {
            try {
                // Map the incoming data to match database columns
                $studentData = [
                    'StudentId' => $student['student_id'],
                    'Name' => $student['name'],
                    'DegreeName' => $student['degree'],
                    'Email' => $student['email'],
                    'NIC' => $student['nic'],
                    'ContactNum' => $student['contact_no'],
                    'Status' => 'Not Applied'  // Set default status
                ];

                // Check if student already exists
                $existingStudent = $this->first(['StudentId' => $studentData['StudentId']]);
                
                if ($existingStudent) {
                    // Update existing student but preserve their current status
                    $studentData['Status'] = $existingStudent->Status;
                    $this->update($existingStudent->id, $studentData);
                } else {
                    // Insert new student with 'Not Applied' status
                    $this->insert($studentData);
                }
            } catch (Exception $e) {
                $errors[] = "Error processing student {$studentData['StudentId']}: " . $e->getMessage();
                $success = false;
            }
        }

        return [
            'success' => $success,
            'errors' => $errors
        ];
    }
} 