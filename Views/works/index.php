<?php session_start(); ?>
<div id="myDIV" class="header">
    <h2 style="margin:5px"><?= $title; ?></h2>
    <?php include 'form.php'; ?>
</div>
<?php include 'list.php'; ?>
