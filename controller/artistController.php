<?php 

require 'db.php';

$sql = "SELECT 
profile.user_id, 
ANY_VALUE(profile.name) AS name, 
ANY_VALUE(profile.bio) AS bio, 
ANY_VALUE(profile.profile_picture) AS profile_picture, 
COUNT(gallery.id_gallery) AS total_artworks
FROM profile
LEFT JOIN gallery ON profile.user_id = gallery.user_id 
GROUP BY profile.user_id";

$result = $koneksi->query($sql);

?>