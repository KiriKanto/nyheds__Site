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
//-----------------------------------//
//__________________________________//
//dem der ER radaktører
$category_id = $_POST['value'];

$query = "SELECT user_id, user_name
                  FROM
                  users
                  INNER JOIN category_editors
                  ON 
                  users.user_id 
                  = 
                  category_editors.fk_users_id
                  WHERE
                  fk_categories_id
                  =
                  $category_id
                  AND 
                  fk_roles_id
                  = 
                  3"; //3 == redaktører
$result = mysqli_query($database_link, $query) or die(mysqli_error($database_link));

$editors = [];

while($row = mysqli_fetch_assoc($result))
{
    $editors[] = $row;
}
echo json_encode($editors);
return json_encode($editors);

?>
<?php
/**
 * Created by PhpStorm.
 * User: 110230
 * Date: 19-09-2016
 * Time: 12:13
 */
?>