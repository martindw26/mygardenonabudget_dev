
<?php
header("Content-type: text/css");
?>




<style>
/* Heading CSS */

@media (max-width: 600px) {
    h1.eventpageheading_directory{
        margin-top:30px;
        text-align: center;
    }
    }
    
    
    /* Exhibitor CSS */
    
    .grid-container {
        display: grid;
        grid-template-columns: repeat(4, 1fr); 
        gap: 20px;
        margin: 0 auto;
        margin-bottom: 10px; 
    }
    
    /* Media query for mobile devices */
    @media (max-width: 768px) {
        .grid-container {
            grid-template-columns: 1fr; 
        }
        
        .grid-container > * {
            width: 100%; 
        }
    }
    
    @media (min-width: 768px) { 
        .grid-item:hover {
            cursor: pointer;  
        }
    }
    
    .grid-item img {
        width: 100%;
        height: 200px;
        object-fit: scale-down;
        object-position: center;
        display: block;
        border-bottom: 1px solid #ddd;
        padding: 10px;
        margin: 0 auto;
    }

    @media (max-width: 480px) {
.grid-item img {
    width: 100%;
    height: 150px;
    object-fit: scale-down;
    object-position: center;
    display: block;
    border-bottom: 1px solid #ddd;
    padding: 10px;
    margin: 0 auto;
}
}
    
    .grid-item h3 {
        margin: 15px 0;
        font-size: 18px;
        color: #333;
    }
    

    .grid-item a:hover {
        text-decoration: none;
    }
    
    h3.exhibitor_name {
        font-size: larger;
    }
    
    h3.exhibitor_stand {
        font-size: small;
    }
    
    img.exhibitor_image {
        object-fit: scale-down;
    }
    
    /* Load More */
    
    /* Back to top */
    #backToTopBtn{
        background-color: white;
        color: black;
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
    

/* Freeatured */



    
    </style>