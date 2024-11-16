<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php get_template_part('includes/ad_scripts'); ?>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo get_the_title(); ?></title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@300..900&family=Playwrite+NZ:wght@100..400&family=Quintessential&display=swap" rel="stylesheet">

    <?php wp_head(); ?>
    <!-- Adtech -->

    <?php
    // Affiliates
    $affiliate_scripts = get_field('affiliate_scripts', 'option');
    echo $affiliate_scripts;
    // Logo All device settings
    $site_title_text_background_colour = get_field('site_title_text_background_colour', 'option');
    $site_title_text_colour = get_field('site_title_text_colour', 'option');
    $site_title_text_border_colour = get_field('site_title_text_border_colour', 'option');
    $site_logo = get_field('site_logo', 'option');
    $site_logo_url = get_field('site_logo_url', 'option'); 
    $site_title_text_background_border_radius = get_field('site_title_text_background_border_radius', 'option'); 
    $main_nav_bar_background_colour = get_field('main_nav_bar_background_colour', 'option');
    $navbar_text_color = get_field('navbar_text_color', 'option');
    $site_header_text_align = get_field('site_header_text_align', 'option');

    $site_logo = get_field('site_logo', 'option');
    $site_logo_mobile = get_field('site_logo_mobile', 'option');
    $site_header_text_align = get_field('site_header_text_align', 'option'); 
    $header_font = get_field('header_font_select', 'option'); 
    $header_font_text_color = get_field('header_font_text_color', 'option'); 
    $leftpageskin = get_field('leftpageskin', 'option');
    $rightpageskin = get_field('rightpageskin', 'option');
    ?>

    <style>
    /* ################# Header styles ################# */
/* Main site header styling */

/* Site header styles */

/* Site header styles */
.site_header_desktop {
    display: block; 
    background-repeat: no-repeat;
    background-size: cover;
    height: 200px;
}

/* Default state for mobile header (hidden on desktop) */
.site_header_mobile {
    display: none;
}

/* Mobile-specific styles */
@media (max-width: 480px) {
    .site_header_desktop {
        display: none;
    }
    .site_header_mobile {
        display: block; 
        height: 200px;
        background-size: cover;
        width: 100%;
    }
}


@media (min-width: 482px) {
    h1.site_header_text {
        text-align: <?php echo $site_header_text_align; ?>;
        padding: 5px;
        font-family: <?php echo $header_font; ?> !important;
        color: <?php echo $header_font_text_color; ?> !important;
    }
}

@media (max-width: 482px) {
    h1.site_header_text {
        color: <?php echo $header_font_text_color; ?> !important;
        text-align: <?php echo $site_header_text_align; ?> !important;
        font-size: 38px;
        font-family: <?php echo $header_font; ?> !important;
    }
}
.ticker-content {
    animation: tickerAnimation 10s linear infinite;
    animation-play-state: running; /* Ensure this is correctly set */
}

@keyframes tickerAnimation {
    0% { transform: translateX(0); }
    100% { transform: translateX(-100%); }
}


/* Main content */

@media only screen and (min-width: 482px) {
  .background {
  }
}


@media only screen and (min-width: 482px) {
.container.main-content {
    background: white;
}
}

@media only screen and (min-width: 482px) {
.background-top {
    background-color: white;
}
}

@media only screen and (min-width: 482px) {
.container.text-sm-start.pb-2.pt-2.text-muted.trending {
    background-color: white;
    height: 55px;
}
}

.container.main {
    background-color: white;
}
@media only screen and (min-width: 1920px) {
    .page-skin-left {
        position: fixed;
        left: 88px;
        top: calc(5px + 0px);
    }
}


@media only screen and (min-width: 1920px) {
.page-skin-right {
  position: fixed;
  right: 88px;
  top: calc(5px + 0px);
}
}


</style>
</head>

<body id="myPage" data-bs-spy="scroll" data-bs-target=".navbar" data-bs-offset="60">


<div class="site_header_desktop">
    <a class="logo_url" href="<?php echo esc_url($site_logo_url); ?>">
        <img class="site_header_desktop" src="<?php echo esc_url($site_logo); ?>" alt="Site Logo" /> <!-- Logo for desktop -->
    </a>
</div>

<div class="site_header_mobile">
    <a class="logo_url" href="<?php echo esc_url($site_logo_url); ?>">
        <img class="site_header_mobile" src="<?php echo esc_url($site_logo_mobile); ?>" alt="Mobile Site Logo" /> <!-- Logo for mobile -->
    </a>
</div>






<!-- Responsive Navbar -->
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">

  <div class="container">
    <!-- Brand/Logo -->
      <!-- Social Icons (Visible on mobile) -->
      <div class="social_mobile">
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="https://facebook.com" target="_blank">
        <i class="fab fa-facebook-f"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="https://twitter.com" target="_blank">
        <i class="fab fa-x-twitter"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="https://wa.me/your-number" target="_blank">
        <i class="fab fa-whatsapp"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="mailto:your-email@example.com">
        <i class="fas fa-envelope"></i>
      </a>
    </li>
  </ul>
</div>

 <!-- Toggler for Mobile -->
 <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu" aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Collapsible Navbar Content -->
    <div class="collapse navbar-collapse" id="navbarMenu">
      <ul class="navbar-nav me-auto">
        <!-- WordPress Menu (Bootstrap Supported) -->
        <?php
        wp_nav_menu(array(
          'theme_location' => 'header-menu',
          'container' => false,
          'menu_class' => 'navbar-nav me-auto',
          'fallback_cb' => '__return_false',
          'items_wrap' => '%3$s',
          'depth' => 2, // Adjust depth for dropdown levels
          'walker' => new WP_Bootstrap_Navwalker() // Use Bootstrap nav walker
        ));
        ?>
      </ul>

  <!-- Social Icons (Visible on Desktop) -->
  <div class="dropdown social_dt">
  <button class="btn btn dropdown-toggle rounded-0 border border-1 border-white" type="button">
    Follow Us
  </button>
  <div class="dropdown-menu">
    <a class="dropdown-item" href="https://facebook.com" target="_blank">
      <i class="fab fa-facebook-f"></i> Facebook
    </a>
    <a class="dropdown-item" href="https://twitter.com" target="_blank">
      <i class="fab fa-x-twitter"></i> Twitter
    </a>
    <a class="dropdown-item" href="https://wa.me/your-number" target="_blank">
      <i class="fab fa-whatsapp"></i> WhatsApp
    </a>
    <a class="dropdown-item" href="mailto:your-email@example.com">
      <i class="fas fa-envelope"></i> Email
    </a>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const dropdown = document.querySelector('.dropdown');
    let timeout;

    dropdown.addEventListener('mouseenter', function() {
      clearTimeout(timeout);
      dropdown.querySelector('.dropdown-menu').style.display = 'block';
    });

    dropdown.addEventListener('mouseleave', function() {
      timeout = setTimeout(function() {
        dropdown.querySelector('.dropdown-menu').style.display = 'none';
      }, 300); // Adjust the delay as needed
    });
  });
</script>

  </div>
</nav>
</div>

</body>
<header>
</div>
<script>
jQuery(document).ready(function($) {
    $('.dropdown-toggle').click(function(e) {
        e.preventDefault();
        $(this).parent().toggleClass('open');
        $(this).next('.dropdown-menu').toggleClass('show');
    });
});
</script>
<div class="background">

<div class="page-skin-left">
  <img src="<?php echo $leftpageskin; ?>" alt="Left Page Skin">
</div>

<div class="page-skin-right">
  <img src="<?php echo $rightpageskin; ?>" alt="Right Page Skin">
</div>
<div class="container main">
<body>


<script>
document.addEventListener("DOMContentLoaded", function () {
    const navbar = document.querySelector('.navbar');
    const pageSkinLeft = document.querySelector('.page-skin-left');
    const pageSkinRight = document.querySelector('.page-skin-right');
    const footer = document.querySelector('footer');

    if (navbar && (pageSkinLeft || pageSkinRight) && footer) {
        const navbarHeight = navbar.offsetHeight;
        const additionalMargin = 260;
        const updateMarginTop = (element) => {
            const footerOffsetTop = footer.getBoundingClientRect().top;
            const elementOffsetTop = element.getBoundingClientRect().top;
            const viewportHeight = window.innerHeight;
            const maxVisibleHeight = footerOffsetTop - viewportHeight;

            // Calculate the new margin top while checking if the page-skin overlaps with the footer
            let newMarginTop = navbarHeight + additionalMargin;
            if (elementOffsetTop + newMarginTop > maxVisibleHeight) {
                newMarginTop = maxVisibleHeight - elementOffsetTop;
            }
            
            element.style.marginTop = `${Math.max(0, newMarginTop)}px`;
        };

        // Apply the margin update to both left and right page skins
        if (pageSkinLeft) updateMarginTop(pageSkinLeft);
        if (pageSkinRight) updateMarginTop(pageSkinRight);
    }
});
</script>
