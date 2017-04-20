<ul class="breadcrumb">
    <?php foreach($template_breadcrumbs as $crumb): ?>
    <li><a href="<?php echo $crumb['link']; ?>"><?php echo $crumb['display'] ?></a></li>
    <?php endforeach; ?>
</ul>