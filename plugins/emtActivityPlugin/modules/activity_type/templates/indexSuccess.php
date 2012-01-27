<h1>Activity types List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Type</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($activity_types as $activity_type): ?>
    <tr>
      <td><a href="<?php echo url_for('activity_type/show?id='.$activity_type->getId()) ?>"><?php echo $activity_type->getId() ?></a></td>
      <td><?php echo $activity_type->getType() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('activity_type/new') ?>">New</a>
