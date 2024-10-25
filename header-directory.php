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

    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/directory-style.php">
    <?php wp_head(); ?>
    <!-- Adtech -->


<?php 
    // Directory
    $grid_item_bg = get_field('grid_item_bg', 'option');
    $exhibitor_card_text_color = get_field('exhibitor_card_text_color', 'option');
    $exhibitor_card_border_color = get_field('exhibitor_card_border_color', 'option');
    $exhibitor_block_contact_button_background = get_field('exhibitor_block_contact_button_background', 'option');
    $exhibitor_block_contact_button_text_color = get_field('exhibitor_block_contact_button_text_color', 'option');
    
    //Featured
    $Featured_section_bg = get_field('Featured_section_bg', 'option');
    $Featured_section_border_color = get_field('Featured_section_border_color', 'option');
    
?>


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

a.site_header_text_url {
  text-decoration: none;
  color:inherit;
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


.grid-item {
    background-color: <?php echo $grid_item_bg ? $grid_item_bg : '#fff'; ?>;
    border: 1px solid <?php echo !empty($exhibitor_card_border_color) ? $exhibitor_card_border_color : 'lightgrey'; ?>;
    overflow: hidden;
    text-align: center;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    cursor: pointer;  
}

p.exhibitor_cat {
        font-size: larger;
        color: <?php echo !empty($exhibitor_card_text_color) ? $exhibitor_card_text_color : 'black'; ?>;
        border-top: 1px solid lightgrey;
        padding-top: 10px;
        text-align: center!important;
        font-style: italic;
    }

 .grid-item a {
       text-decoration: none;
       color: color: <?php echo !empty($exhibitor_card_text_color) ? $exhibitor_card_text_color : 'black'; ?>; 
}

#loadMoreBtn {
        background-color: <?php echo !empty($load_more_button_bg_directory) ? $load_more_button_bg_directory : 'green'; ?>; /* load more button container background colour */
        color: <?php echo !empty($load_more_button_text_colour_directory) ? $load_more_button_text_colour_directory : 'white'; ?>; /* load more button text colour */
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        font-size: 16px;
        border-radius: 5px;
        display: flex;
        margin: 0 auto;
        /* margin-top: 14px; */
        margin-top: 30px;
        margin-bottom: 10px;
    }
    

/* Featured */

.featured_directory_section{
    background-color: <?php echo $Featured_section_bg ? $Featured_section_bg : '#fff'; ?>;
    padding-bottom:2px;
    margin-bottom:15px;
    border: 1px solid <?php echo $Featured_section_border_color ? $Featured_section_border_color : '#000'; ?>;
}

.directory_section_divide{
    margin-top:15px;
    margin-bottom:15px;
    border-bottom: 1px solid lightgrey;
}

.grid-container_featured {
        display: grid;
        grid-template-columns: repeat(4, 1fr); 
        gap: 20px;
        margin: 0 auto;
        margin-bottom: 10px; 
        padding:10px;
    }
    
    /* Media query for mobile devices */
    @media (max-width: 768px) {
        .grid-container_featured {
            grid-template-columns: 1fr; 
        }
        
        .grid-container_featured > * {
            width: 100%; 
        }
    }

    .grid-item_featured {
    background-color: <?php echo $grid_item_bg ? $grid_item_bg : '#fff'; ?>;
    border: 1px solid black;
    overflow: hidden;
    text-align: center;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    cursor: pointer;  
}

.grid-item_featured img {
    width: 100%;
    height: 200px;
    object-fit: scale-down;
    object-position: center;
    display: block;
    border-bottom: 1px solid #ddd;
    padding: 10px;
    margin: 0 auto;
}

button.exhibitor_visit_web_button {
  background-color: <?php echo $exhibitor_block_contact_button_background ? $exhibitor_block_contact_button_background: 'green'; ?>;
  color: <?php echo !empty($exhibitor_block_contact_button_text_color) ? $exhibitor_block_contact_button_text_color : 'black'; ?>;
  border: 1px solid black;
  padding:5px;
  margin:5px;
}

@media (max-width: 480px) {
button.exhibitor_visit_web_button {
  margin-bottom:10px;
}
}


h3.exhibitor_name {
    margin: 5px;
}

</style>
</head>

<body id="myPage" data-bs-spy="scroll" data-bs-target=".navbar" data-bs-offset="60">

<?php
// Get the URL from the ACF field
$logo_url = get_field('logo_url');
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
