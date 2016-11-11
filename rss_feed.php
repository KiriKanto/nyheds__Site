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
$dom = new DOMDocument('1.0', 'iso-8859-1');
$root= $dom->createElement('root');

    $query = "SELECT news_id, news_title, 
              news_content, news_postdate, 
              fk_users_id, user_name,
              user_id,
              fk_categories_id,
              category_id,
              category_title
              FROM news
              INNER JOIN
              users
              ON 
              news.fk_users_id 
              = 
              users.user_id
              INNER JOIN
              categories
              ON 
              news.fk_categories_id 
              = 
              categories.category_id";

    $result= mysqli_query($database_link, $query) or die(mysqli_error($database_link));
while($row = mysqli_fetch_assoc($result))
{
    //create item
    $news   = $dom->createElement('item');
    //set attributes on item to the news_id
    $news   ->setAttribute('id', $row['news_id']);
    //set another attribute on item with category id
    $news   ->setAttribute('categori',
            $row['category_id']);
    //append the element title to item, containing title of the news
    $news   ->appendChild($dom->createElement
            ('title', $row['news_title']));
    //create content and fill with content from DB
    $content=$dom->createElement('story',
            $row['news_content']);
    //create date stamp for the news
    $date   = $dom->createElement('date',
            $row['news_postdate']);
    //create writer for the news
    $writer = $dom->createElement('writer',
            $row['user_name']);
    //set the attribute to user_id
    $writer ->setAttribute('id', $row['user_id']);

    //append things to the right lvl's
    $news   ->appendChild($date);
    $news   ->appendChild($writer);
    $news   ->appendChild($content);
    $root   ->appendChild($news);

}
$dom->appendChild($root);
$dom->formatOutput = true;
$dom->save('categories.xml');