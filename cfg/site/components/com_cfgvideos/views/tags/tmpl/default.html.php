<? defined('KOOWA') or die; ?>

<ktml:style src="media://com_cfgvideos/css/style.css" />

<? if ($params->get('show_page_heading', false)): ?>
<div class="page-header">
    <h1><?= $params->get('page_heading');?></h1>
</div>
<? endif; ?>
<?
$config = KObjectManager::getInstance()->getObject('object.config.factory')->fromString('json', $params->get('tags'));

$tag_ids = $config->get('tag');
$image = $config->get('image');

?>
<div class="row-fluid cfgv--tags">
    <? foreach ($tag_ids as $index => $tag_id) :
        $tag = KObjectManager::getInstance()->getObject('com://site/cfgvideos.model.tags')->id($tag_id) ?>
    <div class="cfgv--tag">
        <a class="cfgv--tag__link" href="<?= ($params->get('tag_link_type') == 'videos' ? route('view=videos&tag[]=' . $tag->slug) : $tag->k2_link); ?>">
            <img class="cfgv--tag__link--image" src="<?= $image[$index] ?>" />

            <span class="cfgv--tag__link--title"><?= escape($tag->title); ?></span>
        </a>
    </div>
    <? endforeach ?>
</div>

