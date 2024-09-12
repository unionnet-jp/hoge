<head>
  <meta charset="UTF-8">
  <meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
  <meta name="format-detection" content="telephone=no" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover" />
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url(home_url('img/apple-touch-icon.png')); ?>" />
  <link rel="shortcut icon" type="image/vnd.microsoft.icon"
    href="<?php echo esc_url(home_url('img/favicon.ico')); ?>" />
  <link rel="manifest" href="<?php echo esc_url(home_url('site.webmanifest')); ?>" />
  <meta name="theme-color" content="#ffffff" />
  <link rel="icon" type="image/vnd.microsoft.icon" href="<?php echo esc_url(home_url('img/favicon.ico')); ?>" />
  <link rel="shortcut icon" type="image/x-icon" href="<?php echo esc_url(home_url('img/favicon.ico')); ?>" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/js-cookie/2.2.1/js.cookie.min.js"></script>
  <?php wp_head(); ?>
  <!--== Google For Jobs用の構造化データ ==-->
  <?php if (is_singular('requirements')) : ?>
  <?php while (have_posts()) : the_post(); ?>
  <?php
      $address_region = get_post_meta($post->ID, 'address_region', true);//県
      $address_locality = get_post_meta($post->ID, 'address_locality', true);//市
      $street_address = get_post_meta($post->ID, 'street_address', true);//それ以降の住所
      $postal_code = get_post_meta($post->ID, 'postal_code', true);//郵便番号
      $employment_type = get_post_meta($post->ID, 'employment_type', true);//勤務形態
      $salary = get_post_meta($post->ID, 'salary', true);//給与
      $salary_min = get_post_meta($post->ID, 'salary_min', true);//給与(最小)必要であれば
      $salary_max = get_post_meta($post->ID, 'salary_max', true);//給与(最大)必要であれば
      $unittext = get_post_meta($post->ID, 'unittext', true);//勤務形態
    ?>
  <script type="application/ld+json">
  {
    "@context": "http://schema.org/",
    "@type": "JobPosting",
    "title": "<?php the_title(); ?>",
    "description": "<?php echo strip_tags(apply_filters('the_content', $post->post_content), '<br><p><strong><em><ul><li><h1><h2><h3><h4><h5>'); ?>",
    "datePosted": "<?php the_time('Y-m-d'); ?>",
    "validThrough": "",
    "employmentType": "<?php echo $employment_type; ?>",
    "identifier": {
      "@type": "PropertyValue",
      "name": "<?php bloginfo('name'); ?>",
      "value": "<?php echo $post->ID; ?>"
    },
    "hiringOrganization": {
      "@type": "Organization",
      "name": "<?php bloginfo('name'); ?>",
      "sameAs": "<?php echo HOME; ?>",
      "logo": "<?php echo HOME; ?>img/common/webclip.png"
    },
    "jobLocation": {
      "@type": "Place",
      "address": {
        "@type": "PostalAddress",
        "addressRegion": "<?php echo $address_region; ?>",
        "addressLocality": "<?php echo $address_locality; ?>",
        "streetAddress": "<?php echo $street_address; ?>",
        "postalCode": "<?php echo $postal_code; ?>",
        "addressCountry": "JP"
      }
    },
    "baseSalary": {
      "@type": "MonetaryAmount",
      "currency": "JPY",
      "value": {
        "@type": "QuantitativeValue",
        "value": "<?php echo $salary; ?>",
        "minValue": "<?php echo $salary_min; ?>", //必要であれば
        "maxValue": "<?php echo $salary_max; ?>", //必要であれば
        "unitText": "<?php echo $unittext; ?>"
      }
    }
  }
  </script>
  <?php endwhile;?>
  <?php endif; ?>

</head>