<?php 

session_start();

require 'db.php';


if (!$koneksi) {
    die("Connection failed: " . mysqli_connect_error());
}

$username = '';
$err = '';
$email = '';

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $verified = 0;

    
    $sql = "SELECT * FROM users WHERE username = ? OR email = ?";
    $query = $koneksi->prepare($sql);
    $query->bind_param("ss", $username, $email);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        while ($user = $result->fetch_assoc()) {
            if ($user['username'] == $username) {
                $err .= '<li>This username is already registered</li>';
            }
            if ($user['email'] == $email) {
                $err .= '<li>This email is already registered</li>';
            }
        }
    }

    
    if (!$err) {
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        
        
        $insert_user = $koneksi->prepare("INSERT INTO users (username, password, email, verified) VALUES (?, ?, ?, ?)");
        $insert_user->bind_param("sssi", $username, $password, $email, $verified);

       
        if ($insert_user->execute()) {

            $user_id = $insert_user->insert_id;

            $name = '';
            $bio = '';
            $profile_picture = '';

            $insert_profile = $koneksi->prepare("INSERT INTO profile (user_id, name, bio, profile_picture) VALUES (?, ?, ?, ?)");
            $insert_profile->bind_param("isss", $user_id, $name, $bio, $profile_picture);
            $insert_profile->execute();

            
            header('Location: /login');
            exit(); 
        } else {
            echo "Error: " . $koneksi->error;
        }

        $insert_user->close();
    }
}

?>