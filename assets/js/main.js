// default values
var current_octave = 2;
var sound_volume = 1;
var keyboard_control = true;
var piano_key_count = 0;
var selected_key = null;
var piano_octave_count = 5;
var offset_scale = [];
var offset_chords = [];
var scale_color = 'green';
var sound = [];

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
	for (index = 0; index <= piano_key_count; index++)
	{
		sound[index] = new Howl({
	  		urls: ['assets/sound/'+index+'.mp3', 'assets/sound/'+index+'.ogg', 'assets/sound/'+index+'.wav'],
	  		volume: 1,
	  		buffer: true
		});
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

function set_scale_color()
{
	// get the selected scale color
	scale_color = $('#color_list option:selected').val();
	// apply custom colors to the scale dot 
	$('.scale_dot').css({'background-color':scale_color})
}

function click_play(obj_this)
{
	var this_index = $(obj_this).attr('index');
	play_multi_sound(this_index);
}

function get_keys()
{
	var key_list = [];
	$(notes).each(function(key,value)
	{
		var in_array = $.inArray(value.key,key_list);
		// add the new key to the list
		if (in_array == -1)
		{
			$('#key_list').append('<option value="'+value.offset+'" type="'+value.type+'">'+value.key+'</option');
			key_list.push(value.key);
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
	var disabled = ['melodic','harmonic','lydian','mixo'];
	$(scales).each(function(key,value)
	{
		if ($.inArray(value.type, disabled) > -1)
		{
			$('#scale_list').append('<option value="'+value.type+'" disabled>'+value.name+'</option');		
		}
		else
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
		var dot_scale = [];
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
				// set the scale color!
				set_scale_color();
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

function play_multi_sound(id) 
{
	// play the selected sound
	sound[id].play();
}

function set_fifths()
{
	var key_type = $('#key_list option:selected').attr('type');
	var key_value = $('#key_list option:selected').text();
	var scale_type = $('#scale_list option:selected').val();
	var octave_offset_scale = [];
	var offset_scale_keys = [];
	
	// make sure we have values 
	if (key_type && scale_type)
	{
		$(scales).each(function(key, value)
		{
			if (value.type === scale_type)
			{
				
				// reset the offset scale
				offset_scale = [];

				// create the offset scale!
				$(value.scale_offset).each(function(key,value)
				{
					offset_scale.push(value + selected_key);
					octave_offset_scale.push(value + selected_key + (current_octave * 12));
				});

				// set the roman numeral values!
				$(numerals).each(function(key,value)
				{
					if (value.type === scale_type)
					{
						$(value.numerals).each(function(key,value)
						{
							$('#numeral_'+ key).text(value);
						});
					}
				});
			}
		});

		var key_list = {};
		var note_list = {};
		var key_progression = ['C','D','E','F','G','A','B'];

		//console.log(offset_scale);

		// find the starting point in our array based off the selected key
		var key_index = key_progression.indexOf(key_value.substring(0,1));

		// we loop over our new offset scale
		$(offset_scale).each(function(k,v)
		{
			// then we loop over each note and match up the new offset scale values to the offset values in the notes array
			$(notes).each(function(key, value)
			{
				if (v == value.offset && key_progression[key_index] == value.key.substring(0,1) && note_list[value.key.substring(0,1)] == null 	&& key_list[value.offset] == null)
				{
					// if the key index value ever becomes greater than the length of the progression array then we must reset the value
					if (key_index >= (key_progression.length - 1))
					{
						key_index = -1;
					}

					if (key_index <= key_progression.length)
					{
						offset_scale_keys.push(value.key);
					}
					key_list[value.offset] = true;
					note_list[value.key.substring(0,1)] = true;
					key_index++;
				}
			});
		});

		// display the offset_scale_keys
		$(offset_scale_keys).each(function(key,value)
		{
			$('#chord_' + key).text(value);
		});

		//console.log(offset_scale_keys);

	}
	else
	{
		// clear the chord text
		$("[id^='chord_']").text('-');
		// dont do anything
		return false;
	}
}

function get_chords()
{
	var offset_notes = [];
	var chord_circle = [];
	var chord_list = [];
	var scale_type = $('#scale_list option:selected').val();
	var key_type = $('#key_list option:selected').attr('type');

	if (scale_type && key_type)
	{
		// determine which fifths chord template to use
		$(fifths).each(function(key,value)
		{
			if (value.type == scale_type)
			{
				chord_circle = value.circle;
			}
		});

		// generate the key offsets from the offset scale
		$(offset_scale).each(function(key, value)
		{
			offset_notes.push(value + (current_octave * 12));
		});

	 	// generate an array of chords based on our provided key list and circle of fifths
		$(chord_circle).each(function(key,value)
		{
			$(chords).each(function(k,v)
			{
				if (value == v.type)
				{
					chord_list.push(v.chord);
				}
			});
		});

		// reset the offset_chords array
		offset_chords = [];

		// apply the scale offset to each chord
		for (i = 0; i < chord_list.length; i++)
		{
			var new_chord = [];
			// executes 3 times 
			$(chord_list[i]).each(function(key,value)
			{
				new_chord.push(value + offset_notes[i]);
			});
			// add our newly created chords to the offset_chords array
			offset_chords.push(new_chord);
		}
	}
	else
	{
		return false;
	}
}

function chords_init() 
{
	// highlight the offset chords on the piano
	$("[id^='chord_']").hover(
	  	// mouse enters
	  	function() {
	  		var this_val = $(this).attr('value');
	  		// highlight the chord!
	  		$(offset_chords[this_val]).each(function(key,value)
	  		{
	  			$("[index|='"+value+"']").addClass('chord_selected');
	  		});
		}, 
		// mouse leaves
		function() {
			$("#piano li div").removeClass('chord_selected');
			$("#piano li span").removeClass('chord_selected');
	  	}
	);

	// highlight the offset chords on the piano
	$("[id^='chord_']").on({
		"mousedown" : function(e)
		{
			var this_val = $(this).attr('value');
	  		// highlight the chord!
	  		$(offset_chords[this_val]).each(function(key,value)
	  		{
	  			$("[index|='"+value+"']").addClass('chord_clicked');
	  			play_multi_sound(value);
	  		});
		},
		"mouseup" : function() 
		{
			$("#piano li div").removeClass('chord_clicked');
			$("#piano li span").removeClass('chord_clicked');
		}
	});
}