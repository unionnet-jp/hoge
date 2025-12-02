<?php get_header(); ?>
<article class="c-default_notfound">
  <section>
    <div class="c-container">
      <h2><strong>404</strong><br />Not Found</h2>
      <h3 class="u-mt10">ご指定のページが見つかりませんでした</h3>
      <div class="body">
        <p>
          申し訳ございませんが、アクセスしようとしたページは見つかりませんでした。<br />URLが間違っているか、ページが削除・変更された可能性があります。<br />大変お手数ですが、URLを再度ご確認いただくか、下記から目的のページをお探しください。
        </p>
        <p class="u-mt10">
          Sorry, the page you tried to access could not be found.<br />The URL may be incorrect or the page may have been deleted or changed.<br />We apologize for the inconvenience,<br />but
          please check the URL again or find the page you are looking for below.
        </p>
        <!-- / .body -->
      </div>
      <div class="button">
        <a href="/" class="c-button-primary w-fit flex items-center -white">
          <span class="text"> トップページ </span>

          <span class="icon">
            <img class="js-svg" src="../img/common/fa/arrow-right-regular.svg" alt="" />
          </span>
        </a>

        <a href="/sitemap" class="c-button-primary w-fit flex items-center -white">
          <span class="text"> サイトマップ </span>

          <span class="icon">
            <img class="js-svg" src="../img/common/fa/arrow-right-regular.svg" alt="" />
          </span>
        </a>
      </div>
    </div>
    <!-- /.c-default_notfound_body -->
  </section>
</article>

<?php get_footer(); ?>