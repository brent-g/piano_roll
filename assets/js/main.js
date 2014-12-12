// default values
var current_octave = 2;
var sound_volume = 1;
var keyboard_control = true;
var piano_key_count = 0;
var selected_key = null;
var piano_octave_count = 5;

function play_multi_sound(id) {
	for (a = 0; a < audiochannels.length; a++) {
		thistime = new Date();
		if (audiochannels[a]['finished'] < thistime.getTime()) {			// is this channel finished?
			audiochannels[a]['finished'] = thistime.getTime() + $('#sample_'+id).duration*600;
			audiochannels[a]['channel'].src = $('#sample_'+id).attr('src');
			audiochannels[a]['channel'].load();
			audiochannels[a]['channel'].volume = sound_volume;
			audiochannels[a]['channel'].play();
			break;
		}
	}
}

function click_play(obj_this)
{
	var this_index = $(obj_this).attr('index');
	play_multi_sound(this_index);
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