<?php
ob_start(); 

require 'controller/db.php';

if (!isset($_GET['user_id']) || !is_numeric($_GET['user_id'])) {
    echo "<h1>Invalid Profile ID</h1>";
    exit;
}

$user_id = intval($_GET['user_id']);
$sql = "SELECT 
            ANY_VALUE(p.id) AS id,
            ANY_VALUE(p.name) AS name,
            ANY_VALUE(p.bio) AS bio,
            ANY_VALUE(p.profile_picture) AS profile_picture,
            GROUP_CONCAT(g.image_path) AS artworks 
        FROM profile p
        LEFT JOIN gallery g ON p.user_id = g.user_id
        WHERE p.user_id = ?
        GROUP BY p.user_id";
$stmt = $koneksi->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user_profile = $result->fetch_assoc();

if (!$user_profile) {
    echo "<h1>Profile Not Found</h1>";
    exit;
}

$imagepath = "../" . $user_profile['profile_picture'];
$gallerypath = "../" . $user_profile['artworks'];

$sql_gallery = "SELECT * FROM gallery WHERE user_id = ?";
$stmt = $koneksi->prepare($sql_gallery);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result_gallery = $stmt->get_result();

ob_end_flush(); 
?>