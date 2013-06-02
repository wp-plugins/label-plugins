<?php
add_action('admin_menu', 'label_plugin_menu');

function label_plugin_menu() {
add_options_page( "Label Plugins", "Label Plugins", "delete_users", "label-plugins", "label_plugins_options");
}
// dynamic field code by http://www.mustbebuilt.co.uk/2012/07/27/adding-form-fields-dynamically-with-jquery/

function initial_plugin_labels(){

$labels = array(label1 => "good", label2 => "average", label3 => "bad", add_plugin_labels => "");
update_option("plugin_labels",$labels);


}

function label_plugins_options(){

if(isset($_POST['add_plugin_labels'])){
update_option( "plugin_labels", $_POST);
}else if($_GET[reset]==1){
delete_option( "plugin_labels" );
}

else{
//print_r($labels);
}
$labels=get_option("plugin_labels" );
//$label=array_pop($labels);
?>
<div class="wrap">
<?php screen_icon(); ?>
<h2><?php _e('Label Plugins Admin Page'); ?></h2>

<div id="container">

		
		<section id="main">
Please add your desired Plugin Labels here:<br />
<form method="POST" action="">
<?php
$num=1;
$count=count($labels);
foreach ($labels as $key => $value){
if($num<$count){
?>
<p><label for="var<?php echo $num;?>">Label: </label><input type="text" name="label<?php echo $num;?>" id="var<?php echo $num;?>" value="<?php echo $value;?>" /><span class="removeVar button">Remove Label</span></p>
<?php }else{} $num++; } ?>
<p>
<span  class="button button-small" id="addVar">Add Label</span>
</p>
<p>		<input type="hidden" name="add_plugin_labels">
<input type="submit"  class="button button-primary button-large" value="Save changes">
</p>



		
		</form>

	<?php //echo "num1 ".$num1; 

	?>
	</div><!--!/#container -->
	<!-- !Javascript - at the bottom for fast page loading -->
	<!-- Grab Google CDN's jQuery. fall back to local if necessary -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script>!window.jQuery && document.write('<script src="js/jquery-1.7.2.min.js"><\/script>')</script>
	<script>
	//create three initial fields
var startingNo = <?php echo $num; ?>;
var $node = "";
for(varCount=0;varCount<=startingNo;varCount++){
    var displayCount = varCount+1;
    $node += '<p><label for="var'+displayCount+'">Label: </label><input type="text" name="label'+displayCount+'" id="var'+displayCount+'"><span class="removeVar button">Remove Label</span></p>';
}
//add them to the DOM
// $('form').prepend($node);
//remove a textfield   
$('form').on('click', '.removeVar', function(){
   $(this).parent().remove();
  
});
//add a new node
$('#addVar').on('click', function(){
varCount++;
$node = '<p><label for="var'+varCount+'">Label: </label><input type="text" name="label'+varCount+'" id="var'+varCount+'"><span class="removeVar button">Remove Label</span></p>';
$(this).parent().before($node);
});
	</script>







<?php
}
?>