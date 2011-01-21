<?php use_helper('I18N', 'Date', 'JavascriptBase') ?>
<?php include_partial('entity/assets') ?>
<div id="sf_admin_container">
  <?php include_partial('header') ?>

  <div class="sf_admin_list">
    <?php if (!$roots->count()): ?>
      <p><?php echo __('No root', array(), 'sf_admin') ?></p>
    <?php else: ?>
      <table cellspacing="0">
        <thead>
          <tr>
            <th id="sf_admin_text sf_admin_list_th_entity">Name</th>
            <th id="sf_admin_list_th_actions"><?php echo __('Actions', array(), 'sf_admin') ?></th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th colspan="2"> <?php echo $roots->count(); ?> <?php echo __('Roots'); ?></th>
          </tr>
        </tfoot>	
        <tbody>
          <?php foreach ($roots as $i => $root): $odd = fmod(++$i, 2) ? 'odd' : 'even' ?>
            <tr class="sf_admin_row <?php echo $odd ?>">
              <td class="sf_admin_text sf_admin_list_td_field"><?php echo $root ?></td>
              <td>
                <ul class="sf_admin_td_actions">
                  <li class="sf_admin_action_edit"><?php echo link_to(__('Manage Tree'), 'entity_index', $root) ?></li>
                  <li class="sf_admin_action_delete"><?php echo link_to(__('Delete Tree'), 'entity_delete', $root, array('method' => 'delete', 'confirm' => 'Biztos??')) ?></li>
                </ul>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php endif; ?>
  </div>
  <div class="sf_admin_actions">
    <div>
      <form id="entity_root_create" action="<?php echo url_for('entity_addRoot'); ?>" method="post">
        <button type="submit">
          <img class="actionImage" src="/assets/TreeManager/node-insert-next.png" /><?php echo __('Create New Home'); ?>
        </button>
      </form>
    </div>
  </div>

</div>



