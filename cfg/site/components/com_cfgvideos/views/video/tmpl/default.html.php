<?
/**
 * Cfgvideos - a Joomla example extension built with Nooku Framework.
 *
 */

defined('KOOWA') or die; ?>

<div class="cfgvideos_video">
    <h4 class="koowa_header">
        <? // Header title ?>
        <span class="koowa_header__video">
            <a class="koowa_header__title_link" href="<?= route('view=video&id='.$video->id); ?>">
                <?= escape($video->title); ?>
            </a>
         </span>
    </h4>
    <div class="video_description">
        <video controls src="<?= $video->video_url; ?>"></video>
        <?= JHtml::_('content.prepare', $video->description); ?>
    </div>

    <?= "Tags: " . implode(', ', array_column($video->getTags()->toArray(), 'title')); ?>
</div>