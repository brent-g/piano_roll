/*var note = [
	{'letter':'a', 'key_code':65, 'key':'C', 	'sound' : '_C', 		'octave_diff': 0},
	{'letter':'w', 'key_code':87, 'key':'C#', 	'sound' : '_C-sharp', 	'octave_diff': 0},
	{'letter':'s', 'key_code':83, 'key':'D', 	'sound' : '_D', 		'octave_diff': 0},
	{'letter':'e', 'key_code':69, 'key':'D#', 	'sound' : '_D-sharp', 	'octave_diff': 0},
	{'letter':'d', 'key_code':68, 'key':'E', 	'sound' : '_E', 		'octave_diff': 0},
	{'letter':'f', 'key_code':70, 'key':'F', 	'sound' : '_F', 		'octave_diff': 0},
	{'letter':'t', 'key_code':84, 'key':'F#', 	'sound' : '_F-sharp', 	'octave_diff': 0},
	{'letter':'g', 'key_code':71, 'key':'G', 	'sound' : '_G', 		'octave_diff': 0},
	{'letter':'y', 'key_code':89, 'key':'G#', 	'sound' : '_G-sharp', 	'octave_diff': 0},
	{'letter':'h', 'key_code':72, 'key':'A', 	'sound' : '_A', 		'octave_diff': 0},
	{'letter':'u', 'key_code':85, 'key':'A#', 	'sound' : '_A-sharp', 	'octave_diff': 0},
	{'letter':'j', 'key_code':74, 'key':'B', 	'sound' : '_B', 		'octave_diff': 0},
	
	{'letter':'k', 'key_code':75, 'key':'C', 	'sound' : '_C',			'octave_diff': 1},
	{'letter':'o', 'key_code':79, 'key':'C#', 	'sound' : '_C-sharp',	'octave_diff': 1},
	{'letter':'l', 'key_code':76, 'key':'D', 	'sound' : '_D', 		'octave_diff': 1},
	{'letter':'p', 'key_code':80, 'key':'D#', 	'sound' : '_D-sharp',	'octave_diff': 1},
	{'letter':';', 'key_code':186, 'key':'E', 	'sound' : '_E',			'octave_diff': 1},
	{'letter':'\'', 'key_code':222, 'key':'F', 	'sound' : '_F',			'octave_diff': 1}
];*/

var scales = [
	{'name':'C Major', 	'type' : 'major', 'key' : 'C', 			'sound' : '_C',  'keys' : ['C','D','E','F','G','A','B','C']}, 
	{'name':'C# Major', 'type' : 'major', 'key' : 'C#',		 	'sound' : '_C#', 'keys' : ['C#','D#','E#','F#','G#','A#','B#','C#']},
	{'name':'D Major', 	'type' : 'major', 'key' : 'D', 			'sound' : '_D',  'keys' : ['D','E','F#','G','A','B','C#','D']}, 
	{'name':'Db Major', 'type' : 'major', 'key'	: 'Db',		 	'sound' : '_Db', 'keys' : ['Db','Eb','F','Gb','Ab','Bb','C','Db']},
	{'name':'E Major', 	'type' : 'major', 'key' : 'E', 			'sound' : '_E',  'keys' : ['E','F#','G#','A','B','C#','D#','E']}, 
	{'name':'Eb Major', 'type' : 'major', 'key'	: 'Eb',		 	'sound' : '_Eb', 'keys' : ['Eb','F','G','Ab','Bb','C','D','Eb']},
	{'name':'F Major', 	'type' : 'major', 'key' : 'F', 			'sound' : '_F',  'keys' : ['F','G','A','Bb','C','D','E','F']}, 
	{'name':'F# Major', 'type' : 'major', 'key'	: 'F#',		 	'sound' : '_F#', 'keys' : ['F#','G#','A#','B','C#','D#','E#','F#']},
	{'name':'G Major', 	'type' : 'major', 'key' : 'G', 			'sound' : '_G',  'keys' : ['G','A','B','C','D','E','F#','G']}, 
	{'name':'Gb Major',	'type' : 'major', 'key'	: 'Gb',		 	'sound' : '_Gb', 'keys' : ['Gb','Ab','Bb','Cb','Db','Eb','F','Gb']},
	{'name':'A Major', 	'type' : 'major', 'key' : 'A', 			'sound' : '_A',  'keys' : ['A','B','C#','D','E','F#','G#','A']},
	{'name':'Ab Major', 'type' : 'major', 'key'	: 'Ab',		 	'sound' : '_Ab', 'keys' : ['Ab','Bb','C','Db','Eb','F','G','Ab']},
	{'name':'B Major', 	'type' : 'major', 'key' : 'B', 			'sound' : '_B',  'keys' : ['B','C#','D#','E','F#','G#','A#','B']},
	{'name':'Bb Major', 'type' : 'major', 'key'	: 'Bb',		 	'sound' : '_Bb', 'keys' : ['Bb','C','D','Eb','F','G','A','Bb']},
	
	{'name':'C Minor', 	'type' : 'minor', 'key' : 'C', 			'sound' : '_C',  'keys' : ['C','D','Eb','F','G','Ab','Bb','C'],		'harmonic' : ['C','D','Eb','F','G','Ab','B','C'],		'melodic':[]}, 
	{'name':'C# Minor', 'type' : 'minor', 'key' : 'C#',		 	'sound' : '_C#', 'keys' : ['C#','D#','E','F#','G#','A','B','C#'], 	'harmonic' : ['C#','D#','E','F#','G#','A','B#','C#'],	'melodic':[]},
	{'name':'D Minor', 	'type' : 'minor', 'key' : 'D', 			'sound' : '_D',  'keys' : ['D','E','F','G','A','Bb','C','D'],		'harmonic' : ['D','E','F','G','A','Bb','C#','D'],		'melodic':[]},
	{'name':'Eb Minor', 'type' : 'minor', 'key' : 'Eb',			'sound' : '_Eb', 'keys' : ['Eb','F','Gb','Ab','Bb','Cb','Db','Eb'],	'harmonic' : ['Eb','F','Gb','Ab','Bb','Cb','D','Eb'],	'melodic':[]},
	{'name':'E Minor', 	'type' : 'minor', 'key' : 'E', 			'sound' : '_E',  'keys' : ['E','F#','G','A','B','C','D','E'],		'harmonic' : ['E','F#','G','A','B','C','D#','E'],		'melodic':[]},
	{'name':'F Minor', 	'type' : 'minor', 'key' : 'F', 			'sound' : '_F',  'keys' : ['F','G','Ab','Bb','C','Db','Eb','F'],	'harmonic' : ['F','G','Ab','Bb','C','Db','E','F'],		'melodic':[]},	
	{'name':'F# Minor', 'type' : 'minor', 'key'	: 'F#',		 	'sound' : '_F#', 'keys' : ['F#','G#','A','B','C#','D','E','F#'],	'harmonic' : ['F#','G#','A','B','C#','D','E#','F#'],	'melodic':[]},	
	{'name':'G Minor', 	'type' : 'minor', 'key' : 'G', 			'sound' : '_G',  'keys' : ['G','A','Bb','C','D','Eb','F','G'],		'harmonic' : ['G','A','Bb','C','D','Eb','F#','G'],		'melodic':[]},
	{'name':'G# Minor', 'type' : 'minor', 'key'	: 'G#', 		'sound' : '_G#', 'keys' : ['G#','A#','B','C#','D#','E','F#','G#'], 	'harmonic' : ['G#','A#','B','C#','D#','E','G','G#'],	'melodic':[]},
	{'name':'A Minor', 	'type' : 'minor', 'key' : 'A', 			'sound' : '_A',  'keys' : ['A','B','C','D','E','F','G','A'], 		'harmonic' : ['A','B','C','D','E','F','G#','A'],		'melodic':[]},
	{'name':'Bb Minor', 'type' : 'minor', 'key' : 'Bb',			'sound' : '_Bb', 'keys' : ['Bb','C','Db','Eb','F','Gb','Ab','Bb'],	'harmonic' : ['Bb','C','Db','Eb','F','Gb','A','Bb'],	'melodic':[]},
	{'name':'B Minor', 	'type' : 'minor', 'key' : 'B', 			'sound' : '_B',  'keys' : ['B','C#','D','E','F#','G','A','B'],		'harmonic' : ['B','C#','D','E','F#','G','A#','B'],		'melodic':[]}

];
