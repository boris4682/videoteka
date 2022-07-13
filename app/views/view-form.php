<?
$content = $mv -> pages -> defineCurrentPage($mv -> router);
$mv -> display404($content);
$mv -> seo -> mergeParams($content, "name");

$fields = array(array("Name", "char", "name", array("required" => 1)),
				array("Email", "email", "email"),
				array("Theme", "enum", "theme", array("empty_value" => "Not selected", "required" => 1,
													  "values_list" => array("business" => "Organizational question",
																			 "tecnical" => "Technical question",
																			 "commertial" => "Commercial proposal",
																			 "other" => "Other"))),
				array("Message", "text", "message", array("required" => 1)),
				array("Suscribe on our newsletter", "bool", "news"));

$form = new Form($fields);
$form_complete = false;

if(!empty($_POST))
{
	$form -> getDataFromPost() -> validate();
	
	if(!$form -> hasErrors())
		$form_complete = true;
}

include $mv -> views_path."main-header.php";
?>
<div class="content">
	<h1><? echo $content -> name; ?></h1>
	<?
		echo $content -> content;
		
		if($form_complete)
		{
			echo "<div class=\"form-success\"><p>Form is filled successfully.</p></div>\n";
			echo "<h3>Message form email</h3>\n";
			echo $form -> composeMessage();
			
			echo "<h3>Fields for SQL query</h3>\n";
			Debug :: pre($form -> getAllValues());
		}
		else
			echo $form -> displayErrors();
			
		if(!$form_complete):
	?>
	<form action="<? echo $mv -> root_path; ?>form/" method="post">
		<table>
			<? echo $form -> display(); ?>
			<tr>
				<td colspan="2">
					<input type="submit" value="Submit" />
				</td>
			</tr>
		</table>
	</form>
	<? endif; ?>
</div>
<?
include $mv -> views_path."main-footer.php";
?>