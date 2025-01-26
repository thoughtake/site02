          <div class="content-search">
            <div class="content-search__title">絞り込み</div>
            <form role="search" method="GET" action="<?php echo home_url('/'); ?>">
              <div class="content-search__box keyword">
                <div class="box-title">
                  <div class="wrapper">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <span>キーワード</span>
                  </div><!-- /.wrapper -->
                </div><!-- /.box-title -->
                <div class="input-box">
                  <input type="text" name="s" id="keyword-box" placeholder="キーワードを入力してください" value="<?php the_search_query(); ?>">
                  <button type="button" id="clear-button"><i class="fa-solid fa-circle-xmark"></i></button>
                </div><!-- /.input-box -->
                <? 
                $terms = get_terms(array(
                  'taxonomy' => 't-word',
                  'orderby' => 'slug',
                  'order' => 'ASC',
                  'hide_empty' => false,
                ));
                if (!empty($terms)):
                ?>                  
                <div class="pickup-box">
                  <div class="pickup-box__title">ホットワード：</div>
                  <ul class="pickup-box__words">
                  <?php foreach($terms as $term): ?>
                    <li class="pickup-box__words__word js-pickup" data-pickup="<?php echo $term->name; ?>">
                      <?php echo $term->name; ?>
                    </li><!-- /.pickup-box__words__word -->
                  <?php endforeach; ?>
                  </ul><!-- /.pickup-box__words -->
                </div><!-- /.pickup-box -->
                <?php endif; ?> 
                
              </div><!-- /.content-search__box keyword-->
              <div class="content-search__box category">
                <div class="box-title">
                  <div class="wrapper">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <span>カテゴリー</span>
                  </div><!-- /.wrapper -->
                </div><!-- /.box-title -->
                <ul class="search-words">
                <? 
                $terms = get_terms(array(
                  'taxonomy' => 't-project',
                  'orderby' => 'slug',
                  'order' => 'ASC',
                  'hide_empty' => false,
                ));
                if (!empty($terms)):
                ?>                  
                <?php foreach($terms as $term): ?>
                  <li class="search-words__word">
                    <label>
                      <input 
                        class="js-search-category" 
                        type="checkbox" 
                        name="get_t[]" 
                        value="<?php echo $term->slug; ?>"
                        <?php echo (isset($_GET['get_t']) && in_array($term->slug, $_GET['get_t'])) ? 'checked' : ''; ?>
                      >
                      <?php echo $term->name; ?>
                    </label>
                  </li><!-- /.search-words__word -->
                <?php endforeach; ?>
                <?php endif; ?> 
                </ul><!-- /.search-words -->
              </div><!-- /.content-search__box category-->
              <div class="content-search__box button">
                <div class="wrapper">
                  <button type="button" class="search-button clear" id="js-clear">条件をクリア</button>
                  <input type="hidden" name="post_type" id="post_type" value="p-project">  
                  <input id="submit" type="submit" value="検索" class="search-button search"/>
                </div><!-- /.wrapper -->
              </div><!-- /.content-search__box button -->
            </form>
          </div><!-- /.content-search -->