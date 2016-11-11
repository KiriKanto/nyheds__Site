<?php
$database_host = 'localhost';
$database_user = 'root';
$database_pass = '';
$database_name = 'news_site';

// hvis det ikke kan lade sig gøre at forbinde til databasen,
// så udskrives der en fejlbesked
if ( !$database_link = @mysqli_connect($database_host, $database_user, $database_pass, $database_name))
{
    die('<p class="alert alert-danger">
                 <strong>ADVARSEL</strong> Forbindelsen til databasen fejler... <br />
                 Tjek forbindelses informationerne i filen:<br /> 
                 <strong>'.__FILE__.'</strong>
             </p>');
}
$user_id = array();
$cat_id  = $_POST['category'];
$user_id = $_POST['value'];

foreach ($user_id as $id)
{
    $query = "INSERT INTO category_editors
             (
             fk_users_id,
             fk_categories_id
             )
             VALUES 
             (
             '$id',
             '$cat_id'
             )";
    $result = mysqli_query($database_link, $query) or die(mysqli_error($database_link));
}

echo json_encode(['status'=>$result]);
/**
 * Created by PhpStorm.
 * User: 110230
 * Date: 19-09-2016
 * Time: 14:05
 */