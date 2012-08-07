<?php
$title = 'All Problems';
$stylesheets = array('tablesorter');
include(__DIR__ . '/../layout/header.php');
?>
<div class="page-header">
  <form method="GET" action="<?php echo SITE_BASE; ?>/problems" class="pull-right form-search">
    <input type="number" class="input-small search-query" placeholder="ID" name="id" maxlength="20">
    <input type="text" class="input-medium search-query" placeholder="Title" name="title" maxlength="100" value="<?php echo fHTML::encode($this->title); ?>">
    <input type="text" class="input-medium search-query" placeholder="Author" name="author" maxlength="100" value="<?php echo fHTML::encode($this->author); ?>">
    <button type="submit" class="btn btn-primary">
      <i class="icon-filter icon-white"></i> Filter
    </button>
    <?php if (strlen($this->title) or strlen($this->author)): ?>
      <a class="btn" href="<?php echo SITE_BASE; ?>/problems">Cancel</a>
    <?php endif; ?>
  </form>
  <h1>All Problems</h1>
</div>
<?php include(__DIR__ . '/../layout/_pagination.php'); ?>
<table id="problems" class="tablesorter table table-bordered table-striped">
  <thead>
    <tr>
      <th>ID</th>
      <th>Title</th>
      <th>Author</th>
      <th>Ratio (AC/submit)</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($this->problems as $p): ?>
      <tr>
        <td>
          <?php echo $p->getId(); ?>
          <?php if (fAuthorization::checkLoggedIn() and User::hasAccepted($p)): ?>
            <i class="icon-ok"></i>
          <?php endif; ?>
        </td>
        <td><a href="<?php echo SITE_BASE; ?>/problem/<?php echo $p->getId(); ?>"><?php echo fHTML::encode($p->getTitle()); ?></a></td>
        <td><?php echo fHTML::encode($p->getAuthor()); ?></td>
        <td><?php echo $p->getRatio(); ?>% (<?php echo $p->getAcceptCount(); ?>/<?php echo $p->getSubmitCount(); ?>)</td>
        <td><a href="<?php echo SITE_BASE; ?>/submit?problem=<?php echo $p->getId(); ?>">Submit</a></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<div class="alert alert-info">
  Sort multiple columns simultaneously by 
  holding down the <strong>shift</strong> key and 
  clicking a second, third or even fourth column header!
</div>
<?php
include(__DIR__ . '/../layout/_pagination.php');
$javascripts = array('jquery.tablesorter.min', 'problems');
include(__DIR__ . '/../layout/footer.php');
