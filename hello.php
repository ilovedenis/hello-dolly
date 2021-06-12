<?php
/**
 * @package Hello_Morning
 * @version 1.0
 */
/*
Plugin Name: Hello Morning
Description: This is not just a plugin, it symbolizes the hope and enthusiasm of an entire morning summed up in two words sung most famously by Maroon 5: Sunday morning. When activated you will randomly see a lyric from <cite>Sunday morning</cite> in the upper right of your admin screen on every page.
Author: Denis
Version: 1.6
Author URI: https://dreamstudioweb.com/
*/

function hello_dolly_get_lyric() {
	/** These are the lyrics to Sunday Morning */
	$lyrics = "Yeah
Sunday morning, rain is falling
Steal some covers, share some skin
Clouds are shrouding us in moments unforgettable
You twist to fit the mold that I am in
But things just get so crazy
Living life gets hard to do
And I would gladly hit the road, get up and go if I knew
That someday it would lead me back to you
That someday it would lead me back to you
That may be all I need
In darkness she is all I see
Come and rest your bones with me
Driving slow on Sunday morning
Well I never want to leave
Yeah, fingers trace your every outline, oh yeah, yeah
Yeah, aint a picture with my hands, ohh!
And back and forth we sway like branches in a storm
Change the weather still together when it ends
That may be all I need
In darkness she is all I see
Come and rest your bones with me
Driving slow on Sunday morning
And I never want to leave
Yeah
Oh yeah
But things just get so crazy living life gets hard to do (life gets hard)
Sunday morning rain is falling and I'm calling out to you
Singing someday it'll bring me back to you, yeah (someday oh, someday oh)
Find a way to bring myself back home to you
You may not know
That may be all I need
In darkness she is all I see (you are all I see)
Come and rest your bones with me
Driving slow on Sunday morning, driving slow";

	// Here we split it into lines
	$lyrics = explode( "\n", $lyrics );

	// And then randomly choose a line
	return wptexturize( $lyrics[ mt_rand( 0, count( $lyrics ) - 1 ) ] );
}

// This just echoes the chosen line, we'll position it later
function hello_dolly() {
	$chosen = hello_dolly_get_lyric();
	echo "<p id='dolly'>$chosen</p>";
}

// Now we set that function up to execute when the admin_notices action is called
add_action( 'admin_notices', 'hello_dolly' );

// We need some CSS to position the paragraph
function dolly_css() {
	// This makes sure that the positioning is also good for right-to-left languages
	$x = is_rtl() ? 'left' : 'right';

	echo "
	<style type='text/css'>
	#dolly {
		float: $x;
		padding-$x: 15px;
		padding-top: 5px;		
		margin: 0;
		font-size: 11px;
	}
	</style>
	";
}

add_action( 'admin_head', 'dolly_css' );

?>
