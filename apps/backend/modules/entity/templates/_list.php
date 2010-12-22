<div class="sf_admin_list">
  <?php if (!$pager->getNbResults()): ?>
    <p><?php echo __('No result', array(), 'sf_admin') ?></p>
  <?php else: ?>
    <table id="main_list" cellspacing="0">
      <thead>
        <tr>
          <th id="sf_admin_list_batch_actions"><input id="sf_admin_list_batch_checkbox" type="checkbox" onclick="checkAll();" /></th>
          <?php include_partial('entity/list_th_tabular', array('sort' => $sort)) ?>
          <th id="sf_admin_list_th_actions"><?php echo __('Actions', array(), 'sf_admin') ?></th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <th colspan="13">
            <?php if ($pager->haveToPaginate()): ?>
              <?php include_partial('entity/pagination', array('pager' => $pager)) ?>
            <?php endif; ?>

            <?php echo format_number_choice('[0] no result|[1] 1 result|(1,+Inf] %1% results', array('%1%' => $pager->getNbResults()), $pager->getNbResults(), 'sf_admin') ?>
            <?php if ($pager->haveToPaginate()): ?>
              <?php echo __('(page %%page%%/%%nb_pages%%)', array('%%page%%' => $pager->getPage(), '%%nb_pages%%' => $pager->getLastPage()), 'sf_admin') ?>
            <?php endif; ?>
          </th>
        </tr>
      </tfoot>
      <tbody>
        <?php foreach ($pager->getResults() as $i => $entity): $odd = fmod(++$i, 2) ? 'odd' : 'even' ?>
          <tr id="node-<?php echo $entity['id'] ?>" class="sf_admin_row <?php echo $odd ?> <?php
      // insert hierarchical info
      $node = $entity->getNode();
      if ($node->isValidNode() && $node->hasParent())
      {
        echo "child-of-node-" . $node->getParent()->getId();
      }
          ?>">
                <?php include_partial('entity/list_td_batch_actions', array('entity' => $entity, 'helper' => $helper)) ?>
                <?php include_partial('entity/list_td_tabular', array('entity' => $entity)) ?>
                <?php include_partial('entity/list_td_actions', array('entity' => $entity, 'helper' => $helper)) ?>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</div>
<script type="text/javascript">
  /* <![CDATA[ */
  function checkAll()
  {
    var boxes = document.getElementsByTagName('input'); for(var index = 0; index < boxes.length; index++) { box = boxes[index]; if (box.type == 'checkbox' && box.className == 'sf_admin_batch_checkbox') box.checked = document.getElementById('sf_admin_list_batch_checkbox').checked } return true;
  }
  
  $(function () {
    var getIdForRow = function (row) {
      return $.trim(row.find('.sf_admin_list_td_id:not(.ui-draggable-dragging)').text())
    };
    $("#main_list").treeTable({
      treeColumn: 1,
      initialState: 'expanded',
      draggable : true,
      sortable : true,
      dragTarget : "#main_list tr td.sf_admin_list_td_id",
      dropTarget : "#main_list tbody tr",
      branchMovedAsFirstChild : function(node, parent) {
        var url = $.urlTemplate("<?php
  echo url_for("entity_moveAsFirstChild", array(
      'id' => ':id',
      'parentId' => ':parentId'
  ))
  ?>").generate({
          id: getIdForRow(node),
          parentId: getIdForRow(parent)
        });

        $.post(url);
      },
      branchMovedAsPrevSibling : function(node, nextSibling) {
        var url = $.urlTemplate("<?php
  echo url_for("entity_moveAsPrevSibling", array(
      'id' => ':id',
      'nextSiblingId' => ':nextSiblingId'
  ))
  ?>").generate({
        id: getIdForRow(node),
        nextSiblingId: getIdForRow(nextSibling)
      });

      $.post(url);
    },
    branchMovedAsNextSibling : function(node, prevSibling) {
      var url = $.urlTemplate("<?php
  echo url_for("entity_moveAsNextSibling", array(
      'id' => ':id',
      'prevSiblingId' => ':prevSiblingId'
  ))
  ?>").generate({
      id: getIdForRow(node),
      prevSiblingId: getIdForRow(prevSibling)
    });

    $.post(url);
  }
});

// Make visible that a row is clicked
$("#main_list tbody tr").mousedown(function() {
  $("tr.selected").removeClass("selected"); // Deselect currently selected rows
  $(this).addClass("selected");
});

// Make sure row is selected when span is clicked
$("#main_list tbody tr span").mousedown(function() {
  $($(this).parents("tr")[0]).trigger("mousedown");
});
});
/* ]]> */
</script>
