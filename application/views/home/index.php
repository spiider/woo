<div class="alert alert-warning">
    Will we are working on our new features you can see some good streams below
</div>

<div class="col-sm-12">
    <table class="col-sm-4">
        <thead>
            <th>
                HLTV.org
            </th>
        </thead>
        <?php echo $rss_hltv; ?>
    </table>

    <table class="col-sm-4" >
        <thead>
        <th>
            Fraglider.pt
        </th>
        </thead>
        <?php echo $rss_frag; ?>
    </table>
    <table class="col-sm-4" >
        <thead>
        <th>
            Reddit.com
        </th>
        </thead>
        <?php echo $rss_reddit; ?>
    </table>

</div>
    <div class="row tooltip-demo">
        <h4 class="text-center">League of Legends Streams</h4>
        <?php
        $i = 0;
            foreach($lol_streams as $s) {
        ?>
            <div class="col-sm-6 col-md-3">
            <h5 class="text-center"><?php echo $s->channel->login; ?></h5>
            <a href="/stream/<?php echo $s->channel->login; ?>/view/" class="thumbnail"
             <?php  if(isset($s->title)) { ?>
               data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo $s->title; ?>"
             <?php } ?>
                >
                <img src="<?php echo $s->channel->screen_cap_url_large; ?>" alt="...">
            </a>
                <span class="label label-success"><?php echo $s->channel_count; ?></span> viewers
            </div>

        <?php
            $i++;
            if($i==4) break;
            }
        ?>
    </div>

    <div class="row tooltip-demo">
        <h4 class="text-center" >CS:GO Streams</h4>
        <?php
        $i = 0;
        foreach($csgo_streams as $s) {
            ?>
            <div class="col-sm-6 col-md-3">
                <h5 class="text-center" ><?php echo $s->channel->login; ?></h5>
                <a href="/stream/<?php echo $s->channel->login; ?>/view/" class="thumbnail"
                    <?php  if(isset($s->title)) { ?>
                        data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo $s->title; ?>"
                    <?php } ?>
                    >
                    <img src="<?php echo $s->channel->screen_cap_url_large; ?>" alt="...">
                </a>
                <span class="label label-success"><?php echo $s->channel_count; ?></span> viewers
            </div>

            <?php
            $i++;
            if($i==4) break;
        }
        ?>
    </div>

    <div class="row tooltip-demo">
        <h4 class="text-center" >Starcraft2 Streams</h4>
        <?php
        $i = 0;
        foreach($sc2_streams as $s) {
            ?>
            <div class="col-sm-6 col-md-3">
                <h5 class="text-center" ><?php echo $s->channel->login; ?></h5>
                <a href="/stream/<?php echo $s->channel->login; ?>/view/" class="thumbnail"
                    <?php  if(isset($s->title)) { ?>
                        data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo $s->title; ?>"
                    <?php } ?>
                    >
                    <img src="<?php echo $s->channel->screen_cap_url_large; ?>" alt="...">
                </a>
                <span class="label label-success"><?php echo $s->channel_count; ?></span> viewers
            </div>

            <?php
            $i++;
            if($i==4) break;
        }
        ?>
    </div>