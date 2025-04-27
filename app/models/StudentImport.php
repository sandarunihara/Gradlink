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

    // public function importStudents($data)
    // {
    //     $errors = [];
    //     $success = true;

    //     foreach ($data as $student) {
    //         try {
    //             // Map the incoming data to match database columns
    //             $studentData = [
    //                 'StudentId' => $student['student_id'],
    //                 'Name' => $student['name'],
    //                 'DegreeName' => $student['degree'],
    //                 'Email' => $student['email'],
    //                 'NIC' => $student['nic'],
    //                 'ContactNum' => $student['contact_no'],
    //                 'Status' => 'Not Applied'  // Set default status
    //             ];

    //             // Check if student already exists
    //             $existingStudent = $this->first(['StudentId' => $studentData['StudentId']]);
                
    //             if ($existingStudent) {
    //                 // Update existing student but preserve their current status
    //                 $studentData['Status'] = $existingStudent->Status;
    //                 $this->update($existingStudent->id, $studentData, 'StudentId');
    //             } else {
    //                 // Insert new student with 'Not Applied' status
    //                 $this->insert($studentData);
    //             }
    //         } catch (Exception $e) {
    //             $errors[] = "Error processing student {$studentData['StudentId']}: " . $e->getMessage();
    //             $success = false;
    //         }
    //     }

    //     return [
    //         'success' => $success,
    //         'errors' => $errors
    //     ];
    // }

    public function importStudents($data)
{
    $errors = [];
    $success = true;
    $duplicates = [];
    $inserted = 0;
    $updated = 0;

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
                $this->update($existingStudent->id, $studentData, 'StudentId');
                $updated++;
                $duplicates[] = "Student ID {$studentData['StudentId']} was updated (already existed)";
            } else {
                // Insert new student with 'Not Applied' status
                $this->insert($studentData);
                $inserted++;
            }
        } catch (Exception $e) {
            // More specific error handling
            if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
                $errors[] = "Student ID {$studentData['StudentId']} already exists in the system";
            } else {
                $errors[] = "Error processing student {$studentData['StudentId']}: " . 
                            $this->simplifyErrorMessage($e->getMessage());
            }
            $success = false;
        }
    }

    return [
        'success' => $success && empty($errors), // Only fully successful if no errors
        'errors' => $errors,
        'stats' => [
            'inserted' => $inserted,
            'updated' => $updated,
            'duplicates' => $duplicates
        ],
        'message' => sprintf(
            'Import completed: %d new students added, %d existing students updated',
            $inserted,
            $updated
        )
    ];
}

protected function simplifyErrorMessage($error)
{
    // Simplify common database errors for user display
    $patterns = [
        '/Duplicate entry .+ for key/' => 'This record conflicts with an existing one',
        '/Data too long for column/' => 'Data too long for one of the fields',
        '/Incorrect (integer|string) value/' => 'Invalid value format',
        '/Cannot add or update a child row/' => 'Reference error (invalid related data)'
    ];
    
    foreach ($patterns as $pattern => $replacement) {
        if (preg_match($pattern, $error)) {
            return $replacement;
        }
    }
    
    return 'Database operation failed';
}
} 