<?
/**
 * Cfgvideos - a Joomla example extension built with Nooku Framework.
 *
 */

defined('KOOWA') or die; ?>

<?= helper('behavior.validator'); ?>

<ktml:style src="media://koowa/com_koowa/css/admin.css" />

<ktml:module position="toolbar">
    <ktml:toolbar type="actionbar" icon="cfg-add icon-pencil-2">
</ktml:module>

<div class="cfg_form_layout">
	<form action="" method="post" class="-koowa-form">
		<div class="cfg_container">
			<div class="cfg_grid">
				<div class="cfg_grid_video two-thirds">
					<fieldset>
						<legend><?= translate('Details') ?></legend>
						<div class="cfg_grid">
							<div class="control-group cfg_grid__video two-thirds">
								<label class="control-label" for="cfg_form_title">
									<?= translate("Title") ?>
								</label>
								<div class="controls">
									<div class="input-group">
										<input class="input-group-form-control" id="cfg_form_title" type="text" name="title" maxlength="255" value="<?= escape($video->title) ?>"/>
									</div>
								</div>
							</div>

							<div class="control-group cfg_grid__video two-thirds">
								<label class="control-label" for="cfg_form_url">
									<?= translate("Url") ?>
								</label>
								<div class="controls">
									<div class="input-group">
										<input class="input-group-form-control" id="cfg_form_url" type="text" name="video_url" maxlength="255" value="<?= escape($video->video_url) ?>"/>
									</div>
								</div>
							</div>

							<div class="control-group cfg_grid__video two-thirds">
								<label class="control-label" for="cfg_form_img_url">
									<?= translate("Image Url") ?>
								</label>
								<div class="controls">
									<div class="input-group">
										<input class="input-group-form-control" id="cfg_form_img_url" type="text" name="img_url" maxlength="255" value="<?= escape($video->img_url) ?>"/>
									</div>
								</div>
							</div>

							<div class="control-group cfg_grid__video two-thirds">
							    <label><?= translate('Tags'); ?></label>
							    <?= helper('listbox.tags', array('entity' => $video)) ?>
							</div>
						</div>

						<legend><?= translate('Description') ?></legend>

						<div class="cfg_grid description_container">
						    <div class="control-group cfg_grid__video one-whole">
						        <div class="controls">
						            <?= helper('editor.display', array(
						                'name' => 'description',
						                'value' => $video->description,
						                'id'   => 'description',
						                'width' => '100%',
						                'height' => '341',
						                'cols' => '100',
						                'rows' => '20',
						                'buttons' => array('pagebreak')
						            )); ?>
						        </div>
						    </div>
						</div>
					</fieldset>
				</div>
				<div class="cfg_grid__video one-third">
				    <fieldset>

				        <legend><?= translate('Publishing') ?></legend>

				        <div class="cfg_grid">
				            <div class="control-group cfg_grid__video one-whole">
				                <label class="control-label"><?= translate('Status'); ?></label>
				                <div class="controls radio btn-group">
				                    <?= helper('select.booleanlist', array(
				                        'name'     => 'enabled',
				                        'selected' => $video->enabled,
				                        'true'     => translate('Published'),
				                        'false'    => translate('Unpublished')
				                    )); ?>
				                </div>
				            </div>
				        </div>
				    </fieldset>
				</div>
			</div>
		</div>
	</form>
</div>