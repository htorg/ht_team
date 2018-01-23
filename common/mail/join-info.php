<?php 
use common\helpers\SiteHelper;
?>

<style>
p{min-width:130px;padding:10px 0;}
input{border:none}
textarea{border:none}
</style>

<h2>A New Order</h2>
<p> <label>姓名:</label><input type="text" value="<?= $info['name'] ?>"></p>
<p> <label>电话:</label><input type="text" value="<?= $info['phone'] ?>"></p>
<p> <label>邮箱:</label><input type="text" value="<?= $info['mail'] ?>"></p>
<p> <label>地址:</label><input type="text" value="<?= $info['address'] ?>"></p>
<p> <label>产品名称:</label><input type="text" value="<?= $info['product'] ?>"></p>
<p> <label>应用场合:</label><input type="text" value="<?= $info['place'] ?>"></p>
<p> <label>留言信息:</label><textarea rows="" cols=""><?= $info['message'] ?></textarea></p>
