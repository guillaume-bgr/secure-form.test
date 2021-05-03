<?php
$regextext='/^[A-Za-z]+((\s)?((\'|\-|\.)?([A-Za-z])+))*$/m'; 
$regexaddress = '/^\d{1,3}\s\w+\s\w+(\s\w+)*\s\d{5}\s\w+$/';
$regexdate = '/^(19|20)\d{2}-(0[1-9]|1[0-2])-(0[1-9]|1[0-9]|2[0-9]|3[01])$/';
$contact = []; 
$firstname = '';
$lastname = ''; 
$email = '';
$birthdate = '';
$address = '';
$emergencyfirstname = '';
$emergencylastname = '';
$emergencyemail = '';
$emergencyphone = '';
$emergencysmartphone = '';
$options = array(
    'firstname' => FILTER_SANITIZE_STRING,
    'lastname' => FILTER_SANITIZE_STRING,
    'address' => FILTER_SANITIZE_STRING,
    'phone' => FILTER_SANITIZE_NUMBER_INT,
    'email' => FILTER_SANITIZE_EMAIL,
    'birthdate' => FILTER_SANITIZE_STRING,
    'birthplace' => FILTER_SANITIZE_STRING, 
    'birthdepartment' => FILTER_SANITIZE_STRING,
    'birthstate' => FILTER_SANITIZE_STRING,
    'nationality' => FILTER_SANITIZE_STRING,
);
$errors = array(

);

$posts = filter_input_array(INPUT_POST, $options);
if(!empty($posts)) {
    extract($posts);
    if(empty($firstname)) {
        $errors['firstname'] = "Le champ est requis";
    }
    elseif(!preg_match($regextext, $firstname)) {
        $errors['firstname'] = "Le format n'est pas correct";
    }

    if(empty($lastname)) {
        $errors['lastname'] = "Le champ est requis";
    }
    elseif(!preg_match($regextext, $lastname)) {
        $errors['lastname'] = "Le format n'est pas correct";
    }

    if(empty($email)) {
        $errors['email'] = "Le champ est requis";
    }
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Le format n'est pas correct";
    }
    if(empty($address)) {
        $errors['address'] = "Le champ est requis";
    }
    elseif(!preg_match($regexaddress, $address)) {
        $errors['address'] = "Le format n'est pas correct";
    }

    if(empty($birthdate)) {
        $errors['birthdate'] = "Le champ est requis";
    }
    elseif(!preg_match($regexdate, $birthdate)) {
        $errors['birthdate'] = "Le format n'est pas correct";
    }


    $emergency = $_POST['emergency'];
    for($i=0; $i<count($emergency['firstname']); $i++) {
        $contact[$i]['firstname'] = $emergency['firstname'][$i];
        $contact[$i]['lastname'] = $emergency['lastname'][$i];
        $contact[$i]['email'] = $emergency['email'][$i];
        $contact[$i]['phone'] = $emergency['phone'][$i];
        $contact[$i]['smartphone'] = $emergency['smartphone'][$i];
    }   
}
    function validateEmergency($contact, &$errors) {
        extract($contact);
        $regextext='/^[A-Za-z]+((\s)?((\'|\-|\.)?([A-Za-z])+))*$/m'; 
        $regexaddress = '/^\d{1,3}\s\w+\s\w+(\s\w+)*\s\d{5}\s\w+$/';
        $regexdate = '/^(19|20)\d{2}-(0[1-9]|1[0-2])-(0[1-9]|1[0-9]|2[0-9]|3[01])$/';
        if(-empty($contact['firstname'])) {
            $errors['emergencyfirstname'] = 'Le prénom doit être renseigné';
        }
        elseif(!preg_match($regextext, $firstname)) {
            $errors['emergencyfirstname'] = "Le format n'est pas correct";
        }
        
        if(empty($contact['lastname'])) {
            $errors['emergencylastname'] = 'Le nom doit être renseigné';
        }
        elseif(!preg_match($regextext, $lastname)) {
            $errors['emergencylastname'] = "Le format n'est pas correct";
        }
        
        if(empty($contact['email'])) {
            $errors['emergencyemail'] = "L'email doit être renseigné";
        }
        elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['emergencyemail'] = "Le format n'est pas correct";
            echo $email;
        }
        
        if(empty($contact['phone'])) {
            $errors['emergencyphone'] = 'Le numéro de téléphone doit être renseigné';
        }
        elseif(!preg_match($regextext, $phone)) {
            $errors['emergencyphone'] = "Le format n'est pas correct";
        }
        if(empty($contact['smartphone'])) {
            $errors['emergencysmartphone'] = 'Le numéro de portable doit être renseigné';
        }
        elseif(!preg_match($regextext, $smartphone)) {
            $errors['emergencysmartphone'] = "Le format n'est pas correct";
        }
    }

    foreach($contact as $oneContact) {
        validateEmergency($oneContact, $errors);
    }
?>