<h1>Каталог товаров</h1>

<div class="catalog">

  <?php foreach ($arrCatalog as $value): ?>
    <div class="item">
      <a href="catalog/catalog_one/<?= $value['id_prod'] ?>">
        <?php if ($value['img'] != ''): ?>
          <img src="./images/small/<?= $value['img'] ?>" alt="">
        <?php else: ?>
          <div class="plug">Фото отсутствует</div>
        <?php endif; ?>
      </a>
      <a href="catalog/catalog_one/<?= $value['id_prod'] ?>">
        <p><?= $value['name'] ?></p>
      </a>
      <p>Цена <?= $value['price'] ?> руб.</p>

      <?php if (isset($_SESSION['user'])) : ?>
        <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="post">
          <input type="hidden" name="id_prod" value="<?= $value['id_prod'] ?>">
          <input type="submit" name="submitAddBasket" class="submit" value="Добавить в корзину">
        </form>
      <?php endif; ?>
    </div>
  <?php endforeach; ?>

</div>