	<style type="text/css">

		/*::selection{ background-color: #E13300; color: white; }*/
		/*::moz-selection{ background-color: #E13300; color: white; }*/
		/*::webkit-selection{ background-color: #E13300; color: white; }*/

	* {
	  margin:0px;
	  padding:0px;
	  list-style:none;
	}

	:focus {
	  outline:none !important;
	}

	body {
	  background:#666;
	  background:-webkit-radial-gradient(bottom left,cover,#999,#666);
	  background:-moz-radial-gradient(bottom left,cover,#999,#666);
	  background:-ms-radial-gradient(bottom left,cover,#999,#666);
	  background:-o-radial-gradient(bottom left,cover,#999,#666);
	  background:radial-gradient(bottom left,cover,#999,#666);
	  height:500px;
	}

	a {
	  color:indigo;
	  text-decoration:none;
	}

	#piano {
		padding-left:20px;
	}

	a:hover {
	  text-decoration:underline;
	}

	/* Piano Wrapper */
	#p-wrapper {
	  background:#000;
	  background:-webkit-linear-gradient(-60deg,#000,#333,#000,#666,#333 70%);
	  background:-moz-linear-gradient(-60deg,#000,#333,#000,#666,#333 70%);
	  background:-ms-linear-gradient(-60deg,#000,#333,#000,#666,#333 70%);
	  background:-o-linear-gradient(-60deg,#000,#333,#000,#666,#333 70%);
	  background:linear-gradient(-60deg,#000,#333,#000,#666,#333 70%);
	  width:1430px;
	  position:relative;
	  left:-20px;
	  -webkit-box-shadow:0 2px 0px #666,0 3px 0px #555,0 4px 0px #444,0 6px 6px #000,inset 0 -1px 1px rgba(255,255,255,0.5),inset 0 -4px 5px #000;
	  -moz-box-shadow:0 2px 0px #666,0 3px 0px #555,0 4px 0px #444,0 6px 6px #000,inset 0 -1px 1px rgba(255,255,255,0.5),inset 0 -4px 5px #000;
	  box-shadow:0 2px 0px #666,0 3px 0px #555,0 4px 0px #444,0 6px 6px #000,inset 0 -1px 1px rgba(255,255,255,0.5),inset 0 -4px 5px #000;
	  border:2px solid #333;
	  -webkit-border-radius:0 0 5px 5px;
	  -moz-border-radius:0 0 5px 5px;
	  border-radius:0 0 5px 5px;
	  -webkit-animation:taufik 2s;
	  -moz-animation:taufik 2s;
	  animation:taufik 2s;
	}

	/* Tuts */
	ul#piano {
	  display:block;
	  width:100%;
	  height:240px;
	  border-top:2px solid #222;
	}

	ul#piano li {
	  list-style:none;
	  float:left;
	  display:inline;
	  background:#aaa;
	  width:40px;
	  position:relative;
	}

	ul#piano li a,ul#piano li div.anchor {
	  display:block;
	  height:220px;
	  background:#fff;
	  background:-webkit-linear-gradient(-30deg,#f5f5f5,#fff);
	  background:-moz-linear-gradient(-30deg,#f5f5f5,#fff);
	  background:-ms-linear-gradient(-30deg,#f5f5f5,#fff);
	  background:-o-linear-gradient(-30deg,#f5f5f5,#fff);
	  background:linear-gradient(-30deg,#f5f5f5,#fff);
	  border:1px solid #ccc;
	  -webkit-box-shadow:inset 0 1px 0px #fff,inset 0 -1px 0px #fff,inset 1px 0px 0px #fff,inset -1px 0px 0px #fff,0 4px 3px rgba(0,0,0,0.7);
	  -moz-box-shadow:inset 0 1px 0px #fff,inset 0 -1px 0px #fff,inset 1px 0px 0px #fff,inset -1px 0px 0px #fff,0 4px 3px rgba(0,0,0,0.7);
	  box-shadow:inset 0 1px 0px #fff,inset 0 -1px 0px #fff,inset 1px 0px 0px #fff,inset -1px 0px 0px #fff,0 4px 3px rgba(0,0,0,0.7);
	  -webkit-border-radius:0 0 3px 3px;
	  -moz-border-radius:0 0 3px 3px;
	  border-radius:0 0 3px 3px;
	}

	ul#piano li a:active,ul#piano li div.anchor:active {
	  -webkit-box-shadow:0 2px 2px rgba(0,0,0,0.4);
	  -moz-box-shadow:0 2px 2px rgba(0,0,0,0.4);
	  box-shadow:0 2px 2px rgba(0,0,0,0.4);
	  position:relative;
	  top:2px;
	  height:216px;
	}

	ul#piano li a:active:before,ul#piano li div.anchor:active:before {
	  content:"";
	  width:0px;
	  height:0px;
	  border-width:216px 5px 0px;
	  border-style:solid;
	  border-color:transparent transparent transparent rgba(0,0,0,0.1);
	  position:absolute;
	  left:0px;
	  top:0px;
	}

	ul#piano li a:active:after,ul#piano li div.anchor:active:after {
	  content:"";
	  width:0px;
	  height:0px;
	  border-width:216px 5px 0px;
	  border-style:solid;
	  border-color:transparent rgba(0,0,0,0.1) transparent transparent;
	  position:absolute;
	  right:0px;
	  top:0px;
	}

	/* Black Tuts */
	ul#piano li span {
	  position:absolute;
	  top:0px;
	  left:-12px;
	  width:20px;
	  height:120px;
	  background:#333;
	  background:-webkit-linear-gradient(-20deg,#333,#000,#333);
	  background:-moz-linear-gradient(-20deg,#333,#000,#333);
	  background:-ms-linear-gradient(-20deg,#333,#000,#333);
	  background:-o-linear-gradient(-20deg,#333,#000,#333);
	  background:linear-gradient(-20deg,#333,#000,#333);
	  z-index:10;
	  border-width:1px 2px 7px;
	  border-style:solid;
	  border-color:#666 #222 #111 #555;
	  -webkit-box-shadow:inset 0px -1px 2px rgba(255,255,255,0.4),0 2px 3px rgba(0,0,0,0.4);
	  -moz-box-shadow:inset 0px -1px 2px rgba(255,255,255,0.4),0 2px 3px rgba(0,0,0,0.4);
	  box-shadow:inset 0px -1px 2px rgba(255,255,255,0.4),0 2px 3px rgba(0,0,0,0.4);
	  -webkit-border-radius:0 0 2px 2px;
	  -moz-border-radius:0 0 2px 2px;
	  border-radius:0 0 2px 2px;
	}

	ul#piano li span:active {
	  border-bottom-width:2px;
	  height:123px;
	  -webkit-box-shadow:inset 0px -1px 1px rgba(255,255,255,0.4),0 1px 0px rgba(0,0,0,0.8),0 2px 2px rgba(0,0,0,0.4),0 -1px 0px #000;
	  -moz-box-shadow:inset 0px -1px 1px rgba(255,255,255,0.4),0 1px 0px rgba(0,0,0,0.8),0 2px 2px rgba(0,0,0,0.4),0 -1px 0px #000;
	  box-shadow:inset 0px -1px 1px rgba(255,255,255,0.4),0 1px 0px rgba(0,0,0,0.8),0 2px 2px rgba(0,0,0,0.4),0 -1px 0px #000;
	  -webkit-user-select: none;  /* Chrome all / Safari all */
	  -moz-user-select: none;     /* Firefox all */
	  -ms-user-select: none;      /* IE 10+ */
	}

	
	
	ul#piano li li {
	  width:150px;
	  height:auto;
	  display:block;
	  float:none;
	  background:transparent;
	}

	ul#piano li li a,ul#piano li li a:active {
	  height:auto;
	  display:block;
	  padding:10px 15px;
	  background:#333;
	  font:normal 12px Arial,Sans-Serif;
	  color:#fff;
	  text-decoration:none;
	  -webkit-box-shadow:none;
	  -moz-box-shadow:none;
	  box-shadow:none;
	  border-radius:0px;
	  -webkit-border-radius:0px;
	  -moz-border-radius:0px;
	  border-width:1px 0;
	  border-style:solid;
	  border-color:#444 transparent #222 transparent;
	  top:0px;
	  margin-top:0px;
	}

	.scale_dot {
		position: absolute;
		background-color:green;
		height:10px;
		width:10px;
		border-radius: 10px;
		z-index: 100;
		bottom:10%;
		left:38%;
		display: block;
	}
	span .scale_dot {
		left:25%;
	}

	.clear {
	  clear:both;
	}

	/* Animation */
	@-webkit-keyframes taufik {
	  from {opacity:0;}
	  to {opacity:1;}
	}
	@-moz-keyframes taufik {
	  from {opacity:0;}
	  to {opacity:1;}
	}
	@keyframes taufik {
	  from {opacity:0;}
	  to {opacity:1;}
	}
	li {
		/*color:red;*/
	}
	.selected {
		background:#3399FF !important;
	}
	span {
		color:white;
	}
	#controls {
		padding-top: 100px;
	}
</style>
<script>
	var current_octave = 2;

	$(function(){
		var key_down = {};
		$(document).on({
		    "keydown": function(e) 
		    { 
    			// Decrease Octave
				if (e.keyCode === 90)
				{
					if (current_octave > 0)
					{
						current_octave--;
						//$('#piano [octave|="'+current_octave+'"] li').css({"border-style": "solid 2px;","border-left-color":"blue"})
					} 
					else 
					{
						return false;
					}
				} 
				
				// Increase Octave
				else if (e.keyCode === 88)
				{
					if (current_octave < 4)
					{
						current_octave++;
					}
					else
					{
						return false;
					}
				}
				else 
				{    			
    				$(note).each(function(k,value) 
    				{
    					if(e.keyCode === value.key_code) 
    					{
    						if (key_down[value.key_code] == null) 
    						{
	    						var note_octave = current_octave + value.octave_diff;
	    						$("#piano [octave|="+note_octave+"] li div[key|="+value.key+"]").addClass('selected');
	    						$("#piano [octave|="+note_octave+"] li span[key|="+value.key+"]").addClass('selected');
	    						play_multi_sound(note_octave+value.sound);
	    						key_down[value.key_code] = true;
    						}
    					}
    				});
				}
			},
		    "keyup": function(e) 
		    { 
				$(note).each(function(k,value) 
				{
					if(e.keyCode === value.key_code) 
					{
						var note_octave = current_octave + value.octave_diff;
						$("#piano [octave|="+note_octave+"] li div[key|="+value.key+"]").removeClass('selected');
						$("#piano [octave|="+note_octave+"] li span[key|="+value.key+"]").removeClass('selected');
						key_down[value.key_code] = null;
					}
				});
		    }
		},this);

		$("#piano .anchor").each(function(k,v) 
		{
			console.log(this);
		});

		for(index = 0; index <= 5; index++)
		{
			$(note).each(function(key, value)
			{
				$('body').prepend('<audio id="'+index+value.sound+'" src="<?php echo site_url('assets'); ?>/sound/'+index+value.sound+'.mp3" preload=\"auto\"></audio>');
			});
		}

		var octave = 0;
		for(x = 0; x <= 3; x++) {
			var id = $('#piano div[octave|="0"]').attr('octave');
			var appendDiv = jQuery($('#piano div[octave|="'+x+'"]')[0].outerHTML);
			appendDiv.attr('octave', ++octave).insertAfter('#piano div[octave|="'+x+'"]');
		}
		get_scale();

		$("#piano div li div, #piano div li span").on("mousedown", function(){click_play(this)}); // click the notes to play them
	});	

function click_play(obj_this)
{
	var this_octave = $(obj_this).parents('div').attr('octave');
	var this_key = $(obj_this).attr('key');
	//console.log(this_octave, this_key);

	
	$(note).each(function(k, value)
	{
		if (value.key === this_key && value.octave_diff === 0)
		{
			//console.log(this_octave,value.sound)
			play_multi_sound(this_octave+value.sound);
		}
		//console.log(value);
		//console.log(note_octave,value.sound);
		//play_multi_sound(note_octave+value.sound);
	});
}

var channel_max = 100;
audiochannels = new Array();
for (a=0;a<channel_max;a++) {									// prepare the channels
	audiochannels[a] = new Array();
	audiochannels[a]['channel'] = new Audio();						// create a new audio object
	audiochannels[a]['finished'] = -1;							// expected end time for this channel
}

function play_multi_sound(s) {
	for (a=0;a<audiochannels.length;a++) {
		thistime = new Date();
		if (audiochannels[a]['finished'] < thistime.getTime()) {			// is this channel finished?
			audiochannels[a]['finished'] = thistime.getTime() + document.getElementById(s).duration*600;
			audiochannels[a]['channel'].src = document.getElementById(s).src;
			audiochannels[a]['channel'].load();
			audiochannels[a]['channel'].play();
			break;
		}
	}
}	

function get_scale()
{
	$(scales).each(function(key,value)
	{
		if (value.type === 'major') 
		{
			$('#scale_list optgroup#major').append('<option value="'+value.name+'">'+value.name+'</option');

		} 
		if (value.type === 'minor')
		{
			$('#scale_list optgroup#minor').append('<option value="'+value.name+'">'+value.name+'</option');			
		}

	});
}

function set_scale()
{
	var selected_scale = $('#scale_list').find(":selected").text();
	
	$('.scale_dot').remove(); // clear the dots before we select a scale
	
	$(scales).each(function(key,value)
	{
		$(value).each(function(key, value)
		{
			if (value.name === selected_scale)
		{
			$(value.keys).each(function(k,v) 
			{
				//$('<div class="scale_dot"></div>').appendTo($('#piano').find("[key|='"+v+"'']"));
				$('#piano').find("[key|='"+v+"'],[alt-key|='"+v+"']").html('<div class="scale_dot"></div>'); // comma allows us to use either the key or the alt-key values if available
			});
		} 
		else 
		{
			return false; // no scale found... for some reason
		}
			
		})

		
	});
}

</script>
<body>

<div id="container">
	<div id="p-wrapper">
		<ul id="piano">
			<div octave="0">
				<li><div class="anchor" key="C" alt-key="B#"></div></li>
				<li><div class="anchor" key="D"></div><span key="C#" alt-key="Db"></span></li>
				<li><div class="anchor" key="E" alt-key="Fb"></div><span key="D#" alt-key="Eb"></span></li>
				<li><div class="anchor" key="F" alt-key="E#"></div></li>
				<li><div class="anchor" key="G"></div><span key="F#" alt-key="Gb"></span></li>
				<li><div class="anchor" key="A"></div><span key="G#" alt-key="Ab"></span></li>
				<li><div class="anchor" key="B" alt-key="Cb"></div><span key="A#" alt-key="Bb"></span></li>
			</div>
		</ul>
	</div>
	<div id="controls">
		<select id="scale_list" onchange="set_scale(); return false;">
			<option></option>
			<optgroup id="major" label="Major">
			</optgroup>
			<optgroup id="minor" label="Minor">
			</optgroup>
		</select>
	</div>
</div>

</body>
</html>