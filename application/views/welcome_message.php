<script>
	// default values
	var current_octave = 2;
	var sound_volume = 1;
	var keyboard_control = true;
	var piano_key_count = 0;
	var selected_key = null;
	var piano_octave_count = 5;

	$(function() 
	{
		// generate the piano
		piano_init();
		// load the audio files
		load_audio_samples();
		// load the keyboard
		keyboard_init();
		// generate the audio slider		
		volume_slider_init();
		// generate the key list
		get_keys();
		// generate the scale list
		get_scale();
		// enable mouseclick to play notes
		click_play_init();
	});	

function piano_init()
{
	var octave = 0;
	// this is where we generate the piano
	for (x = 0; x <= piano_octave_count; x++) {
		// a template of 1 octaves worth of keys
		var template = '<div octave="'+x+'"><li><div class="anchor" index="'+(0+octave)+'"></div></li><li><span index="'+(1+octave)+'"></span><div class="anchor" index="'+(2+octave)+'"></div></li><li><span index="'+(3+octave)+'"></span><div class="anchor" index="'+(4+octave)+'"></div></li><li><div class="anchor" index="'+(5+octave)+'"></div></li><li><span index="'+(6+octave)+'"></span><div class="anchor" index="'+(7+octave)+'"></div></li><li><span index="'+(8+octave)+'"></span><div class="anchor" index="'+(9+octave)+'"></div></li><li><span index="'+(10+octave)+'"></span><div class="anchor" index="'+(11+octave)+'"></div></li></div>';
		octave = octave + 12;
		// generate the whole piano and append it to the piano id
		$('#piano').append(template);
		piano_key_count = octave;
	}
}

function click_play_init()
{
	$("#piano div li div, #piano div li span").on("mousedown", function(){click_play(this)}); // click the notes to play them
}

function load_audio_samples()
{
	for(index = 0; index <= piano_key_count; index++)
	{
		$('.audio-files').prepend('<audio id="sample_'+index+'" src="<?php echo site_url('assets'); ?>/sound/'+index+'.mp3" preload=\"none\"></audio>');
	}
}

function volume_slider_init()
{
	// set the sound volume value according to the slider
	$('.range-slider').on('change', function(){
		var slider_value = $('.range-slider').attr('data-slider');
		// set the sound volume value to a number between 0 and 1
		sound_volume = (slider_value / 100);
	});
}

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
						$("#piano li div").removeClass('selected');
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
						$("#piano li div").removeClass('selected');
					}
					else
					{
						return false;
					}
				}
				else if (e.keyCode === 49)
				{
					// if the user presses any of the fifth values
					// $(fifths).each(function(k,value) 
					// {
					// 	if (e.keyCode === value.key_code) 
					// 	{
		
					// 	}
					// });

				//	if (key_down[49] == null) 
				//	{
						var chord_name = 'C-Minor';
						play_chords(chord_name);
						key_down[49] = true;
				//	}
					
				}
				else 
				{    			
					$(notes).each(function(k,value) 
					{
						if (e.keyCode === value.key_code) 
						{
							if (key_down[value.key_code] == null) 
							{
	    						var key_value = ((current_octave * 12) + value.offset);
	    						$("#piano li div[index|="+key_value+"]").addClass('selected');
	    						$("#piano li span[index|="+key_value+"]").addClass('selected');
	    						play_multi_sound(key_value);
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
				$(notes).each(function(k,value) 
				{
					if (e.keyCode === value.key_code) 
					{
						var key_value = ((current_octave * 12) + value.offset);
						$("#piano li div[index|="+key_value+"]").removeClass('selected');
						$("#piano li span[index|="+key_value+"]").removeClass('selected');
						key_down[value.key_code] = null;
					}
				});

				$(fifths).each(function(k,value) 
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

function play_chords(chord_name)
{
	$(chords).each(function(key,value)
	{
		if (value.name === chord_name)
		{
			// only play the triad chord
			var chord = value.chord.slice(0,3);
			$(chord).each(function(k,val) 
			{
				console.log(val);
				// $(val).each(function(i,note)
				// {
				// 	console.log(i,note);
				play_multi_sound(current_octave+val);
				// });
			});
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

function play_multi_sound(id) {
	for (a = 0; a < audiochannels.length; a++) {
		thistime = new Date();
		if (audiochannels[a]['finished'] < thistime.getTime()) {			// is this channel finished?
			audiochannels[a]['finished'] = thistime.getTime() + $('#sample_'+id).duration*600;
			audiochannels[a]['channel'].src = $('#sample_'+id).attr('src');
			//audiochannels[a]['channel'].load();
			audiochannels[a]['channel'].volume = sound_volume;
			audiochannels[a]['channel'].play();
			break;
		}
	}
}	

function click_play(obj_this)
{
	var this_octave = $(obj_this).parents('div').attr('octave');
	var this_index = $(obj_this).attr('index');
	var this_key = (this_octave * 12);
	
	$(notes).each(function(k, value)
	{
		var selected_key = (value.offset + this_key);
		//console.log(value.offset);
		
		//play_multi_sound(this_index);
	});
}


function get_keys()
{
	var key_list = new Array();
	$(notes).each(function(key,value)
	{
		var in_array = $.inArray(value.key,key_list);
		// add the new key to the list
		if (in_array === -1)
		{
			$('#key_list').append('<option value="'+value.offset+'">'+value.key+'</option');
			key_list.push(value.key);
		} 
		else
		{
			return false;
		}
	});
}

function set_key()
{
	selected_key = parseInt($('#key_list').find(":selected").val(), 10);
	set_scale();
}

function get_scale()
{
	$(scales).each(function(key,value)
	{
		if (value.type === 'major') 
		{
			$('#scale_list').append('<option value="'+value.type+'">'+value.name+'</option');

		} 
		if (value.type === 'minor')
		{
			$('#scale_list').append('<option value="'+value.type+'">'+value.name+'</option');			
		}

	});
}

function set_scale()
{
	var selected_scale = $('#scale_list option:selected').val();
	// make sure the user actually selects a key
	if (selected_key != null) 
	{
		// clear all dots before we select a scale
		$('.scale_dot').remove(); 
		// create a fresh array, straight out of the oven
		var dot_scale = new Array();
		// loop over all of our available scales
		$(scales).each(function(key,value)
		{
			// match our selected scale to our available ones
			if (value.type === selected_scale)
			{
				/*
				we want to start the octave_increment at a -12 because the scale offsets start at a positive number greater than  0 (C key; which is our lowest key value)
				since scales after C are always greater than 0, we still want to fill in any notes behind our root note value, therefore we will increment an extra time in
				our FOR loop to compensate for this (thats why x = -1) 
				*/
				var octave_increment = -12;
				for (x = -1; x <= piano_octave_count; x++)
				{
					// loop over all of our offsets, add our selected key offset values and then stuff them into an array
					$(value.scale_offset).each(function(key,value)
					{
						// create a new scale with the appropriate scale and key offsets
						dot_scale.push((value + selected_key) + octave_increment);
					});
					// we need to increment 12 notes each iteration in order to process the whole scale
					octave_increment = octave_increment + 12; 
				}
			}
			// loop over our dot value and place them on the scale!
			$(dot_scale).each(function(key, value)
			{
				// apply the dots!
				$('#piano').find("[index|='"+value+"']").html('<div class="scale_dot"></div>'); // comma allows us to use either the key or the alt-key values if available
			});
		});
	}
	else
	{
		return false;
	}
}

function set_octave() 
{
	// set the octave select list to the default value
	var octave_list_value = $('#octave_list :selected').index();
	// set the current octave to the newly selected value
	current_octave = octave_list_value;
}

function set_color()
{

}

function toggle_keyboard()
{
	keyboard_control = $('#keyboard_checkbox').is(':checked');

	if (keyboard_control == false)
	{
		$('#octave_list').prop('disabled', true);
	}
	else
	{
		$('#octave_list').prop('disabled', false);
	}
}

</script>
<body>
	<nav class="top-bar">
		<ul class="title-area">
			<li class="name"><h1><a href="#">Piano Roll</a></h1></li>
		</ul>

		<section class="top-bar-section">
			<ul class="right">
				<li><a href="#">Home</a></li>
				<li><a href="#">About</a></li>
				<li><a href="https://github.com/brent-g/" target="_blank">My GitHub</a></li>
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
					</ul>
				</div>
			</div>
	    </div>
    </div>

    <br />

    <div class="row">
	    <fieldset>
			
			<legend>Options</legend>

			<div class="large-2 columns">
				<h5>Key</h5>
				<select id="key_list" onchange="set_key(); return false;">
					<option value="">None</option>
				</select>
			</div>

			<div class="large-2 columns">
				<h5>Scale</h5>
				<select id="scale_list" onchange="set_scale(); return false;">
					<option>None</option>
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
				<h5>Scale Color</h5>
				<select id="colour_list"> 
					<option value="green">Green</option>
					<option value="red">Red</option>
					<option value="blue">Blue</option>
					<option value="yellow">Yellow</option>
				</select>
			</div>

			<div class="large-2 columns">
				<h5>Volume</h5>
				<div class="range-slider" data-slider="100">
					<span class="range-slider-handle" aria-valuemin="0" aria-valuemax="100" aria-valuenow="44" style="-webkit-transform: translateX(397.64px); transform: translateX(397.64px);"></span>
				</div>
			</div>
		</fieldset>
	</div>

	<div class="row">
 		<fieldset>
			<legend>Circle of Fifths</legend>
			<div class="large-1 columns">
			<h5>I</h5>
			</div>
			<div class="large-1 columns">
			<h5>II</h5>
			</div>
			<div class="large-1 columns">
			<h5>III</h5>
			</div>
			<div class="large-1 columns">
			<h5>IV</h5>
			</div>
			<div class="large-1 columns">
			<h5>V</h5>
			</div>
			<div class="large-7 columns">
			</div>
		</fieldset>
	</div>

<script src="<?php echo site_url('assets'); ?>/js/foundation.min.js"></script>
<script>
  $(document).foundation();
</script>
</body>
</html>