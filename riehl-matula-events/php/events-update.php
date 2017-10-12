<?php

function sermons_update()
{
    global $wpdb;
    $table_name   = "sermons";
    $id           = $_GET["id"];
    $title        = trim($_POST["title"]);
    $speakers     = trim($_POST["speakers"]);
    $description  = trim($_POST["description"]);
    $scheduledFor = trim($_POST["scheduled_for"]);
    $audioUrl     = trim($_POST["audio_url"]);
    $imageUrl     = trim($_POST["image_url"]);

    //update
    if (isset($_POST['update'])) {
        $wpdb->update(
            $table_name, //table
            array(
                'title'         => $title,
                'description'   => $description,
                'speakers'      => $speakers,
                'audio_url'     => empty($audioUrl) ? null : $audioUrl,
                'image_url'     => empty($imageUrl) ? null : $imageUrl,
                'scheduled_for' => $scheduledFor,
                'updated_at'    => date('Y-m-d H:i:s')
            ), //data
            array('id' => $id), //where
            array('%s'), //data format
            array('%s') //where format
        );
    } else {
        //delete
        if (isset($_POST['delete'])) {
            $wpdb->query($wpdb->prepare("DELETE FROM $table_name WHERE id = %s", $id));
        } else {//selecting value to update
            $schools = $wpdb->get_results($wpdb->prepare("SELECT * from $table_name where id=%s", $id));
            foreach ($schools as $s) {
                $title        = $s->title;
                $description  = $s->description;
                $scheduledFor = $s->scheduled_for;
                $speakers     = $s->speakers;
                $audioUrl     = $s->audio_url;
                $imageUrl     = $s->image_url;
            }
        }
    }
    ?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/matula-sermons/style-admin.css" rel="stylesheet"/>
    <div class="wrap">
        <h2>Update Sermon</h2>

        <?php if ($_POST['delete']) { ?>
            <div class="updated"><p>Sermon deleted</p></div>
            <a href="<?php echo admin_url('admin.php?page=sermons_list') ?>">&laquo; Back to sermons list</a>

        <?php } else {
            if ($_POST['update']) { ?>
                <div class="updated"><p>Sermon updated</p></div>
                <a href="<?php echo admin_url('admin.php?page=sermons_list') ?>">&laquo; Back to sermons list</a>

            <?php } else { ?>
                <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
                    <table class='wp-list-table widefat'>
                        <tr>
                            <th class="ss-th-width">Title</th>
                            <td><input type="text" name="title" class="ss-field-width" value="<?php echo $title ?>"/>
                            </td>
                        </tr>
                        <tr>
                            <th class="ss-th-width">Description</th>
                            <td>
                                <?php wp_editor(stripslashes($description), "description", [
                                    "textarea_name" => "description",
                                    "media_buttons" => false
                                ]) ?>
                            </td>
                        </tr>
                        <tr>
                            <th class="ss-th-width">Speaker(s)</th>
                            <td><input type="text" name="speakers" value="<?php echo $speakers ?>"
                                       class="ss-field-width"/></td>
                        </tr>
                        <tr>
                            <th class="ss-th-width">Audio URL</th>
                            <td>
                                <input type="text" name="audio_url" value="<?php echo $audioUrl ?>" class="ss-field-width"/>
                            </td>
                        </tr>
                        <tr>
                            <th class="ss-th-width">Image URL</th>
                            <td>
                                <input type="text" name="image_url" value="<?php echo $imageUrl ?>" class="ss-field-width"/>
                            </td>
                        </tr>
                        <tr>
                            <th class="ss-th-width">Date Scheduled</th>
                            <td><input type="date" name="scheduled_for" class="ss-field-width"
                                       value="<?php echo $scheduledFor ?>"/></td>
                        </tr>
                    </table>
                    <input type='submit' name="update" value='Save' class='button-primary' style="margin-right:20px">
                    <input type='submit' name="delete" value='Delete' class='button'
                           onclick="return confirm('Are you sure you want to delete?')">
                </form>
            <?php }
        } ?>

    </div>
    <?php
}