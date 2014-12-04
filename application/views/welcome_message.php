	<style type="text/css">
	:focus {
	  outline:none !important;
	}

	a {
	  color:indigo;
	  text-decoration:none;
	}

	a:hover {
	  text-decoration:underline;
	}

	.selected {
		background:#3399FF !important;
	}
	
	span {
		color:white;
	}

	#container {
		overflow: auto;
	}
</style>
<script>
	// default values
	var current_octave = 2;
	var sound_volume = 1;
	var keyboard_control = true;

	$(function(){
		
		keyboard_init();
		
		// set the sound volume value according to the slider
		$('.range-slider').on('change', function(){
			var slider_value = $('.range-slider').attr('data-slider');
			// set the sound volume value to a number between 0 and 1
			sound_volume = (slider_value / 100);
		});
		
		for(index = 0; index <= 5; index++)
		{
			$(note).each(function(key, value)
			{
				$('.audio-files').prepend('<audio id="'+index+value.sound+'" src="<?php echo site_url('assets'); ?>/sound/'+index+value.sound+'.mp3" preload=\"auto\"></audio>');
			});
		}

		var octave = 0;
		for(x = 0; x <= 3; x++) {
			var id = $('#piano div[octave|="0"]').attr('octave');
			var appendDiv = jQuery($('#piano div[octave|="'+x+'"]')[0].outerHTML);
			appendDiv.attr('octave', ++octave).insertAfter('#piano div[octave|="'+x+'"]');
		}

		// generate the key list
		get_keys();
		// generate the scale list
		get_scale();

		$("#piano div li div, #piano div li span").on("mousedown", function(){click_play(this)}); // click the notes to play them
	});	

function keyboard_init()
{
	var key_down = {}; // prevent multiple executions of play_sound when the user holds down a key
	$(document).on({
	    "keydown": function(e) 
	    { 
			// if the keyboard setting is enabled then we can play the notes
			if (keyboard_control === true)
			{
				// Decrease Octave
				if (e.keyCode === 90)
				{
					if (current_octave > 0)
					{
						// decrease the octave value by 1
						current_octave--;
						// set the octave list value to the newly changed octave value
						$('#octave_list').val(current_octave).prop('selected', true);
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
						// increase the octave value by 1
						current_octave++;
						// set the octave list value to the newly changed octave value
						$('#octave_list').val(current_octave).prop('selected', true);
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
	    						var note_octave = (current_octave + value.octave_diff);
	    						$("#piano [octave|="+note_octave+"] li div[key|="+value.key+"]").addClass('selected');
	    						$("#piano [octave|="+note_octave+"] li span[key|="+value.key+"]").addClass('selected');
	    						play_multi_sound(note_octave+value.sound);
	    						key_down[value.key_code] = true;
							}
						}
					});
				}
			}
		},
	    "keyup": function(e) 
	    { 
			// if the keyboard setting is enabled then we can play the notes
			if (keyboard_control === true)
			{
				$(note).each(function(k,value) 
				{
					if (e.keyCode === value.key_code) 
					{
						var note_octave = current_octave + value.octave_diff;
						$("#piano [octave|="+note_octave+"] li div[key|="+value.key+"]").removeClass('selected');
						$("#piano [octave|="+note_octave+"] li span[key|="+value.key+"]").removeClass('selected');
						key_down[value.key_code] = null;
					}
				});
			}
	    }
	},this);
}

function click_play(obj_this)
{
	var this_octave = $(obj_this).parents('div').attr('octave');
	var this_key = $(obj_this).attr('key');
	
	$(note).each(function(k, value)
	{
		if (value.key === this_key && value.octave_diff === 0)
		{
			play_multi_sound(this_octave+value.sound);
		}
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
			audiochannels[a]['channel'].volume = sound_volume;
			audiochannels[a]['channel'].play();
			break;
		}
	}
}	

function get_keys()
{
	var key_list = new Array();
	$(scales).each(function(key,value)
	{
		var in_array = $.inArray(value.key,key_list);
		// add the new key to the list
		if (in_array === -1)
		{
			$('#key_list').append('<option value="'+value.key+'">'+value.key+'</option');
			key_list.push(value.key);
		} 
		// else
		// {
		// 	return false;
		// }
	});
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

function set_octave() 
{
	// set the octave select list to the default value
	var octave_list_value = $('#octave_list :selected').index();
	// set the current octave to the newly selected value
	current_octave = octave_list_value;
}

function toggle_keyboard()
{
	keyboard_control = $('#keyboard_checkbox').is(':checked');
}

</script>
<body>
	<nav class="top-bar">
		<ul class="title-area">
			<li class="name"><h1><a href="#">Chord Machine!</a></h1></li>
		</ul>

		<section class="top-bar-section">
			<ul class="right">
				<li><a href="#">Home</a></li>
				<li><a href="#">About</a></li>
				<li><a href="#">Stuff</a></li>
			</ul>
		</section>
	</nav>

	<div class="audio-files"></div>

	<br />

    <div class="row">
      	<div class="large-12 columns">
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
			</div>
	    </div>
    </div>

    <br />

    <div class="row panel">

		<div class="large-2 columns">
			<h5>Key</h5>
			<select id="key_list" onchange="set_key(); return false;">
				<option>None</option>
			</select>
		</div>

		<div class="large-2 columns">
			<h5>Scale</h5>
			<select id="scale_list" onchange="set_scale(); return false;">
				<option>None</option>
				<optgroup id="major" label="Major">
				</optgroup>
				<optgroup id="minor" label="Minor">
				</optgroup>
			</select>
		</div>
		
		<div class="large-2 columns">
			<h5>Keyboard</h5>
			<div class="switch round">
			  <input id="keyboard_checkbox" type="checkbox" checked="checked" onchange="toggle_keyboard();">
			  <label for="keyboard_checkbox"></label>
			</div> 
		</div>
		
		<div class="large-2 columns">
			<h5>Octave</h5>
			<select id="octave_list" style="width:40px;" onchange="set_octave(); return false;">
				<option>0</option>
				<option>1</option>
				<option selected>2</option>
				<option>3</option>
				<option>4</option>
			</select>
		</div>

		<div class="large-2 columns">
			<h5>Scale Colour</h5>
		</div>

		<div class="large-2 columns">
			<h5>Volume</h5>
			<div class="range-slider" data-slider="100">
				<span class="range-slider-handle" aria-valuemin="0" aria-valuemax="100" aria-valuenow="44" style="-webkit-transform: translateX(397.64px); transform: translateX(397.64px);"></span>
			</div>
		</div>

	</div>

<script src="<?php echo site_url('assets'); ?>/js/foundation.min.js"></script>
<script>
  $(document).foundation();
</script>
</body>
</html>