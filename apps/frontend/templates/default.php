<?php load_assets('layout') ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
  </head>
  <body>
    <div id="page_container">
      <div id="inner">
        <div id="topbar">
          <?php if ($sf_user->isAuthenticated()): ?>
            You are logged in as <?php echo $sf_user ?>
          <?php echo link_to('Log out', 'sf_guard_signout') ?>
          <?php endif ?>
          </div>
          <div id="mainheader">&nbsp;</div>
          <div id="navigation">
            <?php include_component('entity', 'index')?>
          </div>
          <div id="content">
          <?php echo $sf_content ?>
        </div>
        <br clear="all" />
      </div>
      <div id="copyright_container">
        <div id="copyright">
          <p>
            Copyright &copy; 2007 DAP Forum. All Rights Reserved
            <br />
            <a href="#">Terms, Conditions &amp; Privacy Policy</a>
            | Managed by BRE
          </p>
        </div>
        <br clear="all" />
      </div>
    </div>
  </body>
</html>
