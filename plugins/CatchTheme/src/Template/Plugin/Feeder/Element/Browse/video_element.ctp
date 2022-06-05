<?php /** @var \Feeder\Model\Entity\FeederCategory $feederCategory */ ?>

<div id="cat-video-row" class="col-12">
    <div id="cat-video-container">
        <div class="container">
            <div class="video-wrapper row">
                <div class="video-text-container col-12 col-sm-6 col-lg-7"><?php if ($feederCategory->feeder_categories_video_element->headline) : echo $feederCategory->feeder_categories_video_element->headline; else : echo ''; endif; ?></div>
                <div class="video-container col-12 col-sm-4 col-lg-3">
                    <div class="video-element">
                    <video id="video" autoplay loop muted playsinline preload>
                        <?php if ($feederCategory->feeder_categories_video_element->video_mp4) : ?>
                        <source src="<?= $this->Url->image($feederCategory->feeder_categories_video_element->video_mp4) ?>" type="video/mp4">
                        <?php endif; ?>
                        <?php if ($feederCategory->feeder_categories_video_element->video_webm) : ?>
                        <source src="<?= $this->Url->image($feederCategory->feeder_categories_video_element->video_webm) ?>" type="video/webm">
                        <?php endif; ?>
                        Your browser does not support the html5 video tag.
                    </video>
                    </div>
                </div>
                <div class="video-decoration col-2"></div>
            </div>
        </div>
    </div>
</div>
<style>
    #cat-video-row #cat-video-container {
    <?php if ($feederCategory->feeder_categories_video_element->background_color) : ?><?=  "background-color:" . $feederCategory->feeder_categories_video_element->background_color . ";" ?><?php endif; ?>
    }
    #cat-video-row #cat-video-container .video-wrapper .video-text-container {
    <?php if ($feederCategory->feeder_categories_video_element->headline_color) : ?><?=  "color:" . $feederCategory->feeder_categories_video_element->headline_color . ";" ?><?php endif; ?>
    }
</style>
