<?php
session_start();

if (!isset($_SESSION['session_username'])) {
    header('location:/login');
    exit;
} else {
    require 'db.php';

    if (!$koneksi) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $success = 0;

    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM profile WHERE user_id = ?";
    $query = $koneksi->prepare($sql);
    $query->bind_param("i", $user_id);
    $query->execute();
    $result = $query->get_result();
    $user_profile = $result->fetch_assoc();

    $sql_gallery = "SELECT * FROM gallery WHERE user_id = ?";
    $stmt = $koneksi->prepare($sql_gallery);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result_gallery = $stmt->get_result();
    // $dashboard_gallery = $result_gallery->fetch_assoc();

    if (isset($_POST["save_changes"])) {
        $name = $_POST['name'];
        $bio = $_POST['bio'];
        

        
        if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
            $file_name = $_FILES['profile_picture']['name'];
            $file_tmp = $_FILES['profile_picture']['tmp_name'];
            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
            
            $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];

            if (in_array(strtolower($file_ext), $allowed_ext)) {
                $upload_dir = "assets/Profile/";
                
                
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0777, true);
                }

                $new_file_name = "profile_" . $user_id . "." . $file_ext;
                $file_path = $upload_dir . $new_file_name;

                if (move_uploaded_file($file_tmp, $file_path)) {
                    
                    $sql = "UPDATE profile 
                            SET name = ?, bio = ?, profile_picture = ? 
                            WHERE user_id = ?";
                    $query = $koneksi->prepare($sql);
                    $query->bind_param("sssi", $name, $bio, $file_path, $user_id);

                    if ($query->execute()) {
                        header('Refresh:0');
                        $success = 1;
                    } else {
                        header('Refresh:0');
                        $success = 2;
                    }
                } else {
                    header('Refresh:0');
                    $success = 2;
                }
            } else {
                header('Refresh:0');
                $success = 2;
            }
            header('Refresh:0');
            exit();
            
            
        } else {
            
            $sql = "UPDATE profile 
                    SET name = ?, bio = ?
                    WHERE user_id = ?";
            $query = $koneksi->prepare($sql);
            $query->bind_param("ssi", $name, $bio, $user_id);

            if ($query->execute()) {
                header("Refresh:0");
            } else {
                echo "Error: " . $query->error;
            }

            exit();
        }

        
        // $query->close();
    }

    if(isset($_POST['upload'])) {
        $title = $_POST['title'];
        $artist_name = $user_profile['name'];
        $user_id = $user_profile['user_id'];
        
        if (isset($_FILES['image_path']) && $_FILES['image_path']['error'] === UPLOAD_ERR_OK) {
            $file_name = $_FILES['image_path']['name'];
            $file_tmp = $_FILES['image_path']['tmp_name'];
            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
            
            $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];
    
            if (in_array(strtolower($file_ext), $allowed_ext)) {
                $upload_dir = "assets/Gallery/";
                
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0777, true);
                }
    
                $new_file_name = "Gallery_" . uniqid() . "." . $file_ext;
                $file_path = $upload_dir . $new_file_name;
    
                if (move_uploaded_file($file_tmp, $file_path)) {
                    $sql = "INSERT INTO gallery (user_id, title, artist_name, image_path) VALUES (?, ?, ?, ?)";
                    $query = $koneksi->prepare($sql);
                    $query->bind_param("isss", $user_id, $title, $artist_name, $file_path);


                    if ($query->execute()) {
                        header("Refresh:0");
                    } else {
                        echo "Error: " . $query->error;
                    }

                    exit();

                } else {
                    echo "Failed to upload the image.";
                }

            } else {
                echo "Invalid file format. Only JPG, JPEG, PNG, and GIF are allowed.";
            }
        }

        $query->close();
    }

    if(isset($_POST['deleteForm'])) {
        // var_dump($_POST); // Cek data yang diterima
        // die(); // Hentikan eksekusi untuk melihat output sebelum menjalankan query

        $id_gallery = $_POST['id_gallery'];

        $sql = "DELETE FROM gallery WHERE id_gallery = '$id_gallery'";
        $query = mysqli_query($koneksi, $sql);

        if ($query) {
            header('Refresh:0');
            echo "<script>alert('Artwork berhasil dihapus!'); window.location.href='/dashboard';</script>";
        } else {
            echo "<script>alert('Gagal menghapus artwork!'); window.location.href='/dashboard';</script>";
        }

        exit();
        
    }


}
?>

