<?php
/*
Plugin Name: Wordpress till Bloggy
Version: 0.1
Plugin URI: http://viewport.se/wordpress-till-bloggy/
Description: Skriv inl&auml;gg till Bloggy genom Wordpress-panelen!
More info: <a href="http://viewport.se/wordpress-till-bloggy/">Viewport.se</a>!
Author: Filip Stefansson
Author URI: http://viewport.se
*/

/*  Copyright 2009  Filip Stefansson  (email : filip.stefansson@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/	


			

		
		
		add_action('admin_head','maxlenght_js');
		

	function  wpbloggy() {
	
	$b_user = get_option('bloggy_username');
	$b_pass = get_option('bloggy_password');
	
	if(empty($b_user) OR empty($b_pass)) {
	echo '<p>Var god uppdatera dina anv&auml;ndaruppgifter under <strong>Inst&auml;llningar</strong>.</p>';
	};
	
	echo '		<script class="javascript" src="'.get_option('siteurl').'/wp-content/plugins/wordpress-till-bloggy/js/jquery.js"></script>
		
		<script class="javascript" src="'.get_option('siteurl').'/wp-content/plugins/wordpress-till-bloggy/js/maxlenght.js"></script>
		
		<script class="javascript" src="'.get_option('siteurl').'/wp-content/plugins/wordpress-till-bloggy/js/send.js"></script>';
	
	echo "
	
	<div id=\"bloggy_load\" style=\"display: none; position: relative; float: right\">
	<img src=\"".get_option('siteurl')."/wp-content/plugins/wordpress-till-bloggy/images/ajax-loader.gif\" />
	</div>
	
	<p>Tecken kvar: <span class=\"charsLeft\">140</span></p>
  	<textarea id=\"bloggy\" name=\"bloggy\" class=\"limited\" cols=\"50\" rows=\"3\" onblur=\"if (this.value == '') {this.value = 'Skriv ditt inl&auml;gg h&auml;r..';}\"  onfocus=\"if (this.value == 'Skriv ditt inl&auml;gg h&auml;r..') {this.value = '';}\">Skriv ditt inl&auml;gg h&auml;r..</textarea>
  	<input type=\"hidden\" name=\"maxlength\" value=\"140\" />
	
	<p><input type=\"button\" value=\"Skicka inl&auml;gg\" class=\"button\" id=\"bloggy_send\"/>

	</p>
	<p id=\"bloggy_message\" style=\"display: none\"> - Inl&auml;gget &auml;r skickat!</p>
	
	<script type=\"text/javascript\">
  	$('textarea.limited').maxlength({
    'feedback' : '.charsLeft',
    'useInput' : true
  	});
	</script>";	

			};



		
			// LŠgger till Widgeten
			function wpbloggy_dashboard_setup() {
				wp_add_dashboard_widget( 'wpbloggy', __( 'Skriv Bloggy-inl&auml;gg' ), 'wpbloggy' );
				}


					// Integrerar den nya Widgeten
					add_action('wp_dashboard_setup', 'wpbloggy_dashboard_setup');
		
			?>
			
<?php

//Admin
function bloggy_admin() {

if(isset($_POST['submit_bloggy'])) {
	update_option('bloggy_username', $_POST['username']);
	update_option('bloggy_password', $_POST['password']);
}
			
			
?>			
<div class="wrap">
<h2 id="write-post"><?php _e("Wordpress till Bloggy",'wp_to_bloggy');?></h2>   	
<form name="bloggy" method="post" action="">
<table>
<tr>
<td>
<label for="username">Anv&auml;ndarnamn:</label>
</td>
<td>
<input type="text" name="username" id="username" />
</td>
</tr>
<tr>
<td>
<label for="password">L&ouml;senord:</label>
</td>
<td>
<input type="password" name="password" id="password" />
</td>
</tr>
</table>
<input type="submit" value="OK" name="submit_bloggy" class="button"/>
			</form>
			<?php if(isset($_POST['submit_bloggy'])) {
			echo 'Uppdaterat och klart!';
			};
			?>
		</div>
		
		<?php
			
		}
		

		function bloggy_admin_actions() {
			add_options_page("Bloggy till Wordpress", "Bloggy till Wordpress", 1, "Bloggy_till_Wordpress", "bloggy_admin");
		}

		add_action('admin_menu', 'bloggy_admin_actions');
		
		?>
	

