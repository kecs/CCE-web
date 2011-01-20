<?php if (isset($records) && is_object($records) && count($records) > 0): ?>
  <div id="<?php echo strtolower($model); ?>-nested-set">
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
                <input type="submit" value="<?php echo __('Delete Node') ?>"></input>
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
      return NODE.attr("id").replace('phtml_','');
    }
    
    $("#<?php echo strtolower($model); ?>-nested-set").jstree({
      plugins : [ "themes", "html_data", 'dnd' ]
    })
    .jstree('open_all');

    /*
        onmove: function(NODE, REF_NODE, TYPE, TREE_OBJ, RB){
          $('.error, .notice').remove();
          $('.nested_set_manager_holder').before('<div class="waiting"><?php echo __('Sending data to server.'); ?></div>');
          $.ajax({
            type: "POST",
            url : '<?php echo url_for('entity/Move'); ?>',
            dataType : 'json',
            data : 'root=<?php echo $root; ?>&model=<?php echo $model; ?>&id=' + NODE.id.replace('phtml_','') +'&to_id=' + REF_NODE.id.replace('phtml_','') + '&movetype=' + TYPE,
            complete : function(){
              $('.waiting').remove();
            },
            success : function (data, textStatus) {
              $('.nested_set_manager_holder').before('<div class="notice"><?php echo __('The item was moved successfully.'); ?></div>');
            },
            error : function (data, textStatus) {
              $('.nested_set_manager_holder').before('<div class="error"><?php echo __('Error while moving the item.'); ?></div>');
              $.tree.rollback(RB);
            }
          });
        },

        ondelete: function(NODE, TREE_OBJ, RB){
          $('.error, .notice').remove();
          $('.nested_set_manager_holder').before('<div class="waiting"><?php echo __('Sending data to server.'); ?></div>');
          $.ajax({
            type: "POST",
            url : '<?php echo url_for('entity/Delete'); ?>',
            dataType : 'json',
            data : 'root=<?php echo $root; ?>&model=<?php echo $model; ?>&id=' + NODE.id.replace('phtml_',''),
            complete : function(){ 
              $('.waiting').remove();
            },
            success : function (data, textStatus) {
              $('.nested_set_manager_holder').before('<div class="notice"><?php echo __('The item was deleted successfully.'); ?></div>');
            },
            error : function (data, textStatus) {
              $('.nested_set_manager_holder').before('<div class="error"><?php echo __('Error while deleting the item.'); ?></div>');
              $.tree.rollback(RB);
            }
          });
        }
      }
    });*/
    
    $('.createnode').click(function(e){
      var id = getId($(this).closest('li'));
      t.create();
    });
                
    $('.deletenode').click(function(e){
      var t = $.tree.focused(); 
      if(t.selected) {
        if ( t.parent(t.selected) == -1){
          alert("<?php echo __('forbidden to remove root node'); ?>")
        }else{
          t.remove();
        }
      } 
      else {
        alert("Select a node first");
      }
    });

  });
  /* ]]> */
</script>



