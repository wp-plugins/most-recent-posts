<?php 
// Most Recent Posts Functions Include

function checkMRPAPIKey()
{
		$apikey		= get_option('most_recent_posts_apikey');
		if (!$apikey)
		{
			echo '<div id="message" class="error">Please <a href="admin.php?page=MRPRegistration">register</a> your Most Recent Posts Plugin.  Takes only a minute to do!  Thank You!</div>';
		}			
}
function checkMRPAPIKeyForSupport()
{
		$apikey		= get_option('most_recent_posts_apikey');
		if ($apikey)
		{
			return true;
		}			
}
function checkMRPAPIKeyShort()
{
		$apikey		= get_option('most_recent_posts_apikey');
		if (!$apikey)
		{
			echo '<div id="message" class="error" style="color:red;">Please register your Most Recent Posts Plugin.  Thank You!</div>';
		}			
}


function getPublicMRPPluginUrl() {
	return WP_PLUGIN_URL .'/'. dirname(plugin_basename(__FILE__));
}
function getPublicMRPPluginDir() {
	return WP_PLUGIN_DIR .'/'. dirname(plugin_basename(__FILE__));
}


?>