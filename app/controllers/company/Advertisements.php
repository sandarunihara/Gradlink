<?php

class Advertisements
{
    use Controller;
    public function dashboard()
    {

        $model = new C_Advertisement;

        $data = $model->findall();

        // Convert PDOStatement to an array
        // $data = $stmt->fetchAll(PDO::FETCH_OBJ);

        // Check if data is empty
        if (empty($data)) {
            $this->view('Company/Advertisements');
        } else {
            // Filter active advertisements
            $activeData = array_filter($data, function ($advertisement) {
                return $advertisement->status === 'Active';
            });

            // Re-index the array after filtering
            $activeData = array_values($activeData);

            if (!empty($activeData)) {
                $this->view('Company/Advertisements', ['data' => $activeData]);
            } else {
                $this->view('Company/Advertisements');
            }
        }
    }


    public function create()
    {
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

            $data = [
                'position' => $_POST['position'] ?? '',
                'status' => 'Active',
                'description' => $_POST['description'] ?? '',
                'numOfInterns' => $_POST['interns'] ?? '',
                'workingMode' => $_POST['worktype'] ?? '',
                'qualification' => $_POST['qualifications'] ?? '',
                'deadline' => $_POST['deadline'] ?? '',
                'image' => $imageBase64
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
