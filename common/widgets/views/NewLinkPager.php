<?php if(empty($type)){?>
<ul class="example-takePage-bar" >
    <li class="example-takePage-item"><a class="example_takePage_btn"  href="<?= $pagination->createUrl($prePage['page']) ?>" style="color:inherit"><span class="fy_st"><<</span></a></li>
    <?php foreach( $buttons as  $val ){ ?>
    <li class="example-takePage-item <?php if( $val['active'] ){ echo 'example-page-choice'; } ?>"><a class="example_takePage_btn" href="<?= $pagination->createUrl($val['page']) ?>" style="color:inherit"><span class="fy_st"><?= $val['label'] ?></span></a></li>
    <?php } ?>
    <li class="example-takePage-item"><a class="example_takePage_btn" href="<?= $pagination->createUrl($nextPage['page']) ?>" style="color:inherit"><span class="fy_st">>></span></a></li>
</ul>
<?php }else{?>
<div class="page_bar">
    <i class="page_count">共<span class="count_df"><?= $pagination->getPageCount() ?></span>页</i>
    <i class="page_box">
    <a class="page_item ht_click-active page_pre_btn" href="<?= $pagination->createUrl($prePage['page']) ?>">上一页</a>
<!--     <a class="page_item ht_click-active page_first_btn">首页</a> -->
    <?php foreach( $buttons as  $val ){ ?>
    <a class="page_item ht_click-active page_sub_btn <?php if( $val['active'] ){ echo 'page_item_on'; } ?>" ref="<?= $pagination->createUrl($val['page']) ?>"><?= $val['label'] ?></a>
    <?php }?>
<!--     <a class="page_item ht_click-active page_last_btn">尾页</a> -->
    <a class="page_item ht_click-active page_next_btn" href="<?= $pagination->createUrl($nextPage['page']) ?>">下一页</a>
    </i>
  </div>
 <?php }?>
