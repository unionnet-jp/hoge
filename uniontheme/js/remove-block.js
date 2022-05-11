wp.domReady(() => {
  // テキスト
  wp.blocks.unregisterBlockType("core/pullquote");
  wp.blocks.unregisterBlockType("core/verse");

  // メディア
  wp.blocks.unregisterBlockType("core/audio");
  wp.blocks.unregisterBlockType("core/cover");

  //デザイン
  wp.blocks.unregisterBlockType("core/buttons");
  wp.blocks.unregisterBlockType("core/columns");
  wp.blocks.unregisterBlockType("core/group");
  wp.blocks.unregisterBlockType("core/group-row");

  //ウィジット
  wp.blocks.unregisterBlockType("core/archives");
  wp.blocks.unregisterBlockType("core/calendar");
  wp.blocks.unregisterBlockType("core/categories");
  wp.blocks.unregisterBlockType("core/latest-comments");
  wp.blocks.unregisterBlockType("core/latest-posts");
  wp.blocks.unregisterBlockType("core/page-list");
  wp.blocks.unregisterBlockType("core/rss");
  wp.blocks.unregisterBlockType("core/search");
  wp.blocks.unregisterBlockType("core/social-links");
  wp.blocks.unregisterBlockType("core/tag-cloud");

  //テーマ
  wp.blocks.unregisterBlockType("core/navigation");
  wp.blocks.unregisterBlockType("core/site-logo");
  wp.blocks.unregisterBlockType("core/site-title");
  wp.blocks.unregisterBlockType("core/site-tagline");
  wp.blocks.unregisterBlockType("core/query");
  wp.blocks.unregisterBlockType("core/post-title");
  wp.blocks.unregisterBlockType("core/post-excerpt");
  wp.blocks.unregisterBlockType("core/post-featured-image");
  wp.blocks.unregisterBlockType("core/post-content");
  wp.blocks.unregisterBlockType("core/post-author");
  wp.blocks.unregisterBlockType("core/post-date");
  wp.blocks.unregisterBlockType("core/post-terms");
  wp.blocks.unregisterBlockType("core/post-navigation-link");
  wp.blocks.unregisterBlockType("core/post-comments");
  wp.blocks.unregisterBlockType("core/loginout");
  wp.blocks.unregisterBlockType("core/term-description");
  wp.blocks.unregisterBlockType("core/query-title");

  //yoast
  wp.blocks.unregisterBlockType("yoast/how-to-block");
  wp.blocks.unregisterBlockType("yoast/faq-block");
  wp.blocks.unregisterBlockType("yoast-seo/breadcrumbs");

  // デザイン
  wp.blocks.unregisterBlockVariation("core/embed", "soundcloud");
  wp.blocks.unregisterBlockVariation("core/embed", "spotify");
  wp.blocks.unregisterBlockVariation("core/embed", "vimeo");
  wp.blocks.unregisterBlockVariation("core/embed", "animoto");
  wp.blocks.unregisterBlockVariation("core/embed", "cloudup");
  wp.blocks.unregisterBlockVariation("core/embed", "crowdsignal");
  wp.blocks.unregisterBlockVariation("core/embed", "dailymotion");
  wp.blocks.unregisterBlockVariation("core/embed", "imgur");
  wp.blocks.unregisterBlockVariation("core/embed", "issuu");
  wp.blocks.unregisterBlockVariation("core/embed", "kickstarter");
  wp.blocks.unregisterBlockVariation("core/embed", "mixcloud");
  wp.blocks.unregisterBlockVariation("core/embed", "reddit");
  wp.blocks.unregisterBlockVariation("core/embed", "reverbnation");
  wp.blocks.unregisterBlockVariation("core/embed", "screencast");
  wp.blocks.unregisterBlockVariation("core/embed", "scribd");
  wp.blocks.unregisterBlockVariation("core/embed", "slideshare");
  wp.blocks.unregisterBlockVariation("core/embed", "smugmug");
  wp.blocks.unregisterBlockVariation("core/embed", "speaker-deck");
  wp.blocks.unregisterBlockVariation("core/embed", "tiktok");
  wp.blocks.unregisterBlockVariation("core/embed", "ted");
  wp.blocks.unregisterBlockVariation("core/embed", "tumblr");
  wp.blocks.unregisterBlockVariation("core/embed", "videopress");
  wp.blocks.unregisterBlockVariation("core/embed", "wordpress-tv");
  wp.blocks.unregisterBlockVariation("core/embed", "amazon-kindle");
  wp.blocks.unregisterBlockVariation("core/embed", "pinterest");
  wp.blocks.unregisterBlockVariation("core/embed", "wolfram-cloud");
  wp.blocks.unregisterBlockVariation("core/embed", "flickr");
  wp.blocks.unregisterBlockVariation("core/embed", "meetup-com");
});
