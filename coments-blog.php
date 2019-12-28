<?php
/**
 * Plugin Name: Coments blog list
 * Plugin URI: https://www.v3d.pl
 * Description: Display coments on one page as shortcode
 * Version: 0.1
 * Text Domain: comments-blog-list
 * Author: v3d Software
 * Author URI: https://www.v3d.pl/plugin/
 */
defined( 'ABSPATH') or die( 'You can\t access this file');
class CommentsBlogList
{
    
    function __construct()
    {
        add_action( 'init', array($this, 'custom_post_type' ) );
    }
   
    function register_frontend()
    {
        // add css js to frontend
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ) );
    }
    function register_backend()
    {
        // add css js to backend
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
    }   

    function activate() {
        //echo'Activated plugin ';
        $this->custom_post_type();
        flush_rewrite_rules();
    }
    function deactivate()
    {
        //echo'deactivated plugin ';
    }
    
    function uninstall()
    {
        
    }
    function custom_post_type()
    {
       register_post_type( 'book', ['public' => true, 'label' => 'Books'] );
    }  
    function enqueue()
    {
        wp_enqueue_style( 'mypluginstyle', plugins_url( '/assets/css/coments_list.css', __FILE__ ) );
        wp_enqueue_script( 'mypluginscript', plugins_url( '/assets/js/coments_list.js', __FILE__ ) );
    }

}

if(class_exists('CommentsBlogList')){
    $commentsBlogList = new CommentsBlogList();
    $commentsBlogList->register_frontend();
    $commentsBlogList->register_backend();
}

//activation
register_activation_hook( __FILE__, array( $commentsBlogList, 'activate' ) );

//deactivation
register_deactivation_hook( __FILE__, array( $commentsBlogList, 'deactivate' ) );

// uninstall
register_uninstall_hook( __FILE__, array( $commentsBlogList, 'uninstall' ) );

$args = array(
    
    'status'  => 'approve'//,
    //'post_id' => 0, // use post_id, not post_ID
);
// 'number'  => '1',

function comments_blog_list($args) {
    
    $comments = get_comments( $args );
 /*
    foreach ( $comments as $comment ) :
        echo get_avatar( $comment, '50' );
        echo get_permalink($comment->comment_post_ID) . '<br />' .$comment->post_name . '<br />' . $comment->comment_author . '<br />' . $comment->comment_content;
        echo '<br> ############# ';
    endforeach;
    */
    /*
    $Content = "<style>\r\n";
	$Content .= "h3.demoClass {\r\n";
	$Content .= "color: #26b158;\r\n";
	$Content .= "}\r\n";
	$Content .= "</style>\r\n";
	$Content .= '<h3 class="demoClass">Check it out! ...444</h3>';
*/
$default_avatars = array(
    'https://sylwiatravel.com/wp-content/uploads/2017/11/Rowerem-po-Peru-wycieczki-szyte-na-miare.jpg',
    'https://sylwiatravel.com/wp-content/uploads/2015/08/We-love-Peru.jpg',
    'https://sylwiatravel.com/wp-content/uploads/2017/11/Pisco-sour-Peru.jpg',
    'https://sylwiatravel.com/wp-content/uploads/2017/11/Arequipa-Peru-wycieczki.jpg',
    'https://sylwiatravel.com/wp-content/uploads/2017/01/Papugi-w-Peru.jpg',
    'https://sylwiatravel.com/wp-content/uploads/2017/11/Machu-Picchu-Peru-wyprawy-.jpg',
    'https://sylwiatravel.com/wp-content/uploads/2017/11/Puya-Raimondii-Peru-wycieczki.jpg',
    'https://sylwiatravel.com/wp-content/uploads/2017/11/Wyprawy-lokalne-po-Peru.jpg',
    'https://sylwiatravel.com/wp-content/uploads/2017/06/Cusco-rooms-for-rent.jpg',
    'https://sylwiatravel.com/wp-content/uploads/2017/11/Maras-miasteczko-w-regionie-Cusco-wyprawy.jpg',
    'https://sylwiatravel.com/wp-content/uploads/2017/06/Transport-in-Peru.jpg',
    'https://sylwiatravel.com/wp-content/uploads/2017/06/Herbal-tea-in-Cusco-Emolienteria.jpg',
    'https://sylwiatravel.com/wp-content/uploads/2017/11/Peru-wybrzeze.jpg'
 );

$i=0;
foreach ( $comments as $comment ) :
    //echo $comment->get_post_type($comment->comment_post_ID);
    //printf( __( 'The post type is: %s', 'textdomain' ), get_post_type( get_the_ID() ) );
    //echo 'commmmm:'.$comment->comment_post_ID . '<br>';
    //printf( __( 'The post2 type is: %s', 'textdomain' ), get_post_type( $comment->comment_post_ID ) );
    //echo $fgh=get_post_type(1);
    if(get_post_type( $comment->comment_post_ID ) == 'tour'){
        $my_default_avatar_now = array_rand($default_avatars);
        //$avatar_comments='<img style="width:200px; height:200px;" src="'.$default_avatars[$my_default_avatar_now].'" />';
        //$avatar_comments='<img src="'.$my_default_avatar_now.'" class="avatar" />';
        //get_avatar( $comment, '60' )
        //get_avatar( $comment, '110' )
        //get_avatar( $comment, '80' )
        //$default_avatars[$my_default_avatar_now]
        if(($i==0)||($i==1)){
            if($i==0){
            $zm='
            <table >
            <tr>
                 <td style="border:none;">
                    <div class="comment__item">
                        <figure class="comment__item__figure comment__two_column_item__figure">
                            <img style="width:60px; height:60px;" src="'.$default_avatars[array_rand($default_avatars)].'" />
                        </figure> 
                        <div class="comment__item__content">
                            <div class="comment__item__content-blockquote">
                                <p>'. $comment->comment_content .'</p>
                            </div>
                            <div>
                                <p>wyprawa: <b><a href="'.get_permalink($comment->comment_post_ID).'">' .$comment->post_title . '</a></b></p>
                            </div>  
                        </div>   
                </div>

                </td>';
                }elseif($i==1){
                $zm='   
                <td style="border:none;">
                    <div class="comment__item">
                        <figure class="comment__item__figure comment__two_column_item__figure">
                            <img style="width:60px; height:60px;" src="'.$default_avatars[array_rand($default_avatars)].'" />
                        </figure> 
                        <div class="comment__item__content">
                            <div class="comment__item__content-blockquote">
                                <p>'. $comment->comment_content .'</p>
                            </div>
                            <div>
                            <p>wyprawa: <b><a href="'.get_permalink($comment->comment_post_ID).'">' .$comment->post_title . '</a></b></p>
                            </div>  
                        </div>   
                </div>                            
                </td>
            </tr>
        </table> 
            ';}
            $Content = $Content.$zm;
            $i++;
        }
        elseif ($i==2) {
            $zm='
            <p>   
                <div class="comment__item comment__grey">
                    <figure class="comment__item__figure comment__item__grey__figure ">
                        <img style="width:110px; height:110px;" src="'.$default_avatars[array_rand($default_avatars)].'" />
                    </figure> 
                    <div class="comment__item__content comment__item__grey__content">
                        <div class="comment__item__content-blockquote">
                            <p>'. $comment->comment_content .'</p>
                        </div>
                        <div>
                                <p>wyprawa: <b><a href="'.get_permalink($comment->comment_post_ID).'">' .$comment->post_title . '</a></b></p>
                        </div>  
                    </div>   
                </div>
            </p>  
            ';
            $Content = $Content.$zm;
            $i++;
        }else{
        $zm='
        <p>   
            <div class="comment__item">
                <figure class="comment__item__figure ">
                    <img style="width:80px; height:80px;" src="'.$default_avatars[array_rand($default_avatars)].'" />
                </figure> 
                <div class="comment__item__content">
                    <div class="comment__item__content-blockquote">
                        <p>'. $comment->comment_content .'</p>
                    </div>
                    <div>
                            <p>wyprawa: <b><a href="'.get_permalink($comment->comment_post_ID).'">' .$comment->post_title . '</a></b></p>
                    </div>  
                </div>   
            </div>
        </p>  
        ';
        $Content = $Content.$zm;
    }    
}
endforeach;	 
    return $Content;
}
 
add_shortcode('comments-blog', 'comments_blog_list');
/*
$args = array(
    'status'  => '1',
    'post_id' => 1, // use post_id, not post_ID
);
// 'number'  => '1',
$comments = get_comments( $args );
 
foreach ( $comments as $comment ) :
    echo $comment->comment_author . '<br />' . $comment->comment_content;
    echo '<br> ############# ';
endforeach;
*/
 /*
 function comments_blog_list($atts) {
	$Content = "<style>\r\n";
	$Content .= "h3.demoClass {\r\n";
	$Content .= "color: #26b158;\r\n";
	$Content .= "}\r\n";
	$Content .= "</style>\r\n";
	$Content .= '<h3 class="demoClass">Check it out! ....</h3>';
	 
    return $Content;
}
 
add_shortcode('comments-blog', 'comments_blog_list');
*/