<?php

// 	Determine what the page template is so it can be passed in GoogleAds

	if (is_single()) {
			$template = "Article";
		} else if (is_page()) {
			$template = "Page";
		} else if (is_archive()) {
			$template = "Archive";
		}
		if (is_front_page()) {
			$template = "Home";
		}




// Set Tags and Categories if a Post

// Set Tags and Categories if it's a Post
if (is_single()) {
    $template = "Article";
    $page = get_the_title(); // Get the title of the current post
    $postID = get_the_ID(); // Get the ID of the current post

    $categories = get_the_category();
    $category_names = array(); // Initialize category names array
    if (!empty($categories)) {
        $category_names = wp_list_pluck($categories, 'name');
    }

    // Initialize an empty array to hold tags
    $tag_array = array();

    // Check if there are any tags for the current post
    if (has_tag()) {
        // Get the tags for the current post
        $post_tags = get_the_tags();
        
        // Loop through each tag
        foreach ($post_tags as $tag) {
            // Append the tag name to the tag array
            $tag_array[] = $tag->name;
        }
    }
} else if (is_page()) {
    $template = "Page";
} else if (is_archive()) {
    $template = "Archive";
} else if (is_front_page()) {
    $template = "Home";
}

// Set page title
if ($template != "Archive") {
    $page = get_the_title();
} else {
    $page = get_cat_name(get_queried_object()->term_id);
    $categoryid = get_queried_object_id();
}

// Pass the search term if set
if (isset($_GET['s'])) {
    $searchterm = $_GET['s'];
}

// Get the full path of the current page template.
$template_path = get_page_template();

// Extract just the template filename without the directory path.
$template_name = basename($template_path);

$slug = basename(get_permalink());
$searchterm = get_search_query();

?>

<script>
    window.ads = window.ads || {};
    ads.config = ads.config || {};
    ads.config.targeting = [
        {
            "post_ID": "<?php echo esc_html($postID); ?>",
            "page_title": "<?php echo $page; ?>",
            "post_category": <?php echo json_encode($category_names); ?>,
            "post_tags": <?php echo json_encode($tag_array); ?>,
            "page_type": "<?php echo esc_html($template); ?>",
            "page_slug": "<?php echo esc_html($slug); ?>",
            "search_term": "<?php echo esc_html($searchterm); ?>"
        }
    ];
</script>

<?php
$header_ad_slot_gam_path = get_field ('header_ad_slot_gam_path','option');
$landing_page_top_gam_path = get_field ('landing_page_top_gam_path','option');
$landing_page_middle_gam_path = get_field ('landing_page_middle_gam_path','option');
$landing_page_bottom_gam_path = get_field ('landing_page_bottom_gam_path','option');
$mpu_top_gam_path = get_field ('mpu_top_gam_path','option');
$mpu_bottom_ad_slot_gam_path = get_field ('mpu_bottom_ad_slot_gam_path','option');
$listing_ad_1_top_gam_path = get_field ('listing_ad_1_top_gam_path','option');
$listing_ad_2_top_gam_path = get_field ('listing_ad_2_top_gam_path','option');
$listing_ad_mpu_1_top_gam_path = get_field ('listing_ad_mpu_1_top_gam_path','option');
$listing_ad_mpu_2_top_gam_path = get_field ('listing_ad_mpu_2_top_gam_path','option');
?>


<!-- Start Header GPT Tag -->

<script async src='https://securepubads.g.doubleclick.net/tag/js/gpt.js'></script>
<script>
  window.googletag = window.googletag || {cmd: []};
  googletag.cmd.push(function() {
    var LeaderBoardmapping = googletag.sizeMapping()
                  .addSize([1180, 0], [728, 90])
                 	.addSize([980, 0], [728, 90])
	.addSize([760, 0], [728, 90])
	.addSize([560, 0], [320, 50])
	.addSize([440, 0], [320, 50])
	.addSize([0, 0], [320, 50])
                  .build();


    var BillboardBoardmapping = googletag.sizeMapping()
                  .addSize([1180, 0], [[970, 250], [728, 90]])
                 	.addSize([980, 0], [728, 90])
	.addSize([760, 0], [728, 90])
	.addSize([560, 0], [320, 50])
	.addSize([440, 0], [320, 50])
	.addSize([0, 0], [320, 50])
                  .build();

    
   googletag.defineSlot('<?php echo $header_ad_slot_gam_path; ?>')
             .setTargeting('PostID', ['<?php echo esc_html($postID); ?>'])
             .setTargeting('page_title', [' <?php echo $page; ?>'])
             .setTargeting('post_category', ['<?php echo json_encode($category_names); ?>'])
             .setTargeting('post_tags', ['<?php echo json_encode($tag_array); ?>'])
             .setTargeting('page_type', ['<?php echo esc_html($template); ?>'])
             .setTargeting('search_term', ['<?php echo esc_html($searchterm); ?>'])
             .setTargeting('page_slug', ['<?php echo esc_html($slug); ?>'])
             .defineSizeMapping(<?php echo $mapping;?>)
             .addService(googletag.pubads());

    googletag.pubads().enableSingleRequest();
    googletag.pubads().setForceSafeFrame(false);
    googletag.enableServices();
  });
</script>

<!-- End Header GPT Tag -->



<!-- Start MPU Top GPT Tag -->

<script async src='https://securepubads.g.doubleclick.net/tag/js/gpt.js'></script>
<script>
  window.googletag = window.googletag || {cmd: []};
  googletag.cmd.push(function() {
    var MPUPagemapping = googletag.sizeMapping()

                     .addSize([1536, 0], [[300, 600], [300, 250]])
	   .addSize([1280, 0], [[300, 600], [300, 250]])
	   .addSize([1366, 0], [[300, 600], [300, 250]])
	   .addSize([1440, 0], [[300, 600], [300, 250]])
	   .addSize([1180, 0], [[300, 600], [300, 250]])
             	   .addSize([980, 0], [[300, 600], [300, 250]])
	   .addSize([760, 0], [[300, 600], [300, 250]])
	   .addSize([560, 0], [300, 250])
	   .addSize([440, 0], [300, 250])
	   .addSize([0, 0], [300, 250])
             	  .build();

   googletag.defineSlot('<?php echo $mpu_top_gam_path; ?>')
             .setTargeting('PostID', ['<?php echo esc_html($postID); ?>'])
             .setTargeting('page_title', [' <?php echo $page; ?>'])
             .setTargeting('post_category', ['<?php echo json_encode($category_names); ?>'])
             .setTargeting('post_tags', ['<?php echo json_encode($tag_array); ?>'])
             .setTargeting('page_type', ['<?php echo esc_html($template); ?>'])
             .setTargeting('search_term', ['<?php echo esc_html($searchterm); ?>'])
             .setTargeting('page_slug', ['<?php echo esc_html($slug); ?>'])
             	.defineSizeMapping(MPUPagemapping)
             	.addService(googletag.pubads());

    googletag.pubads().enableSingleRequest();
    googletag.pubads().setForceSafeFrame(false);
    googletag.enableServices();
  });
</script>

<!-- End Header GPT Tag -->

<!-- Start MPU Bottom GPT Tag -->

<script async src='https://securepubads.g.doubleclick.net/tag/js/gpt.js'></script>
<script>
  window.googletag = window.googletag || {cmd: []};
  googletag.cmd.push(function() {
    var MPUPagemapping = googletag.sizeMapping()

                     .addSize([1536, 0], [[300, 600], [300, 250]])
	   .addSize([1280, 0], [[300, 600], [300, 250]])
	   .addSize([1366, 0], [[300, 600], [300, 250]])
	   .addSize([1440, 0], [[300, 600], [300, 250]])
	   .addSize([1180, 0], [[300, 600], [300, 250]])
             	   .addSize([980, 0], [[300, 600], [300, 250]])
	   .addSize([760, 0], [[300, 600], [300, 250]])
	   .addSize([560, 0], [300, 250])
	   .addSize([440, 0], [300, 250])
	   .addSize([0, 0], [300, 250])
             	  .build();

   googletag.defineSlot('<?php echo $mpu_bottom_ad_slot_gam_path; ?>')
             .setTargeting('PostID', ['<?php echo esc_html($postID); ?>'])
             .setTargeting('page_title', [' <?php echo $page; ?>'])
             .setTargeting('post_category', ['<?php echo json_encode($category_names); ?>'])
             .setTargeting('post_tags', ['<?php echo json_encode($tag_array); ?>'])
             .setTargeting('page_type', ['<?php echo esc_html($template); ?>'])
             .setTargeting('search_term', ['<?php echo esc_html($searchterm); ?>'])
             .setTargeting('page_slug', ['<?php echo esc_html($slug); ?>'])
             	.defineSizeMapping(MPUPagemapping)
             	.addService(googletag.pubads());

    googletag.pubads().enableSingleRequest();
    googletag.pubads().setForceSafeFrame(false);
    googletag.enableServices();
  });
</script>

<!-- End Header GPT Tag -->


<!-- Start Landing Page Top GPT Tag -->

<script async src='https://securepubads.g.doubleclick.net/tag/js/gpt.js'></script>
<script>
  window.googletag = window.googletag || {cmd: []};
  googletag.cmd.push(function() {
    var LandingPagemapping = googletag.sizeMapping()

	.addSize([1536, 0], [728, 90])
	.addSize([1280, 0], [728, 90])
	.addSize([1366, 0], [728, 90])
	.addSize([1440, 0], [728, 90])
	.addSize([1180, 0], [728, 90])
	.addSize([980, 0], [728, 90])
	.addSize([760, 0], [728, 90])
	.addSize([560, 0], [300, 250])
	.addSize([440, 0], [300, 250])
	.addSize([0, 0], [300, 250])
	.build();

   googletag.defineSlot('<?php echo $landing_page_top_gam_path; ?>')
             .setTargeting('PostID', ['<?php echo esc_html($postID); ?>'])
             .setTargeting('page_title', [' <?php echo $page; ?>'])
             .setTargeting('post_category', ['<?php echo json_encode($category_names); ?>'])
             .setTargeting('post_tags', ['<?php echo json_encode($tag_array); ?>'])
             .setTargeting('page_type', ['<?php echo esc_html($template); ?>'])
             .setTargeting('search_term', ['<?php echo esc_html($searchterm); ?>'])
             .setTargeting('page_slug', ['<?php echo esc_html($slug); ?>'])
             	.defineSizeMapping(LandingPagemapping )
             	.addService(googletag.pubads());

    googletag.pubads().enableSingleRequest();
    googletag.pubads().setForceSafeFrame(false);
    googletag.enableServices();
  });
</script>

<!-- End Landing Page Top GPT Tag -->


<!-- Start Landing Page Middle GPT Tag -->

<script async src='https://securepubads.g.doubleclick.net/tag/js/gpt.js'></script>
<script>
  window.googletag = window.googletag || {cmd: []};
  googletag.cmd.push(function() {
    var LandingPagemapping = googletag.sizeMapping()

	.addSize([1536, 0], [728, 90])
	.addSize([1280, 0], [728, 90])
	.addSize([1366, 0], [728, 90])
	.addSize([1440, 0], [728, 90])
	.addSize([1180, 0], [728, 90])
	.addSize([980, 0], [728, 90])
	.addSize([760, 0], [728, 90])
	.addSize([560, 0], [300, 250])
	.addSize([440, 0], [300, 250])
	.addSize([0, 0], [300, 250])
	.build();

   googletag.defineSlot('<?php echo $landing_page_middle_gam_path; ?>')
             .setTargeting('PostID', ['<?php echo esc_html($postID); ?>'])
             .setTargeting('page_title', [' <?php echo $page; ?>'])
             .setTargeting('post_category', ['<?php echo json_encode($category_names); ?>'])
             .setTargeting('post_tags', ['<?php echo json_encode($tag_array); ?>'])
             .setTargeting('page_type', ['<?php echo esc_html($template); ?>'])
             .setTargeting('search_term', ['<?php echo esc_html($searchterm); ?>'])
             .setTargeting('page_slug', ['<?php echo esc_html($slug); ?>'])
             	.defineSizeMapping(LandingPagemapping )
             	.addService(googletag.pubads());

    googletag.pubads().enableSingleRequest();
    googletag.pubads().setForceSafeFrame(false);
    googletag.enableServices();
  });
</script>

<!-- End Landing Page Middle GPT Tag -->

<!-- Start Landing Page Bottom  GPT Tag -->

<script async src='https://securepubads.g.doubleclick.net/tag/js/gpt.js'></script>
<script>
  window.googletag = window.googletag || {cmd: []};
  googletag.cmd.push(function() {
    var LandingPagemapping = googletag.sizeMapping()

	.addSize([1536, 0], [728, 90])
	.addSize([1280, 0], [728, 90])
	.addSize([1366, 0], [728, 90])
	.addSize([1440, 0], [728, 90])
	.addSize([1180, 0], [728, 90])
	.addSize([980, 0], [728, 90])
	.addSize([760, 0], [728, 90])
	.addSize([560, 0], [300, 250])
	.addSize([440, 0], [300, 250])
	.addSize([0, 0], [300, 250])
	.build();

   googletag.defineSlot('<?php echo $landing_page_bottom_gam_path; ?>')
             .setTargeting('PostID', ['<?php echo esc_html($postID); ?>'])
             .setTargeting('page_title', [' <?php echo $page; ?>'])
             .setTargeting('post_category', ['<?php echo json_encode($category_names); ?>'])
             .setTargeting('post_tags', ['<?php echo json_encode($tag_array); ?>'])
             .setTargeting('page_type', ['<?php echo esc_html($template); ?>'])
             .setTargeting('search_term', ['<?php echo esc_html($searchterm); ?>'])
             .setTargeting('page_slug', ['<?php echo esc_html($slug); ?>'])
             	.defineSizeMapping(LandingPagemapping )
             	.addService(googletag.pubads());

    googletag.pubads().enableSingleRequest();
    googletag.pubads().setForceSafeFrame(false);
    googletag.enableServices();
  });
</script>

<script async src='https://securepubads.g.doubleclick.net/tag/js/gpt.js'></script>
<script>
  window.googletag = window.googletag || {cmd: []};
  googletag.cmd.push(function() {
    var LandingPagemapping = googletag.sizeMapping()

	.addSize([1536, 0], [728, 90])
	.addSize([1280, 0], [728, 90])
	.addSize([1366, 0], [728, 90])
	.addSize([1440, 0], [728, 90])
	.addSize([1180, 0], [728, 90])
	.addSize([980, 0], [728, 90])
	.addSize([760, 0], [728, 90])
	.addSize([560, 0], [300, 250])
	.addSize([440, 0], [300, 250])
	.addSize([0, 0], [300, 250])
	.build();

   googletag.defineSlot('<?php echo $listing_ad_1_top_gam_path; ?>')
             .setTargeting('PostID', ['<?php echo esc_html($postID); ?>'])
             .setTargeting('page_title', [' <?php echo $page; ?>'])
             .setTargeting('post_category', ['<?php echo json_encode($category_names); ?>'])
             .setTargeting('post_tags', ['<?php echo json_encode($tag_array); ?>'])
             .setTargeting('page_type', ['<?php echo esc_html($template); ?>'])
             .setTargeting('search_term', ['<?php echo esc_html($searchterm); ?>'])
             .setTargeting('page_slug', ['<?php echo esc_html($slug); ?>'])
             	.defineSizeMapping(LandingPagemapping )
             	.addService(googletag.pubads());

    googletag.pubads().enableSingleRequest();
    googletag.pubads().setForceSafeFrame(false);
    googletag.enableServices();
  });
</script>


<script async src='https://securepubads.g.doubleclick.net/tag/js/gpt.js'></script>
<script>
  window.googletag = window.googletag || {cmd: []};
  googletag.cmd.push(function() {
    var LandingPagemapping = googletag.sizeMapping()

	.addSize([1536, 0], [728, 90])
	.addSize([1280, 0], [728, 90])
	.addSize([1366, 0], [728, 90])
	.addSize([1440, 0], [728, 90])
	.addSize([1180, 0], [728, 90])
	.addSize([980, 0], [728, 90])
	.addSize([760, 0], [728, 90])
	.addSize([560, 0], [300, 250])
	.addSize([440, 0], [300, 250])
	.addSize([0, 0], [300, 250])
	.build();

   googletag.defineSlot('<?php echo $listing_ad_2_top_gam_path; ?>')
             .setTargeting('PostID', ['<?php echo esc_html($postID); ?>'])
             .setTargeting('page_title', [' <?php echo $page; ?>'])
             .setTargeting('post_category', ['<?php echo json_encode($category_names); ?>'])
             .setTargeting('post_tags', ['<?php echo json_encode($tag_array); ?>'])
             .setTargeting('page_type', ['<?php echo esc_html($template); ?>'])
             .setTargeting('search_term', ['<?php echo esc_html($searchterm); ?>'])
             .setTargeting('page_slug', ['<?php echo esc_html($slug); ?>'])
             	.defineSizeMapping(LandingPagemapping )
             	.addService(googletag.pubads());

    googletag.pubads().enableSingleRequest();
    googletag.pubads().setForceSafeFrame(false);
    googletag.enableServices();
  });
</script>

<script async src='https://securepubads.g.doubleclick.net/tag/js/gpt.js'></script>
<script>
  window.googletag = window.googletag || {cmd: []};
  googletag.cmd.push(function() {
    var MPUPagemapping = googletag.sizeMapping()

	.addSize([1536, 0], [300, 250])
	.addSize([1280, 0], [300, 250])
	.addSize([1366, 0], [300, 250])
	.addSize([1440, 0], [300, 250])
	.addSize([1180, 0], [300, 250])
	.addSize([980, 0], [300, 250])
	.addSize([760, 0], [300, 250])
	.addSize([560, 0], [300, 250])
	.addSize([440, 0], [300, 250])
	.addSize([0, 0], [300, 250])
	.build();

   googletag.defineSlot('<?php echo $listing_ad_mpu_1_top_gam_path; ?>')
             .setTargeting('PostID', ['<?php echo esc_html($postID); ?>'])
             .setTargeting('page_title', [' <?php echo $page; ?>'])
             .setTargeting('post_category', ['<?php echo json_encode($category_names); ?>'])
             .setTargeting('post_tags', ['<?php echo json_encode($tag_array); ?>'])
             .setTargeting('page_type', ['<?php echo esc_html($template); ?>'])
             .setTargeting('search_term', ['<?php echo esc_html($searchterm); ?>'])
             .setTargeting('page_slug', ['<?php echo esc_html($slug); ?>'])
             	.defineSizeMapping(MPUPagemapping )
             	.addService(googletag.pubads());

    googletag.pubads().enableSingleRequest();
    googletag.pubads().setForceSafeFrame(false);
    googletag.enableServices();
  });
</script>

<script async src='https://securepubads.g.doubleclick.net/tag/js/gpt.js'></script>
<script>
  window.googletag = window.googletag || {cmd: []};
  googletag.cmd.push(function() {
    var MPUPagemapping = googletag.sizeMapping()

	.addSize([1536, 0], [300, 250])
	.addSize([1280, 0], [300, 250])
	.addSize([1366, 0], [300, 250])
	.addSize([1440, 0], [300, 250])
	.addSize([1180, 0], [300, 250])
	.addSize([980, 0], [300, 250])
	.addSize([760, 0], [300, 250])
	.addSize([560, 0], [300, 250])
	.addSize([440, 0], [300, 250])
	.addSize([0, 0], [300, 250])
	.build();

   googletag.defineSlot('<?php echo $listing_ad_mpu_2_top_gam_path; ?>')
             .setTargeting('PostID', ['<?php echo esc_html($postID); ?>'])
             .setTargeting('page_title', [' <?php echo $page; ?>'])
             .setTargeting('post_category', ['<?php echo json_encode($category_names); ?>'])
             .setTargeting('post_tags', ['<?php echo json_encode($tag_array); ?>'])
             .setTargeting('page_type', ['<?php echo esc_html($template); ?>'])
             .setTargeting('search_term', ['<?php echo esc_html($searchterm); ?>'])
             .setTargeting('page_slug', ['<?php echo esc_html($slug); ?>'])
             	.defineSizeMapping(MPUPagemapping )
             	.addService(googletag.pubads());

    googletag.pubads().enableSingleRequest();
    googletag.pubads().setForceSafeFrame(false);
    googletag.enableServices();
  });
</script>


<!-- End Landing Page Bottom GPT Tag -->

