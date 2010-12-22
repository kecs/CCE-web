<div class="sf_admin_list">
  [?php if (!$pager->getNbResults()): ?]
  <p>[?php echo __('No result', array(), 'sf_admin') ?]</p>
  [?php else: ?]
  <table id="main_list" cellspacing="0">
    <thead>
      <tr>
        <?php if ($this->configuration->getValue('list.batch_actions')): ?>
          <th id="sf_admin_list_batch_actions"><input id="sf_admin_list_batch_checkbox" type="checkbox" onclick="checkAll();" /></th>
        <?php endif; ?>
        [?php include_partial('<?php echo $this->getModuleName() ?>/list_th_<?php echo $this->configuration->getValue('list.layout') ?>', array('sort' => $sort)) ?]
        <?php if ($this->configuration->getValue('list.object_actions')): ?>
          <th id="sf_admin_list_th_actions">[?php echo __('Actions', array(), 'sf_admin') ?]</th>
        <?php endif; ?>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <th colspan="<?php echo count($this->configuration->getValue('list.display')) + ($this->configuration->getValue('list.object_actions') ? 1 : 0) + ($this->configuration->getValue('list.batch_actions') ? 1 : 0) ?>">
          [?php if ($pager->haveToPaginate()): ?]
          [?php include_partial('<?php echo $this->getModuleName() ?>/pagination', array('pager' => $pager)) ?]
          [?php endif; ?]

          [?php echo format_number_choice('[0] no result|[1] 1 result|(1,+Inf] %1% results', array('%1%' => $pager->getNbResults()), $pager->getNbResults(), 'sf_admin') ?]
          [?php if ($pager->haveToPaginate()): ?]
          [?php echo __('(page %%page%%/%%nb_pages%%)', array('%%page%%' => $pager->getPage(), '%%nb_pages%%' => $pager->getLastPage()), 'sf_admin') ?]
          [?php endif; ?]
        </th>
      </tr>
    </tfoot>
    <tbody>
      [?php foreach ($pager->getResults() as $i => $<?php echo $this->getSingularName() ?>): $odd = fmod(++$i, 2) ? 'odd' : 'even' ?]
      [?php $node = $<?php echo $this->getModuleName() ?>->getNode() ?]
      [?php $childOf = ($node->isValidNode() && $node->hasParent()) ? "child-of-node-" . $node->getParent()->getId() : '' ?]

      <tr id="node-[?php echo $<?php echo $this->getModuleName() ?>['id'] ?]" class="sf_admin_row [?php echo $odd ?] [?php echo $childOf ?]">
        <?php if ($this->configuration->getValue('list.batch_actions')): ?>
          [?php include_partial('<?php echo $this->getModuleName() ?>/list_td_batch_actions', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'helper' => $helper)) ?]
        <?php endif; ?>
        [?php include_partial('<?php echo $this->getModuleName() ?>/list_td_<?php echo $this->configuration->getValue('list.layout') ?>', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>)) ?]
        <?php if ($this->configuration->getValue('list.object_actions')): ?>
          [?php include_partial('<?php echo $this->getModuleName() ?>/list_td_actions', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'helper' => $helper)) ?]
        <?php endif; ?>
      </tr>
      [?php endforeach; ?]
    </tbody>
  </table>
  [?php endif; ?]
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
        var url = $.urlTemplate("[?php
        echo url_for("<?php echo $this->getModuleName() ?>_moveAsFirstChild", array(
            'id' => ':id',
            'parentId' => ':parentId'
        ))
        ?]").generate({
                    id: getIdForRow(node),
                    parentId: getIdForRow(parent)
                  });

                  $.post(url);
                },
                branchMovedAsPrevSibling : function(node, nextSibling) {
                  var url = $.urlTemplate("[?php
        echo url_for("<?php echo $this->getModuleName() ?>_moveAsPrevSibling", array(
            'id' => ':id',
            'nextSiblingId' => ':nextSiblingId'
        ))
        ?]").generate({
                  id: getIdForRow(node),
                  nextSiblingId: getIdForRow(nextSibling)
                });

                $.post(url);
              },
              branchMovedAsNextSibling : function(node, prevSibling) {
                var url = $.urlTemplate("[?php
        echo url_for("<?php echo $this->getModuleName() ?>_moveAsNextSibling", array(
            'id' => ':id',
            'prevSiblingId' => ':prevSiblingId'
        ))
        ?]").generate({
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
