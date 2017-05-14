<?
/**
 * Cfgvideos - a Joomla example extension built with Nooku Framework.
 *
 */

defined('KOOWA') or die; ?>

<ktml:style src="media://koowa/com_koowa/css/site.css" />
<ktml:style src="media://com_cfgvideos/css/style.css" />

<? // Toolbar ?>

<div class="row-fluid">
    <? // Menu filtered by tags ?>
    <?= helper('tags.menu') ?>

    <? foreach ($videos as $video):?>
        <div class="">
            <div class="cfgvideos_video">
                <? // Header title ?>
                <h5 class="koowa_header">
                    <a class="koowa_header__title_link" href="<?= route('view=video&id='.$video->id); ?>">
                        <?= escape($video->title); ?>
                    </a>
                </h5>
                <p class="">
                    <?= $video->getVimeoData()->html?>
                </p>
                <?= "Tags: " . implode(', ', array_column($video->getTags()->toArray(), 'title')); ?>
            </div>
        </div>
    <? endforeach ?>
</div>

