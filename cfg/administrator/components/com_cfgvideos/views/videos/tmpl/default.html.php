<?
/**
 * Cfgvideos - a Joomla example extension built with Nooku Framework.
 *
 */

defined('KOOWA') or die; ?>

<?= helper('bootstrap.load', array('javascript' => true)); ?>
<?= helper('behavior.koowa'); ?>

<ktml:style src="media://koowa/com_koowa/css/admin.css" />

<ktml:module position="submenu">
    <ktml:toolbar type="menubar">
</ktml:module>

<ktml:module position="toolbar">
    <ktml:toolbar type="actionbar" title="COM_CFGVIDEOS" icon="task icon-stack">
</ktml:module>

<div class="cfg-container">
	<div class="cfg_admin_list_grid">
		<form action="" method="get" class="-koowa-grid">
			<!-- Scopebar container -->
			<div class="scopebar">
			    <div class="scopebar-group hidden-tablet hidden-phone">
			        <a class="<?= is_null(parameters()->enabled) ? 'active' : ''; ?>"
			           href="<?= route('enabled=&search=' ) ?>">
			            <?= translate('All') ?>
			        </a>
			    </div>
			    <div class="scopebar-group last hidden-tablet hidden-phone">
			        <a class="<?= parameters()->enabled === 0 ? 'active' : ''; ?>"
			           href="<?= route('enabled='.(parameters()->enabled === 0 ? '' : '0')) ?>">
			            <?= translate('Unpublished') ?>
			        </a>
			        <a class="<?= parameters()->enabled === 1 ? 'active' : ''; ?>"
			           href="<?= route('enabled='.(parameters()->enabled === 1 ? '' : '1')) ?>">
			            <?= translate('Published') ?>
			        </a>
			    </div>
			    <div class="scopebar-search">
			        <?= helper('grid.search', array('submit_on_clear' => true)) ?>
			    </div>
			</div>
			<!-- End of scopebar -->
			<!-- Cfg table container -->
			<div class="cfg_table_container">
				<table class="table table-striped footable">
					<thead>
						<tr>
							<th style="text-align: center;" width="1">
							    <?= helper('grid.checkall')?>
							</th>
							<th class="cfg_table__title_field">
							    <?= helper('grid.sort', array('column' => 'title', 'title' => 'Title')); ?>
							</th>
							<th width="5%" data-hide="phone,phablet">
							    <?= helper('grid.sort', array('column' => 'enabled', 'title' => 'Status')); ?>
							</th>
							<th width="5%" data-hide="phone,phablet,tablet">
							    <?= helper('grid.sort', array('column' => 'created_by', 'title' => 'Owner')); ?>
							</th>
							<th width="10%" data-hide="phone,phablet">
							    <?= helper('grid.sort', array('column' => 'created_on', 'title' => 'Date')); ?>
							</th>
						</tr>
					</thead>
					<? if (count($videos)): ?>
						<tfoot>
							<tr>
								<td colspan="9">
									<?= helper('paginator.pagination') ?>
								</td>
							</tr>
						</tfoot>
					<? endif; ?>
					<tbody>
						<? foreach ($videos as $video): ?>
						<tr>
							<td style="text-align: center">
								<?= helper('grid.checkbox', array('entity' => $video)) ?>
							</td>
							<td class="cfg_table__title_field">
							    <a href="<?= route('view=video&id='.$video->id); ?>">
							        <?= escape($video->title); ?></a>
							</td>
							<td style="text-align: center">
								<?= helper('grid.publish', array('entity' => $video, 'clickable' => true)) ?>
							</td>
							<td>
								<?= escape($video->getAuthor()->getName()); ?>
							</td>
							<td>
							    <?= helper('date.format', array('date' => $video->created_on)); ?>
							</td>
						</tr>
						<? endforeach; ?>

						<? if (!count($videos)) : ?>
						<tr>
						    <td colspan="9" align="center" style="text-align: center;">
						        <?= translate('No videos found.') ?>
						    </td>
						</tr>
						<? endif; ?>
					</tbody>
				</table>
			</div>
			<!-- End of cfg table container -->
		</form>
	</div>
</div>