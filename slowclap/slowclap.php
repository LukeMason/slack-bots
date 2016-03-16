<?php
header('Content-type:application/json;charset=utf-8');
$imgs = array(
    "http://www.reactiongifs.us/wp-content/uploads/2013/11/clapping_joker_batman_dark_knight.gif",
    "https://media.giphy.com/media/12YimfUI3xDZzq/giphy.gif", 
    "http://www.reactiongifs.com/r/hmc.gif", 
    "http://www.reactiongifs.us/wp-content/uploads/2013/03/slow_clap_citizen_kane.gif", 
    "http://rs1108.pbsrc.com/albums/h404/glfootballmlb21/Gifs/james-van-der-beek-clapping-gif-dawson-b7279382-sz624x350-animate1_zpsdf9ee7d7.gif~c200", 
    "http://i.imgur.com/FFXPbb4.gif", 
    "http://i.imgur.com/0mKXcg1.gif");
?>

{
    "parse": "full",
    "response_type": "in_channel",
    "text": "",
    "attachments":[
    {
        "fallback": "Clap, Clap, Clap.",
        "image_url": "<?php echo $imgs[array_rand($imgs)];?>"
    }
    ],
    "unfurl_media":true,
    "unfurl_links":true
}