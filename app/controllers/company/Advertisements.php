<?php

class Advertisements
{
    use Controller;
    public function dashboard()
    {

        $user = "";
        if (isset($_SESSION['USER'])) {
            $user = $_SESSION['USER'];
        }

        $model = new C_Advertisement;
        $modelstudent = new C_Dashboard;

        // $data = $model->findall();

        $data = $model->find($user->CompanyId);
        // $data = $model->find($user->CompanyId)->fetchAll(PDO::FETCH_OBJ);


        // Get the current date
        $currentDate = date('Y-m-d');
        // Check if data is empty
        if (empty($data)) {
            $this->view('Company/Advertisements',['data' => $data,'activeCount' => 0,'deactiveCount' => 0, 'numOfapplyStudents' => 0]);
        } else {

            $advertisementIds = [];
            foreach ($data as $advertisement) {
                $advertisementIds[] = $advertisement->advertisementId;
                // Check if the deadline is in the past
                if ($advertisement->deadline < $currentDate) {
                    // Update the status to 'Inactive'
                    $model->update($advertisement->advertisementId, ['status' => 'Deactive'], 'advertisementId');
                }
            }

            $studentIds = [];
            $applystudent = [];
            foreach ($advertisementIds as $id) {
                $applystudent = $modelstudent->find(['advertisementId' => $id], 'studentadvertisement');
                if (!empty($applystudent)) {
                    foreach ($applystudent as $student) {
                        $studentIds[] = $student->StudentId;
                    }
                }else{
                    $studentIds = [];
                }
            }
            $numOfapplyStudents = count($studentIds);


            $activeData = array_filter($data, function ($advertisement) {
                return $advertisement->status === 'Active';
            });

            $deactiveData = array_filter($data, function ($advertisement) {
                return $advertisement->status === 'Deactive';
            });

            // Re-index the array after filtering
            $activeData = array_values($activeData);
            $deactiveData = array_values($deactiveData);

            // Count active and deactivated advertisements
            $activeCount = count($activeData);
            $deactiveCount = count($deactiveData);

            $this->view('Company/Advertisements', ['data' => $data,'activeCount' => $activeCount,'deactiveCount' => $deactiveCount, 'numOfapplyStudents' => $numOfapplyStudents]);
            
        }
    }

    public function getnextId() {
        $adModel = new C_Advertisement();
        $advertisementId = $adModel->gethighestadid();
        if (!empty($advertisementId)) {
            // Extract the numeric part of the current highest advertisementId
            $numericPart = intval(substr($advertisementId, 1)); // Remove the prefix (e.g., 'a')
            $nextId = $numericPart + 1;
    
            // Determine the number of digits required for the new ID
            $paddingLength = max(3, strlen((string)$nextId));
    
            // Format the new advertisementId (e.g., 'a001', 'a1000', etc.)
            return 'a' . str_pad($nextId, $paddingLength, '0', STR_PAD_LEFT);
        } else {
            // Start from 'a001' if there are no existing entries
            return 'a001';
        }
    }

    public function create()
    {
        $user = "";
        if (isset($_SESSION['USER'])) {
            $user = $_SESSION['USER'];
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $model = new C_Advertisement;
            
            
            $maxFileSize = 5 * 1024 * 1024; // 5 MB
            // Handle the file upload and convert it to base64
            $imageBase64 = '';
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                
                if ($_FILES['image']['size'] > $maxFileSize) {
                    echo "Error: The file is too large. Maximum allowed size is 5MB.";
                    return;
                }
                
                $imageData = file_get_contents($_FILES['image']['tmp_name']); // Get the image content
                $imageBase64 = base64_encode($imageData); // Encode image content in base64
                // print_r($imageBase64);
            }
            
            $Id=$this->getnextId();
            $data = [
                'advertisementId'=>$Id,
                'position' => $_POST['position'] ?? '',
                'status' => 'Active',
                'description' => $_POST['description'] ?? '',
                'numOfInterns' => $_POST['interns'] ?? '',
                'workingMode' => $_POST['worktype'] ?? '',
                'qualification' => $_POST['qualifications'] ?? '',
                'deadline' => $_POST['deadline'] ?? '',
                'image' => $imageBase64,
                'startDate' => date('Y-m-d'),
                'CompanyId' => $user->CompanyId
            ];

            // Validate and insert the data into the database
            if ($model->validate($data)) {
                $result = $model->insert($data);
                if ($result) {
                    header('Location: ../Advertisements/dashboard'); // Redirect to the dashboard after successful submission
                    exit;
                } else {
                    echo "There was an issue saving the advertisement.";
                }
            } else {
                $data['errors'] = $model->errors;
                // Handle validation errors
                print_r($data['errors']);
            }
        }

        $this->view('Company/CreateAdvertisement');
    }



    public function send($id)
    {

        $model = new C_Advertisement;
        // Find the advertisement by ID
        $data = $model->find(['advertisementId' => $id]);
        $advertisementId = $id;
        if ($data) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $model = new C_Advertisement;
                $updatedata = [
                    'position' => $_POST['position'] ?? '',
                    'description' => $_POST['description'] ?? '',
                    'qualification' => $_POST['qualification'] ?? '',
                    'numOfInterns' => $_POST['numOfInterns'] ?? '',
                    'workingMode' => $_POST['workingMode'] ?? '',
                    'deadline' => $_POST['deadline'] ?? ''
                ];

                if ($model->validate($_POST)) {
                    $result = $model->update($advertisementId, $updatedata, 'advertisementId');
                    if ($result) {
                        // Redirect to the same page after successful submission
                        header("Location: " . $_SERVER['REQUEST_URI']);
                        exit;
                    } else {
                        echo "There was an issue saving the advertisement.";
                    }
                } else {
                    $data['errors'] = $model->errors;
                    // Handle validation errors
                    print_r($data['errors']);
                }
            }
            // Pass the data data to the view
            $this->view('Company/SendAdvertisements', ['data' => $data]);
        } else {
            echo "Advertisement not found.";
        }
    }



    public function delete($id)
    {
        $model = new C_Advertisement;
        $result = $model->delete($id, 'advertisementId');
        // Try to delete the advertisement by ID
        if ($result) {
            header('Location: ../dashboard');
            exit;
        } else {
            echo "Error: Could not delete the advertisement.";
        }
    }
}






