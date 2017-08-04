<?php

function events_list()
{
    ?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL ?>/riehl-matula-events/style-admin.css" rel="stylesheet"/>
    <div class="wrap">
        <h2>Events</h2>
        <div class="tablenav top">
            <div class="alignleft actions">
                <a href="<?php echo admin_url('admin.php?page=events_create') ?>" class="button-primary" style="margin-bottom:10px">Add New</a>
            </div>
            <p class="clear"></p>
        </div>
        <?php
        global $wpdb;
        $table_name = "events";

        $rows = $wpdb->get_results("SELECT * FROM events WHERE scheduled_date >= intval(" . date('Y-m-d') .  ") AND start_hour >= '" . intval(date('H')) + 1 . "' ORDER BY scheduled_date ASC, start_hour ASC");
        ?>
        <table class='wp-list-table widefat fixed striped posts'>
            <tr>
                <th class="manage-column ss-list-width" style="width:20%"><b>Title</b></th>
                <th class="manage-column ss-list-width" style="width:35%"><b>Description</b></th>
                <th class="manage-column ss-list-width" style="width:9%"><b>Date Scheduled</b></th>
                <th class="manage-column ss-list-width" style="width:20%"><b>Speaker</b></th>
                <th class="manage-column ss-list-width" style="width:3%"><b>Audio?</b></th>
                <th class="manage-column ss-list-width" style="width:3%"><b>Image?</b></th>

                <th style="width:10%"></th>
            </tr>
            <?php foreach ($rows as $row) { ?>
                <tr>
                    <td class="manage-column ss-list-width"><?php echo $row->title ?></td>
                    <td class="manage-column ss-list-width"><?php echo substr($row->description, 0, 100) . "..." ?></td>
                    <td class="manage-column ss-list-width"><?php echo $row->scheduled_for ?></td>
                    <td class="manage-column ss-list-width"><?php echo $row->speakers ?></td>
                    <td class="manage-column ss-list-width"><?php echo empty($row->audio_url) ? "" : "X" ?></td>
                    <td class="manage-column ss-list-width"><?php echo empty($row->image_url) ? "" : "X" ?></td>
                    <td>
                        <a href="<?php echo admin_url('admin.php?page=sermons_update&id=' . $row->id); ?>">Update</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <?php
}
