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
//dem der IKKE er redaktører

$category_id = $_POST['value'];

$query = "SELECT user_id, user_name
				  FROM users
				  WHERE
				  user_id 
				  NOT IN 
					  (
					  SELECT 
					  fk_users_id
					  FROM
					  category_editors
					  WHERE
					  fk_categories_id
					  =
					  $category_id
					  )
				  AND
				  fk_roles_id = 3"; // 3 == redaktør
$result = mysqli_query($database_link, $query) or die(mysqli_error($database_link));

$not_editors = array();
$yo = array();
while($row = mysqli_fetch_assoc($result))
{
    array_push($not_editors, $row);
}
echo json_encode($not_editors);

return json_encode($not_editors);
?>
<?php
/**
 * Created by PhpStorm.
 * User: 110230
 * Date: 19-09-2016
 * Time: 11:27
 */
?>