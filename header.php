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
    ?>
    <style>
    /* ################# Header styles ################# */
/* Main site header styling */


.site_header {
    background-image: url('<?php echo $site_logo;?>');
    background-repeat: no-repeat;
    object-fit: fill;
    height: 200px;
}

@media (max-width: 480px) {
.site_header {
    background-image: url('<?php echo $site_logo;?>');
    background-repeat: no-repeat;
    object-fit: fill;
    height: 200px;
    padding: 15px;
    font-weight: 900;
}
}

@media (min-width: 482px) {
    h1.site_header_text {
        text-align: start;
        padding: 5px;
    }
}

@media (max-width: 482px) {
    h1.site_header_text {
        font-family: inherit;
        color: #2c540b;
        text-align: center !important;
        font-size: 38px;
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


</style>
</head>

<body id="myPage" data-bs-spy="scroll" data-bs-target=".navbar" data-bs-offset="60">

<?php
// Get the URL from the ACF field
$logo_url = get_field('site_logo_url','option');
?>

<!-- Header Section -->
<div class="site_header">
<a class="logo_url" href="<?php echo esc_url($logo_url); ?>">
    <h1 class="site_header_text"><?php echo esc_html(get_bloginfo('name')); ?></h1>
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
<div class="container">
<body>


