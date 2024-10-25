<head>
<style>
.ad-container-in_content{
    width: 400px;
    height: 400px;
    text-align: center;
    display: block;
    justify-content: center;
    align-items: center;
    background-color: #f2f2f2f2;
    margin: 0 auto;
    }

    @media only screen and (max-width: 480px) {
        .ad-container-in_content{
            width:100%;
            height: 350px;
            background-color: #f2f2f242;
            margin: 0 auto;

            }
        }  




</style>

</head>

<!-- Ad block middle -->
<div class="ad-container-in_content mt-4 mb-2">
    <div class="ad-label">
        <p>Advertisement</p>
    </div>
    <div class="mpu-in_content_block">
        <?php $incontentmpu = get_field ( 'in-content_mpu','option' );
        echo $incontentmpu;?>
    </div>
</div>
<!-- End Ad block middle -->
