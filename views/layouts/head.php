 
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name='robots' content='index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1'>

    <title><?php echo isset($pageTitle) ? $pageTitle  : 'lacasadecom '; ?></title>
    <meta name="description" content="<?php echo isset($meta['description']) ? $meta['description'] : 'lacasadecom '; ?>">
    <meta property="og:site_name" content="lacasadecom">
    <meta property="og:title" content="<?php echo isset($meta['title']) ? $meta['title'] : 'lacasadecom '; ?>">
    <meta property="og:description" content="<?php echo isset($meta['description']) ? $meta['description'] : 'lacasadecom '; ?>">
    <meta property="og:image" content="<?php echo isset($meta['image']) ? asset($meta['image']) : asset('assets/images/lacsadecom.webp'); ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo isset($meta['url']) ? $meta['url'] : 'https://lacasadecom.ma/'; ?>">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo isset($meta['title']) ? $meta['title'] : 'lacasadecom '; ?>">
    <meta name="twitter:description" content="<?php echo isset($meta['description']) ? $meta['description'] : 'lacasadecom '; ?>">
    <meta name="twitter:image" content="<?php echo isset($meta['image']) ? asset($meta['image']) : asset('assets/images/lacsadecom.webp'); ?>">

  

    <link rel="stylesheet" href="<?php echo asset('assets/css/bootstrap.min.css'); ?>"> 
    <link rel="stylesheet" href="<?php echo asset('assets/css/style.css'); ?>">
 
</head>
 