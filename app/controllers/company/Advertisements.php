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

        $companyId = [
            'CompanyId' => $user->CompanyId
        ];

        $data = $model->find($companyId);
        $data1 = [];
        $ALLadvertisementID = [];
        $numOfapplyStudents = 0;
        if (!empty($data)) {
            foreach ($data as $advertisement) {
                if ($advertisement->status != 'Trash') {
                    $data1[] = $advertisement;
                }
                $ALLadvertisementID[] = $advertisement->advertisementId;
            }
        }
        if (!empty($ALLadvertisementID)) {
            $studentIds = [];
            $applystudent = [];
            foreach ($ALLadvertisementID as $id) {
                $applystudent = $modelstudent->find(['advertisementId' => $id], 'studentadvertisement');
                if (!empty($applystudent)) {
                    foreach ($applystudent as $student) {
                        $studentIds[] = $student->StudentId;
                    }
                } else {
                    $studentIds = $studentIds;
                }
            }
            $numOfapplyStudents = count($studentIds);
        }



        // Get the current date
        $currentDate = date('Y-m-d');
        // Check if data is empty
        if (empty($data1)) {
            $this->view('Company/Advertisements', ['data' => $data1, 'activeCount' => 0, 'deactiveCount' => 0, 'pendingCount' => 0, 'numOfapplyStudents' => $numOfapplyStudents]);
        } else {

            $advertisementIds = [];
            foreach ($data1 as $advertisement) {
                $advertisementIds[] = $advertisement->advertisementId;
                // Check if the deadline is in the past
                if ($advertisement->status == 'Active' && $advertisement->deadline < $currentDate) {
                    // Update the status to 'Inactive'
                    $model->update($advertisement->advertisementId, ['status' => 'Deactive'], 'advertisementId');
                }
            }

            $activeData = array_filter($data1, function ($advertisement) {
                return $advertisement->status === 'Active';
            });

            $deactiveData = array_filter($data1, function ($advertisement) {
                return $advertisement->status === 'Deactive';
            });

            $pendingData = array_filter($data1, function ($advertisement) {
                return $advertisement->status === 'Pending';
            });

            // Re-index the array after filtering
            $activeData = array_values($activeData);
            $deactiveData = array_values($deactiveData);
            $pendingData = array_values($pendingData);

            // Count active and deactivated advertisements
            $activeCount = count($activeData);
            $deactiveCount = count($deactiveData);
            $pendingCount = count($pendingData);

            $this->view('Company/Advertisements', ['data' => $data1, 'activeCount' => $activeCount, 'deactiveCount' => $deactiveCount, 'pendingCount' => $pendingCount, 'numOfapplyStudents' => $numOfapplyStudents]);
        }
    }

    public function getnextId()
    {
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
        $data = [];
        $user = "";
        if (isset($_SESSION['USER'])) {
            $user = $_SESSION['USER'];
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $model = new C_Advertisement;
            $maxFileSize = 5 * 1024 * 1024; // 5 MB
            $imageBase64 = '';

            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $imageName = $_FILES['image']['name'];
                $imageTempName = $_FILES['image']['tmp_name'];

                $baseName = strtolower(pathinfo($imageName, PATHINFO_FILENAME));
                $ext = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

                // Clean the base name: remove special characters, trim underscores
                $cleanBase = preg_replace("/[^a-z0-9_-]/", "_", $baseName);
                $cleanBase = trim($cleanBase, "_");

                // Add timestamp and random string for uniqueness
                $uniqueString = date('Ymd_His') . '_' . bin2hex(random_bytes(4)); // more unique than uniqid
                $newimageName = $cleanBase . '_' . $uniqueString . '.' . $ext;
                $PictureDestination = __DIR__ . '/../../../public/assets/img/Company/advertisements/' . $newimageName;
                $uploadcoverpic = move_uploaded_file($imageTempName, $PictureDestination);

                if ($uploadcoverpic) {
                    $imageBase64 = $newimageName;
                } else {
                    $imageBase64 = '';
                }

            }

            $Id = $this->getnextId();
            $data = [
                'advertisementId' => $Id,
                'position' => $_POST['position'] ?? '',
                'status' => 'Pending',
                'description' => $_POST['description'] ?? '',
                'numOfInterns' => $_POST['interns'] ?? '',
                'workingMode' => $_POST['worktype'] ?? '',
                'qualification' => $_POST['qualifications'] ?? '',
                'deadline' => $_POST['deadline'] ?? '',
                'image' => $imageBase64,
                'startDate' => date('Y-m-d'),
                'CompanyId' => $user->CompanyId
            ];

            if ($model->validate($data)) {
                try {
                    $result = $model->insert($data);
                    if ($result) {
                        $_SESSION['flash'] = [
                            'type' => 'success',
                            'message' => 'Advertisement created successfully.'
                        ];
                        header('Location: ../Advertisements/dashboard');
                        exit;
                    } else {
                        $_SESSION['flash'] = [
                            'type' => 'error',
                            'message' => 'There was an issue saving the advertisement.'
                        ];
                    }
                } catch (PDOException $e) {
                    if (str_contains($e->getMessage(), 'max_allowed_packet')) {
                        $_SESSION['flash'] = [
                            'type' => 'error',
                            'message' => 'Error: Image is too large to be stored. Please use a smaller image.'
                        ];
                    } else {
                        $_SESSION['flash'] = [
                            'type' => 'error',
                            'message' => 'A database error occurred: ' . $e->getMessage()
                        ];
                    }
                }
            } else {
                $data['errors'] = $model->errors;
            }
        }

        $this->view('Company/CreateAdvertisement', ['data' => $data]);
    }




    public function send($id)
    {

        $companyId=$_SESSION['USER']->CompanyId;
        $model = new C_Advertisement;
        // Find the advertisement by ID
        $data = $model->find(['advertisementId' => $id]);
        $advertisementId = $id;

        // $data['errors']='';
        // $data['success']='';
        if ($data) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $model = new C_Advertisement;
                // // Handle the file upload and convert it to base64
                $imageBase64 = '';
                // print_r($_FILES['image']);
                if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                    $imageName = $_FILES['image']['name'];
                    $imageTempName = $_FILES['image']['tmp_name'];
    
                    $baseName = strtolower(pathinfo($imageName, PATHINFO_FILENAME));
                    $ext = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
    
                    // Clean the base name: remove special characters, trim underscores
                    $cleanBase = preg_replace("/[^a-z0-9_-]/", "_", $baseName);
                    $cleanBase = trim($cleanBase, "_");
    
                    // Add timestamp and random string for uniqueness
                    $uniqueString = date('Ymd_His') . '_' . bin2hex(random_bytes(4)); // more unique than uniqid
                    $newimageName = $cleanBase . '_' . $uniqueString . '.' . $ext;
                    $PictureDestination = __DIR__ . '/../../../public/assets/img/Company/advertisements/' . $newimageName;
                    $uploadcoverpic = move_uploaded_file($imageTempName, $PictureDestination);
    
                    if ($uploadcoverpic) {
                        $imageBase64 = $newimageName;
                    } else {
                        $imageBase64 = '';
                    }
                }
                if (empty($imageBase64)) {
                    $imageBase64 = $data[0]->image;
                }


                $updatedata = [
                    'position' => $_POST['position'] ?? '',
                    'description' => $_POST['description'] ?? '',
                    'qualification' => $_POST['qualification'] ?? '',
                    'numOfInterns' => $_POST['numOfInterns'] ?? '',
                    'workingMode' => $_POST['workingMode'] ?? '',
                    'deadline' => $_POST['deadline'] ?? '',
                    'image' => $imageBase64,
                ];
                if ($model->validate($_POST)) {
                    $result = $model->update($advertisementId, $updatedata, 'advertisementId');

                    if ($result['status'] == 'success') {
                        $_SESSION['flash_success'] = "Advertisement updated successfully";
                        header("Location: " . $_SERVER['REQUEST_URI']);
                        exit;
                    } else {
                        $_SESSION['flash_errors'] = "There was an issue saving the advertisement";
                        header("Location: " . $_SERVER['REQUEST_URI']);
                        exit;
                    }
                } else {
                    // Handle validation errors
                    $_SESSION['flash_errors'] = $model->errors;
                }
            }

            $data['success'] = $_SESSION['flash_success'] ?? '';
            $data['errors'] = $_SESSION['flash_errors'] ?? '';

            unset($_SESSION['flash_success'], $_SESSION['flash_errors']);
            
            $logmodel=new Action_logs;
            // show($data[0]->status);
            $blockresult='';
            if($data[0]->status =='Deactive'){
                if(empty($logmodel->findDetailsforcompany($advertisementId,'deactivate')[0])){
                    $blockresult='';
                }else{
                    $blockresult=$logmodel->findDetailsforcompany($advertisementId,'deactivate')[0]->reason;
                }
            }elseif($data[0]->status == 'Rejected'){
                $blockresult=$logmodel->findDetailsforcompany($advertisementId,'reject')[0]->reason;
            }
            if(empty($blockresult)){
                $blockresult='';
            }

        } else {
            $data['errors'] = "Advertisement not found.";
        }
        $this->view('Company/SendAdvertisements', ['data' => $data , 'blockresult'=>$blockresult]);
    }



    public function delete($id)
    {
        $model = new C_Advertisement;
        $data=$model->find(['advertisementId'=>$id]);
        // show($data);
        if($data[0]->status != 'Pending'){
            $Update_status = [
                'status' => 'Request'
            ];
            $result = $model->update($id, $Update_status, 'AdvertisementId');
            if ($result['status'] == 'success') {
                $_SESSION['flash'] = [
                    'type' => 'success',
                    'message' => 'Request to Deactive advertisement was successful'
                ];
                header('Location: http://localhost/Gradlink/public/company/Advertisements/dashboard');
                exit;
            } else {
                $_SESSION['flash'] = [
                    'type' => 'error',
                    'message' => 'Error: Failed to process advertisement Deactive request.'
                ];
            }
        }else{
            $Update_status = [
                'status' => 'Deactive'
            ];
            $result = $model->update($id, $Update_status, 'AdvertisementId');
            if ($result['status'] == 'success') {
                $_SESSION['flash'] = [
                    'type' => 'success',
                    'message' => 'Advertisement Deactive successfully'
                ];
                header('Location: http://localhost/Gradlink/public/company/Advertisements/dashboard');
                exit;
            } else {
                $_SESSION['flash'] = [
                    'type' => 'error',
                    'message' => 'Error: Could not Deactive the advertisement.'
                ];
            }
        }
    }
}
