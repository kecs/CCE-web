<?php load_assets('sfJqueryTree') ?>
<?php load_assets('jquery.urlTemplate') ?>
<?php if (isset($records) && is_object($records) && count($records) > 0): ?>
  <div id="entity-nested-set">
    <ul class="nested_set_list">
      <?php $prevLevel = 0; ?>      
      <?php foreach ($records as $record): ?>
        <?php
        if ($prevLevel > 0 && $record['level'] == $prevLevel)
          echo '</li>';

        if ($record['level'] > $prevLevel)
          echo '<ul>';
        elseif ($record['level'] < $prevLevel)
          echo str_repeat('</ul></li>', $prevLevel - $record['level']);
        ?>
        <li id ="phtml_<?php echo $record->id ?>">
          <a href="<?php echo url_for(sfInflector::underscore($record->type) . "_edit", array("id" => $record->id)) ?>">
            <?php echo $record ?>
          </a>
          <div class="sf_admin_actions">
            <div class="nodeinteraction createnode">
              <!--<a href="#"><?php echo __('Insert Subnode'); ?></a>-->
              <form action="<?php echo url_for('entity_addChild', $record) ?>" method="POST">
                <input name="type"></input>
                <input type="submit" value="<?php echo __('Insert Subnode') ?>"></input>
              </form>
            </div>
            <div class="nodeinteraction deletenode">
              <form action="<?php echo url_for('entity_delete', $record) ?>" method="POST">
                <input type="hidden" name="sf_method" value="delete" />
                <input type="submit" value="<?php echo __('Delete Node') ?>" />
              </form>
            </div>
          </div>

          <?php $prevLevel = $record['level']; ?>
        <?php endforeach; ?>        
    </ul>
  </div>
<?php endif; ?>
<script type="text/javascript">
  /* <![CDATA[ */
  
  $(function () {
    
    function getId(node) {
      return node.attr("id").replace('phtml_','');
    }
    
    function onMove(event, data){
      var movedNode = data.rslt.o;
      var referenceNode = data.rslt.r;
      var position = data.rslt.p;
      var rollback = data.rlbk;
      $('.error, .notice').remove();
      $('.nested_set_manager_holder').before('<div class="waiting"><?php echo __('Sending data to server.'); ?></div>');
      $.ajax({
        type: "POST",
        url : $.urlTemplate('<?php echo url_for('entity_move', array('id' => ':id')) ?>').generate({id: getId(movedNode)}),
        dataType : 'json',
        data : {
          referenceId: getId(referenceNode),
          position: position
        },
        complete : function(){
          $('.waiting').remove();
        },
        success : function (data, textStatus) {
          $('.nested_set_manager_holder').before('<div class="notice"><?php echo __('The item was moved successfully.'); ?></div>');
          jQuery.jstree._reference(referenceNode).open_node(referenceNode);
        },
        error : function (data, textStatus) {
          $('.nested_set_manager_holder').before('<div class="error"><?php echo __('Error while moving the item.'); ?></div>');
          $.jstree.rollback(rollback);
        }
      });
    };
    
    $("#entity-nested-set").jstree({
      plugins : [ "themes", "html_data", 'dnd' ]
    })
    .jstree('open_all')
    .bind('move_node.jstree', onMove);

  });
  /* ]]> */
</script>


