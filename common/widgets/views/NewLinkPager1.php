<p class="page_bar">
    <a class="page_item" href="<?= $pagination->createUrl($prePage['page']) ?>">上一页</a>
    <?php foreach( $buttons as  $val ){ ?>
    <a class="page_item  <?php if( $val['active'] ){ echo 'page_on'; } ?>" href="<?= $pagination->createUrl($val['page']) ?>"><?= $val['label'] ?></a>
    <?php } ?>
    <a class="page_item" href="<?= $pagination->createUrl($nextPage['page']) ?>">下一页</a>
</p>