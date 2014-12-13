<script>
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
		set_fifths();
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

function set_color()
{

}

function set_fifths()
{
	var key_selection = parseInt($('#key_list option:selected').val(), 10);
	var key_type = $('#key_list option:selected').attr('type');
	var scale_type = $('#scale_list option:selected').val();
	var offset_scale = new Array();
	var octave_offset_scale = new Array();
	var chord_list = new Array();
	var offset_scale_keys = new Array();
	
	// make sure we have values 
	if (key_type && scale_type)
	{
		$(scales).each(function(key, value)
		{
			if (value.type === scale_type)
			{
				// create the offset scale!
				$(value.scale_offset).each(function(key,value)
				{
					offset_scale.push(value + key_selection);
					octave_offset_scale.push(value + key_selection + (current_octave * 12));
				});

				// set the roman numeral values!
				$(numerals).each(function(key,value)
				{
					if (value.type === scale_type)
					{
						$(value.numerals).each(function(key,value)
						{
							var index = (key + 1);
							$('#numeral_'+ index).text(value);
						});
					}
				});
			}
		});

		var key_list = {};
		// if the key_type is non-sharp / non-flat then we need to add a key type preference
		// this allows us to add sharps to any normal scale 
		var key_type_pref = 'none';
		
		if (key_type == 'none')
		{
			key_type_pref = 'sharp';
		}

		// we loop over our new offset scale
		$(offset_scale).each(function(k,v)
		{
			// then we loop over each note and match up the new offset scale values to the offset values in the notes array
			$(notes).each(function(key, value)
			{
				// match the selected scale type with the key type and match the offset scale value with the note offset
				if ((value.type == key_type) && v == value.offset)
				{
					// make sure this offset value hasn't been added to used key values array
					if (key_list[value.offset] == null)
					{
						// send the key value to a new array for use (this gives us our circle of fifths values)
						offset_scale_keys.push(value.key);
						// add this value to the key list
						key_list[value.offset] = true;
					}
				} 
				// when selecting a non-sharp || non-flat scale we need to make sure to still add any sharps or flats to the offset_scale_keys
				// to do this we implement a key_type_preference so that if the pref type exists, then we can add this key
				else if ((value.type == key_type_pref) && v == value.offset)
				{
					// make sure this offset value hasn't been added to used key values array
					if (key_list[value.offset] == null)
					{
						// send the key value to a new array for use (this gives us our circle of fifths values)
						offset_scale_keys.push(value.key);
						// add this value to the key list
						key_list[value.offset] = true;
					}
				}
			});
		});
		
		// display the offset_scale_keys
		$(offset_scale_keys).each(function(key,value)
		{
			$('#chord_'+(key+1)).text(value);
		});
	}
	else
	{
		$("[id^='chord_']").text('-');
		return false;
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
				<select id="key_list" onchange="set_key(); set_fifths(); return false;">
					<option value="">None</option>
				</select>
			</div>

			<div class="large-2 columns">
				<h5>Scale</h5>
				<select id="scale_list" onchange="set_scale(); set_fifths(); return false;">
					<option value="">None</option>
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
			<div class="large-12 columns">
			<ul class="large-block-grid-7 text-center">
			    <li><h5 id="numeral_1">I</h5></li>
			    <li><h5 id="numeral_2">II</h5></li>
			    <li><h5 id="numeral_3">III</h5></li>
			    <li><h5 id="numeral_4">IV</h5></li>
			    <li><h5 id="numeral_5">V</h5></li>
			    <li><h5 id="numeral_6">VI</h5></li>
			    <li><h5 id="numeral_7">VII</h5></li>
			</ul>
			<ul class="button-group even-7">
			  <li><a href="#" class="button " id="chord_1">-</a></li>
			  <li><a href="#" class="button" id="chord_2">-</a></li>
			  <li><a href="#" class="button" id="chord_3">-</a></li>
			  <li><a href="#" class="button" id="chord_4">-</a></li>
			  <li><a href="#" class="button" id="chord_5">-</a></li>
			  <li><a href="#" class="button" id="chord_6">-</a></li>
			  <li><a href="#" class="button" id="chord_7">-</a></li>
			</ul>
		</fieldset>
	</div>

<script src="<?php echo site_url('assets'); ?>/js/foundation.min.js"></script>
<script>
  $(document).foundation();
</script>
</body>
</html>