<?php
// 初期化
$keyword = '';
$page = '';

// 検索入力キーワードのチェック
if (isset($_POST['searchtextbox'])) {
  $keyword = $_POST['searchtextbox'];
  // 空白入力
  $pattern = "^(\s|　)+$";
  if (mb_ereg_match($pattern, $keyword)) {
    // デフォルト設定
    $keyword = 'カニ';
  }
}

// 検索キーワードのデフォルト設定（初期値）
if ($keyword == '') {
  $keyword = 'カニ';
}

// ソートのデフォルト設定 - レビュー件数降順
$sort = '-reviewCount';

// 取得ページの初期設定
if ($page == '') {
  $page = 1;
}

// 1ページあたりの取得件数（商品数）
$hits_set = 10;

// 検索キーワード入力ボックス
$searchTextBox = '
<form action="" method="POST" name="form">
<input type="text" name="searchtextbox" value="' . $keyword . '" placeholder="キーワードで探す" style="width:240px;height:28px;vertical-align: top;">
<input type="submit" name="btn" value="Go" style="font-size:1.1rem;height:34px;vertical-align: top;">
</form>
';

// エンコーディング
$url_word = htmlspecialchars(urlencode($keyword));
$url_sort = htmlspecialchars(urlencode($sort));

// アプリID
$applicationId = '';
// アフィリエイトID
// $affiliateId = '';

// 楽天リクエストURLから楽天市場の商品情報を取得
$rakutenUrl = "https://app.rakuten.co.jp/services/api/IchibaItem/Search/20130805?format=xml&keyword=" . $url_word . "&sort=" . $url_sort . "&page=" . $page . "&hits=" . $hits_set . "&applicationId=" . $applicationId . "&affiliateId=" . $affiliateId;

// レスポンス取得
$contents = @file_get_contents($rakutenUrl);

// XMLオブジェクトに変換
$xml = simplexml_load_string($contents);

// 商品表示
// print '<table border="0"><tr>';
// $i = 0;
// foreach ($xml->Items->Item as $item) {
//   $affiliateUrl = $item->affiliateUrl;
//   $price = $item->itemPrice;
//   $mediumImageUrl = $item->mediumImageUrls->imageUrl;
//   $detail = $item->itemCaption;
//   $detail = mb_substr($detail, 0, 30, "UTF-8") . '・・・';

// 商品表示
//   print '<td style="padding:10px;">
//   <div><a href="' . $affiliateUrl . '" target="_blank"><img src="' . $mediumImageUrl . '"></a><br />' . $detail . ' </div><p>￥' . $price . '-</p>
//   <form>
//   <input type="button"
//           data-url=' . $affiliateUrl . '
//           data-image=' . $mediumImageUrl . '
//           data-price=' . $price . '
//           data-detail=' . $detail . '
//           value="php" onclick="bookMark()" >👍
//   </form>
//   </td>';

//   $i++;
//   if ($i % 5 == 0) {
//     print '</tr><tr>';
//   }
// }
// print '</table>';
// print '</div><!--end/container-->';
// print '<br />';
// print '</body></ht
// ml>';


// print <<< aff
// <!DOCTYPE html >
// <html lang="ja">
// <head>
// <meta charset=utf-8">
// <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
// <TITLE>楽天商品検索APIを利用した商品検索サンプルプログラム</TITLE>
// <meta name="Keywords" content=""> 
// <meta name="Description" content="">
// </head>
// <body>
// <div id="container" style="padding:10px 10px 40px;color:#1D56A5;">
// <div style="font-size:1.6rem;">楽天商品検索APIを利用した楽天商品検索サンプルプログラム</div><br />
// aff;
?>

<!DOCTYPE html>

<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <TITLE>楽天商品検索APIを利用した商品検索サンプルプログラム</TITLE>
  <meta name="Keywords" content="">
  <meta name="Description" content="">
</head>

<body>
  <div id="container" style="padding:10px 10px 40px;color:#1D56A5;">
    <div style="font-size:1.6rem;">楽天商品検索APIを利用した楽天商品検索サンプルプログラム</div>
    <br />
    <br />

    <!-- 検索キーワード入力ボックス -->
    <table>
      <tr>
        <td><?= $searchTextBox ?></td>
      </tr>
    </table>

    <!-- 商品表示 -->
    <table>
      <tr>
        <?php $i = 0; ?>
        <?php foreach ($xml->Items->Item as $item) : ?>
          <?php $affiliateUrl = $item->affiliateUrl; ?>
          <?php $price = $item->itemPrice; ?>
          <?php $mediumImageUrl = $item->mediumImageUrls->imageUrl; ?>
          <?php $detail = $item->itemCaption; ?>
          <?php $detail = mb_substr($detail, 0, 30, "UTF-8") . '・・・'; ?>

          <!-- 商品表示 -->
          <td style="padding:10px;">
            <div>
              <a href="<?= $affiliateUrl ?>" target="_blank">
                <img src="<?= $mediumImageUrl ?>">
              </a>
              <br /><?= $detail ?>
            </div>
            <p>￥<?= $price ?>-</p>
            <form action="input.php" method="post">
              <input type="button" data-url=<?= $affiliateUrl ?> data-image=<?= $mediumImageUrl ?> data-price=<?= $price ?> data-detail=<?= $detail ?> value="👍">
            </form>
          </td>

          <?php $i++; ?>
          <?php if ($i % 5 == 0) : ?>
      </tr>
      <tr>
      <?php endif ?>

    <?php endforeach; ?>
    </table>

  </div>

</body>
</ht ml>