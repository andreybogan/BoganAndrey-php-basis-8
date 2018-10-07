<a href="/admin">Вернуться к списку товаров.</a>

<?php if (isset($_SESSION['user'])) : ?>

  <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="post" style="margin: 36px 0">
    <label for="name">Название товара</label>
    <input type="text" name="prod[name]" id="name" value="<?= $arrProduct['name'] ?>" required>
    <label for="text">Описание товара</label>
    <textarea id="text" name="prod[text]" rows="8" required><?= $arrProduct['text'] ?></textarea>
    <label for="price">Цена</label>
    <input type="text" name="prod[price]" id="price" value="<?= $arrProduct['price'] ?>" required>
    <input type="hidden" name="prod[id_prod]" value="<?= $arrProduct['id_prod'] ?>">
    <input type="submit" name="prod[submitEdit]" class="submit" value="Сохранить">
  </form>


  <?php foreach ($arrProductImg as $value): ?>
    <a href="http://<?= $_SERVER['HTTP_HOST'] ?>/images/big/<?= $value['img'] ?>" target="_blank"
       style="display: inline-block;">
      <img src="http://<?= $_SERVER['HTTP_HOST'] ?>/images/small/<?= $value['img'] ?>" alt="">
    </a>
  <?php endforeach; ?>

<?php else: ?>
  <p>Эту страницу могу просматривать только зарегистрированные пользователи.</p>
<?php endif; ?>