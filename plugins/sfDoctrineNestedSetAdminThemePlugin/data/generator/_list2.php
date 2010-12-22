      <tr
        id="node-[?php echo $account['id'] ?]"
        class="sf_admin_row [?php echo $odd ?]
        [?php
        // insert hierarchical info
        $node = $account->getNode();
        if ($node->isValidNode() && $node->hasParent())
        {
          echo "child-of-node-" . $node->getParent()->getId();
          }
          ?]
          "
          >
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
      return $.trim(row.find('.sf_admin_list_td_id').text())
    };
    $("#main_list").treeTable({
      treeColumn: 2,
      initialState: 'expanded',
      draggable : true,
      sortable : true,
      dragTarget : "#main_list tr td.sf_admin_list_td_name",
      dropTarget : "#main_list tbody tr",
      branchMovedAsFirstChild : function(node, parent) {
        var url = $.urlTemplate("<?php
            echo url_for("account_moveAsFirstChild", array(
                'id' => ':id',
                'parentId' => ':parentId'
            )) ?>").generate({
                  id: getIdForRow(node),
                  parentId: getIdForRow(parent)
            });

        $.post(url);
      },
      branchMovedAsPrevSibling : function(node, nextSibling) {
        var url = $.urlTemplate("<?php
            echo url_for("account_moveAsPrevSibling", array(
                'id' => ':id',
                'nextSiblingId' => ':nextSiblingId'
            )) ?>").generate({
                  id: getIdForRow(node),
                  nextSiblingId: getIdForRow(nextSibling)
            });

        $.post(url);
      },
      branchMovedAsNextSibling : function(node, prevSibling) {
        var url = $.urlTemplate("<?php
            echo url_for("account_moveAsNextSibling", array(
                'id' => ':id',
                'prevSiblingId' => ':prevSiblingId'
            )) ?>").generate({
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
