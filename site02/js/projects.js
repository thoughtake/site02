jQuery(function() {


  //ホットワード
  var $box =jQuery('#keyword-box')
  var $pick = jQuery('.js-pickup');

  $pick.on('click', function() {
    $word = jQuery(this).data('pickup');
    $val = $box.val();
    $box.val(`${$val} ${$word}`);
  })  

  //クリアボタン
  var $cat = jQuery('.js-search-category');
  var $clear = jQuery('#js-clear');
  $clear.on('click', function() {
    $cat.removeAttr('checked').prop("checked", false).change();
    $box.val('')
  })  

  //キーワードクリアボタン
  jQuery('#clear-button').on('click', function() {
    $box.val(''); // 入力内容をクリア
    $box.focus(); // フォーカスを戻す
});

})