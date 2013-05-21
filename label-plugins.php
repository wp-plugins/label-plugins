<?php
/*
Plugin Name: Label Plugins
Plugin URI: http://wordpress.org/plugins/label-plugins
Description: Did you ever struggle with multiple plugins, now you have chance to label them.
Author: wp-plugin-dev.com
Version: 0.1
Author URI: http://www.wp-plugin-dev.com/
*/


function add_ps($buffer) {
  return (str_replace("<form method=\"get\" action=\"\">","<ul class='subsubsub'> categories: <lI><a href=\"?plugin_status=good\">good</a></li> | <lI><a href=\"?plugin_status=average\">average</a></li> | <lI><a href=\"?plugin_status=bad\">bad</a></li></ul><form method=\"get\" action=\"\">", $buffer));
}

function plugin_permissions_mp($plugins)  
{  
ob_start("add_ps");
//print_r($plugins);

foreach ($plugins as $key => $value){
$pn=str_replace(" ","_",$pluggy[Name]);
$kn=$key;
$pn=$value[Name];
$pn=str_replace(" ","_",$pn);
$cat='plugin-category_'.$pn;
$an=get_option($cat);

if(isset($_GET['plugin_status']) && $an!=$_GET['plugin_status'] && $_GET['plugin_status']!="all"){
unset($plugins[$kn]);
}else
{
}


}

     return $plugins;
     ob_end_flush();
}  
  
add_filter('all_plugins', 'plugin_permissions_mp'); 







function add_plugins_column( $columns ) {
$label=array();
$label[category]="Category";

$columns = $label + $columns;
return $columns;
}

add_filter( 'manage_plugins_columns', 'add_plugins_column' );



function render_plugins_column( $column, $plugin_file, $plugin_data ) {
$url = plugins_url();
switch ($column) {
case "category": 
$pn=str_replace(" ","_",$plugin_data[Name]);
if(isset($_POST['plugin-category_'.$pn])){
update_option('plugin-category_'.$pn,$_POST['plugin-category_'.$pn]);
}
$cat=get_option('plugin-category_'.$pn);
?>

<form action="" method="POST" name="plugin-category">
<select name="plugin-category <?php echo $plugin_data[Name];?>" id="plugin-category" onchange="this.form.submit()">
        <option value="neutral" <?php if($cat=="neutral"){echo "selected=selected";}?> >neutral</option>
        <option value="bad" <?php if($cat=="bad"){echo "selected=selected";}?> >bad</option>
        <option value="average" <?php if($cat=="average"){echo "selected=selected";}?> >average</option>
        <option value="good" <?php if($cat=="good"){echo "selected=selected";}?> >good</option>
        

    </select>
</form>

  
<?php; break;
}
} add_action( 'manage_plugins_custom_column' , 'render_plugins_column', 10, 3 );











?>