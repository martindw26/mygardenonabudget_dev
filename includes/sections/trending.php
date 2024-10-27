<?php
// Retrieve the trending posts field
$trending_posts = get_field('trending_posts', 'option');

// Check if we have trending posts or fall back to random posts
if ($trending_posts && !empty($trending_posts)) {
    // Query for trending posts
    $args = array(
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => 6,
        'orderby'        => 'date',
        'order'          => 'DESC',
        'post__in'       => $trending_posts
    );
} else {
    // Fallback to random posts if no trending posts are set
    $args = array(
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => 6,
        'orderby'        => 'rand' // Fetch random posts
    );
}

$query = new WP_Query($args);

if ($query->have_posts()) :
    ?>
    <style>
        .ticker-wrapper {
            overflow: hidden;
            position: relative;
            width: 100%; /* Adjust as needed */
            display: flex;
            align-items: center;
            border-bottom: 1px solid lightgrey;
        }

        .ticker-label_dt {
            padding: 10px;
            background-color: #ffffff; /* Label background color */
            color: black; /* Label text color */
            font-weight: bold;
            min-width: 180px; /* Width of the label area */
            z-index: 99999;
        }

        @media only screen and (max-width: 480px) {
            .ticker-label_mobile {
                display: block;
            }
            .ticker-label_dt {
                display: none;
            }
        }

        @media only screen and (min-width: 481px) {
            .ticker-label_mobile {
                display: none;
            }
            .ticker-label_dt {
                display: block;
                width:200px;
            }
        }

        .ticker-content {
            display: flex;
            white-space: nowrap;
            animation: ticker 30s linear infinite; /* Adjust duration to 30s */
            transition: animation-play-state 0.5s ease; /* Smooth transition for pausing */
            flex: 1; /* Allow ticker content to take remaining space */
        }

        .ticker-item {
            display: inline-block;
            padding: 10px;
            margin-right: 15px; /* Space between items */
            min-width: fit-content; /* Adjust as needed */
        }

        .ticker-item a {
            text-decoration: none;
            color: #333; /* Link color */
        }

        @keyframes ticker {
            0% {
                transform: translateX(-100%);
            }
            100% {
                transform: translateX(100%);
            }
        }
    </style>

    <div class="ticker-label_mobile">Currently Trending:</div>
    <div class="ticker-wrapper">
        <div class="ticker-label_dt">Currently Trending:</div>
        <div class="ticker-content">
            <?php
            while ($query->have_posts()) : $query->the_post();
                ?>
                <div class="ticker-item">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </div>
                <?php
            endwhile;
            ?>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM fully loaded and parsed'); // Check if this logs
            var tickerContent = document.querySelector('.ticker-content');
            
            if (!tickerContent) {
                console.error('Element not found');
                return;
            }

            function pauseAnimation() {
                console.log('Animation paused'); // Debugging line
                tickerContent.style.animationPlayState = 'paused';
            }

            function resumeAnimation() {
                console.log('Animation resumed'); // Debugging line
                tickerContent.style.animationPlayState = 'running';
            }

            tickerContent.addEventListener('mouseover', pauseAnimation);
            tickerContent.addEventListener('mouseout', resumeAnimation);

            tickerContent.addEventListener('touchstart', pauseAnimation);
            tickerContent.addEventListener('touchend', resumeAnimation);

            // Optional: Handle touchmove and touchcancel
            tickerContent.addEventListener('touchmove', function(e) {
                e.preventDefault();
                pauseAnimation();
            });

            tickerContent.addEventListener('touchcancel', resumeAnimation);
        });
    </script>

    <?php
    wp_reset_postdata();
else :
    echo '<p>No articles found</p>';
endif;
?>
