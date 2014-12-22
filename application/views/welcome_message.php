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
		// show the circle of fifths chords and numerals
		set_fifths();
		// enable chord highlighting and click playing
		chords_init();
		// defaults
		set_key(); set_fifths(); get_chords();
		// center the scroll bar
		$('#container').scrollLeft(284);
		// load some default values
		//$('#scale_list').val(4).attr('disabled');
	});	

function keyboard_init()
{
	var key_down = {}; // prevent multiple executions of play_sound when the user holds down a key
	var progression = [49,50,51,52,53,54,55];

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

						get_chords();
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

						get_chords();
					}
					else
					{
						return false;
					}
				}
				else if ($.inArray(e.keyCode, progression) > -1)
				{
					var scale_type = $('#scale_list option:selected').val();
					var key_type = $('#key_list option:selected').attr('type');
		
					if (scale_type && key_type)
					{
						var item_index = $.inArray(e.keyCode, progression);
						if (key_down[e.keyCode] == null) 
						{
							$('#chord_' + item_index).mousedown();
							key_down[e.keyCode] = true;
						}
					}
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
				// reset all notes
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

				// reset 1 - 7 keys 
				$(progression).each(function(key,value)
				{
					if (e.keyCode === value) 
					{
						$('#chord_' + key).mouseup();
						key_down[value] = null;
					}
				});
			}
	    }
	},this);
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
				<li><a href="#">Changelog</a></li>
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

	<div class="row">
 		<fieldset>
			<legend>Chords</legend>
			<div class="large-12 columns">
			<ul class="large-block-grid-7 text-center">
			    <li><h5 id="numeral_0">I</h5></li>
			    <li><h5 id="numeral_1">II</h5></li>
			    <li><h5 id="numeral_2">III</h5></li>
			    <li><h5 id="numeral_3">IV</h5></li>
			    <li><h5 id="numeral_4">V</h5></li>
			    <li><h5 id="numeral_5">VI</h5></li>
			    <li><h5 id="numeral_6">VII</h5></li>
			</ul>
			<ul class="button-group even-7">
			  <li><a href="#" class="button" id="chord_0" value="0">-</a></li>
			  <li><a href="#" class="button" id="chord_1" value="1">-</a></li>
			  <li><a href="#" class="button" id="chord_2" value="2">-</a></li>
			  <li><a href="#" class="button" id="chord_3" value="3">-</a></li>
			  <li><a href="#" class="button" id="chord_4" value="4">-</a></li>
			  <li><a href="#" class="button" id="chord_5" value="5">-</a></li>
			  <li><a href="#" class="button" id="chord_6" value="6">-</a></li>
			</ul>
		</fieldset>
	</div>

	<div class="row">
	    <fieldset>
			
			<legend>Options</legend>

			<div class="large-2 columns">
				<h5>Key</h5>
				<select id="key_list" onchange="set_key(); set_fifths(); get_chords(); return false;">
				</select>
			</div>

			<div class="large-2 columns">
				<h5>Scale</h5>
				<select id="scale_list" onchange="set_scale(); set_fifths(); get_chords(); return false;">
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
				<select id="octave_list" style="width:50px;" onchange="set_octave(); get_chords(); return false;">
					<option>0</option>
					<option>1</option>
					<option selected>2</option>
					<option>3</option>
					<option>4</option>
				</select>
			</div>

			<div class="large-2 columns">
				<h5>Scale Color</h5>
				<select id="color_list" onchange="set_scale_color();"> 
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

<script src="<?php echo site_url('assets'); ?>/js/foundation.min.js"></script>
<script>
  $(document).foundation();
</script>
</body>
</html>