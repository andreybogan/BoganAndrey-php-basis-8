<a href="/catalog">Вернуться в каталог товаров.</a>

<h1><?= $arrProduct['name'] ?></h1>
<p><?= $arrProduct['text'] ?></p>
<p>Цена: <?= $arrProduct['price'] ?></p>

<?php if (isset($_SESSION['user'])) : ?>
  <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="post" style="margin-bottom: 36px">
    <input type="hidden" name="id_prod" value="<?= $arrProduct['id_prod'] ?>">
    <input type="submit" name="submitAddBasket" class="submit" value="Добавить в корзину">
  </form>
<?php endif; ?>

<?php foreach ($arrProductImg as $value): ?>
  <a href="http://<?= $_SERVER['HTTP_HOST'] ?>/images/big/<?= $value['img'] ?>" target="_blank"
     style="display: inline-block;">
    <img src="http://<?= $_SERVER['HTTP_HOST'] ?>/images/small/<?= $value['img'] ?>" alt="">
  </a>
<?php endforeach; ?>