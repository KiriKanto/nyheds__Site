<?php
    // denne fil inkluderes fra index.php, så der er allerede hul igennem
    // til database, sessions og al design osv...
    // skulle det ske at nogen prøvede at åbne filen direkte,
    // så indlæses siden korrekt med en header-location
    if ( !isset($database_link))
    {
        die(header('location: index.php?page=editors'));
    }
?>
<div class="panel panel-default">
    <div class="panel-heading">
    <h2>Redaktør Administration</h2>
    </div><!--header end-->
    <div class="panel-body">
        <form method="post">
            <select id="choose_this" class="form-control" name="categories">
                <option value="" selected disabled>Vælg Kategori</option>
                <?php
                $query  = "SELECT * FROM
                          categories";
                $result = mysqli_query($database_link, $query) or die(mysqli_error($database_link));

                while($row = mysqli_fetch_assoc($result))
                {
                    ?>
                    <option value="<?php echo $row['category_id']; ?>"><?php echo $row['category_title']; ?></option>
                    <?php
                }
                ?>
            </select>
        </form>
        <form>
        <h3>
            Ikke redaktører
        </h3>
        <select id="not_Editor" class="form-control" name="not_editor[]" multiple="multiple" size="5">

        </select>
        <input type="button" id="add_editor" name="add_editor" value="Add Editor" class="form-control">
        </form>
        <!--redaktører starter-->
        <form method="post">
        <h3>
            Redaktører
        </h3>
        <select id="editor" class="form-control" name="is_editor[]" multiple="multiple" size="5">

        </select>
        <input type="button" id="remove_editor" name="remove_editor" value="Remove Editor" class="form-control">
        </form>
    </div><!--panel-body end-->
</div>


