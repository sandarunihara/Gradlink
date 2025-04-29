<?php

class AdminProfileOverview{
    use Controller;
    public function dashboard(){

        $model =  new pdc_assistant;
        $adds = new C_Advertisement;
        $company = new company;
        $students = new student;

        $addcount = $adds->findAllPendingcount();
        $comcount = $company->pendingCount();
        $stdcount = $students->notAppliedCount();

        $user = $model->findById($_SESSION['USER'] -> AssistantId);


        //show($_SESSION['USER'] -> AssistantId);

        $data = [
            $user,$addcount,$comcount,$stdcount
        ];

        //show($data[0]);
        $this-> view('PDC_admin/Profile/ProfileOverview' , 
        ['data' => $data]
    );
    }

    // public function edit($AssistantId){
    //     $model = new pdc_assistant;
    //     //show($_POST);
    //     $data = [
    //         'Name' => $_POST['fullName'],
    //         'Email' => $_POST['email'],
    //         'contact_number' => $_POST['contactNumber'],
    //         'dob' => $_POST['dob'],
    //         'gender' => $_POST['gender'],
    //         'address' => $_POST['address'],
    //     ];
    //     //show($data);
    //     $updatedStatus = $model->update($AssistantId, $data, 'AssistantId');
    //     if ($updatedStatus && $updatedStatus['status'] === 'success'){
    //         $_SESSION['flash_message'] = [
    //             'type' => 'success',
    //             'message' => 'successfully Updated'
    //         ];
    //     }
    //     else{
    //         $_SESSION['flash_message'] = [
    //             'type' => 'error',
    //             'message' => 'Error: Could not update.'
    //         ];
    //     }
    //     header('Location: ' . $_SERVER['HTTP_REFERER']);
    //     exit;
    // }

    // public function changePassword(){
    //     $_SESSION['flash_message'] = [
    //         'type' => 'success',
    //         'message' => 'password changed successfully  '
    //     ];
    //     header('Location: ' . ROOT . '/PDC_admin/AdminProfileOverview/dashboard');
    //     exit;
    // }

    public function edit($AssistantId)
{
    $model = new pdc_assistant;

    // Validate AssistantId exists
    $existingAssistant = $model->first(['AssistantId' => $AssistantId]);
    if (!$existingAssistant) {
        $_SESSION['flash_message'] = [
            'type' => 'error',
            'message' => 'Assistant not found'
        ];
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    // Sanitize input
    $data = [
        'Name' => htmlspecialchars(trim($_POST['fullName'] ?? '')),
        'Email' => filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL),
        'contact_number' => preg_replace('/[^0-9]/', '', $_POST['contactNumber'] ?? ''),
        'dob' => $_POST['dob'] ?? '',
        'gender' => in_array($_POST['gender'] ?? '', ['Male', 'Female', 'Other']) ? $_POST['gender'] : 'Other',
        'address' => htmlspecialchars(trim($_POST['address'] ?? '')),
    ];

    // Handle avatar
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['avatar']['tmp_name'];
        $fileName = $_FILES['avatar']['name'];
        $fileSize = $_FILES['avatar']['size'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        $allowedExtensions = [
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png'
        ];

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $fileTmpPath);
        finfo_close($finfo);

        if (!isset($allowedExtensions[$fileExtension]) || $mime !== $allowedExtensions[$fileExtension]) {
            $_SESSION['flash_message'] = [
                'type' => 'error',
                'message' => 'Invalid file type. Only JPG, JPEG, PNG allowed.'
            ];
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }

        if ($fileSize > 2 * 1024 * 1024) {
            $_SESSION['flash_message'] = [
                'type' => 'error',
                'message' => 'File size exceeds 2MB limit.'
            ];
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }

        // Final upload path
        $uploadDir = __DIR__ . '/../../../public/assets/img/admin/';
        $newFileName = 'avatar_' . $AssistantId . '_' . bin2hex(random_bytes(8)) . '.' . $fileExtension;
        $destPath = $uploadDir . $newFileName;

        // Create directory if it doesn't exist
        if (!file_exists($uploadDir)) {
            if (!mkdir($uploadDir, 0755, true)) {
                $_SESSION['flash_message'] = [
                    'type' => 'error',
                    'message' => 'Upload directory is missing and could not be created. Path: ' . $uploadDir
                ];
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit;
            }
        }

        // Check again if writable
        if (!is_writable($uploadDir)) {
            $_SESSION['flash_message'] = [
                'type' => 'error',
                'message' => 'Upload directory is not writable: ' . $uploadDir
            ];
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }

        if (move_uploaded_file($fileTmpPath, $destPath)) {
            $data['avatar'] = '/assets/img/admin/' . $newFileName;

            // Remove old avatar
            $oldAvatarPath = __DIR__ . '/../../../public' . ($existingAssistant->avatar ?? '');
            if ($existingAssistant->avatar && file_exists($oldAvatarPath)) {
                @unlink($oldAvatarPath);
            }
        } else {
            $_SESSION['flash_message'] = [
                'type' => 'error',
                'message' => 'Failed to move uploaded file. Check permissions on: ' . $uploadDir
            ];
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
    }

    // Update DB
    $updatedStatus = $model->update($AssistantId, $data, 'AssistantId');
    if ($updatedStatus) {
        $_SESSION['flash_message'] = [
            'type' => 'success',
            'message' => 'Profile updated successfully!'
        ];
        if (isset($data['avatar']) && isset($_SESSION['USER'])) {
            $_SESSION['USER']->avatar = $data['avatar'];
        }
    } else {
        $_SESSION['flash_message'] = [
            'type' => 'error',
            'message' => 'No changes made or failed to update profile.'
        ];
    }

    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}


    
}