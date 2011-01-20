<ul class="sf_admin_actions">
  <?php if ($hasManyRoots): ?>
    <li class="sf_admin_action_list">
      <?php echo link_to(__('Back to root list'), $sf_request->getParameter('module') . '/' . $sf_request->getParameter('action')); ?>
    <?php endif; ?>
</ul>
