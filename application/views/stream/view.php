<?php
foreach($streamer as $s) {
    //var_dump($s->channel->embed_code);
    ?>
    <div class="col-sm-9">
        <h5><?php echo $s->channel->login; ?></h5>

            <object type="application/x-shockwave-flash" height="378" width="620" id="live_embed_player_flash"
                    data="http://www.twitch.tv/widgets/live_embed_player.swf?channel=<?php echo $s->channel->login; ?>" bgcolor="#000000">
                <param name="allowFullScreen" value="true" />
                <param name="allowScriptAccess" value="always" />
                <param name="allowNetworking" value="all" />
                <param name="movie" value="http://www.twitch.tv/widgets/live_embed_player.swf" />
                <param name="flashvars" value="hostname=www.twitch.tv&channel=<?php echo $s->channel->login; ?>&auto_play=true&start_volume=25" />
            </object>

        </a>
        <span class="label label-success"><?php echo $s->channel_count; ?></span> viewers
    </div>

    <?php

}
?>