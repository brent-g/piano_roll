
var major_chord = [0,4,7];
var minor_chord = [0,3,7];

var notes = [
	{'key':'C',		'character':'a', 	'key_code':65,		'offset': 0},
	{'key':'C#',	'character':'w', 	'key_code':87,		'offset': 1},
	{'key':'Db',	'character':'w', 	'key_code':87,		'offset': 1},
	{'key':'D',		'character':'s', 	'key_code':83,  	'offset': 2},
	{'key':'D#',	'character':'e', 	'key_code':69, 		'offset': 3},
	{'key':'Eb',	'character':'e', 	'key_code':69, 		'offset': 3},
	{'key':'E', 	'character':'d', 	'key_code':68, 		'offset': 4},
	{'key':'Fb',	'character':'d', 	'key_code':68, 		'offset': 4},
	{'key':'E#',	'character':'f', 	'key_code':70, 		'offset': 5},
	{'key':'F',		'character':'f', 	'key_code':70,  	'offset': 5},
	{'key':'F#',	'character':'t', 	'key_code':84, 		'offset': 6},
	{'key':'Gb',	'character':'t', 	'key_code':84, 		'offset': 6},
	{'key':'G',		'character':'g', 	'key_code':71,  	'offset': 7},
	{'key':'G#',	'character':'g', 	'key_code':71, 		'offset': 8},
	{'key':'Ab',	'character':'y', 	'key_code':89, 		'offset': 8},
	{'key':'A', 	'character':'h', 	'key_code':72, 		'offset': 9},
	{'key':'A#',	'character':'u', 	'key_code':85,		'offset': 10},
	{'key':'Bb',	'character':'u', 	'key_code':85,		'offset': 10},
	{'key':'B', 	'character':'j', 	'key_code':74, 		'offset': 11},
	{'key':'Cb',	'character':'j', 	'key_code':74, 		'offset': 11},
	{'key':'B#',	'character':'k', 	'key_code':75, 		'offset': 12},
	{'key':'C',		'character':'k', 	'key_code':75, 		'offset': 12},
	{'key':'C#',	'character':'o', 	'key_code':79,  	'offset': 13},
	{'key':'Db',	'character':'o', 	'key_code':79,  	'offset': 13},
	{'key':'D',		'character':'l', 	'key_code':76,   	'offset': 14},
	{'key':'D#',	'character':'p', 	'key_code':80,   	'offset': 15},
	{'key':'Eb',	'character':'p', 	'key_code':80,   	'offset': 15},
	{'key':'E',		'character':';', 	'key_code':186,   	'offset': 16},
	{'key':'Fb',	'character':';', 	'key_code':186,   	'offset': 16},
	{'key':'E#',	'character':'\'',	'key_code':222,  	'offset': 17},
	{'key':'F',		'character':'\'',	'key_code':222,  	'offset': 17}
];


var scales = [
	{'name':'Major', 'type':'major', 'scale_offset':[0,2,4,5,7,9,11]},
	{'name':'Minor', 'type':'minor', 'scale_offset':[0,2,3,5,7,8,10]}
];

// var chords = [
// ];


// var scales = [
// 	{'name':'C Major', 	'type' : 'major', 'key' : 'C', 			'sound' : '_C',  'keys' : ['C','D','E','F','G','A','B','C']}, 
// 	{'name':'C# Major', 'type' : 'major', 'key' : 'C#',		 	'sound' : '_C#', 'keys' : ['C#','D#','E#','F#','G#','A#','B#','C#']},
// 	{'name':'D Major', 	'type' : 'major', 'key' : 'D', 			'sound' : '_D',  'keys' : ['D','E','F#','G','A','B','C#','D']}, 
// 	{'name':'Db Major', 'type' : 'major', 'key'	: 'Db',		 	'sound' : '_Db', 'keys' : ['Db','Eb','F','Gb','Ab','Bb','C','Db']},
// 	{'name':'E Major', 	'type' : 'major', 'key' : 'E', 			'sound' : '_E',  'keys' : ['E','F#','G#','A','B','C#','D#','E']}, 
// 	{'name':'Eb Major', 'type' : 'major', 'key'	: 'Eb',		 	'sound' : '_Eb', 'keys' : ['Eb','F','G','Ab','Bb','C','D','Eb']},
// 	{'name':'F Major', 	'type' : 'major', 'key' : 'F', 			'sound' : '_F',  'keys' : ['F','G','A','Bb','C','D','E','F']}, 
// 	{'name':'F# Major', 'type' : 'major', 'key'	: 'F#',		 	'sound' : '_F#', 'keys' : ['F#','G#','A#','B','C#','D#','E#','F#']},
// 	{'name':'G Major', 	'type' : 'major', 'key' : 'G', 			'sound' : '_G',  'keys' : ['G','A','B','C','D','E','F#','G']}, 
// 	{'name':'Gb Major',	'type' : 'major', 'key'	: 'Gb',		 	'sound' : '_Gb', 'keys' : ['Gb','Ab','Bb','Cb','Db','Eb','F','Gb']},
// 	{'name':'A Major', 	'type' : 'major', 'key' : 'A', 			'sound' : '_A',  'keys' : ['A','B','C#','D','E','F#','G#','A']},
// 	{'name':'Ab Major', 'type' : 'major', 'key'	: 'Ab',		 	'sound' : '_Ab', 'keys' : ['Ab','Bb','C','Db','Eb','F','G','Ab']},
// 	{'name':'B Major', 	'type' : 'major', 'key' : 'B', 			'sound' : '_B',  'keys' : ['B','C#','D#','E','F#','G#','A#','B']},
// 	{'name':'Bb Major', 'type' : 'major', 'key'	: 'Bb',		 	'sound' : '_Bb', 'keys' : ['Bb','C','D','Eb','F','G','A','Bb']},
	
// 	{'name':'C Minor', 	'type' : 'minor', 'key' : 'C', 			'sound' : '_C',  'keys' : ['C','D','Eb','F','G','Ab','Bb','C'],		'harmonic' : ['C','D','Eb','F','G','Ab','B','C'],		'melodic':[]}, 
// 	{'name':'C# Minor', 'type' : 'minor', 'key' : 'C#',		 	'sound' : '_C#', 'keys' : ['C#','D#','E','F#','G#','A','B','C#'], 	'harmonic' : ['C#','D#','E','F#','G#','A','B#','C#'],	'melodic':[]},
// 	{'name':'D Minor', 	'type' : 'minor', 'key' : 'D', 			'sound' : '_D',  'keys' : ['D','E','F','G','A','Bb','C','D'],		'harmonic' : ['D','E','F','G','A','Bb','C#','D'],		'melodic':[]},
// 	{'name':'Eb Minor', 'type' : 'minor', 'key' : 'Eb',			'sound' : '_Eb', 'keys' : ['Eb','F','Gb','Ab','Bb','Cb','Db','Eb'],	'harmonic' : ['Eb','F','Gb','Ab','Bb','Cb','D','Eb'],	'melodic':[]},
// 	{'name':'E Minor', 	'type' : 'minor', 'key' : 'E', 			'sound' : '_E',  'keys' : ['E','F#','G','A','B','C','D','E'],		'harmonic' : ['E','F#','G','A','B','C','D#','E'],		'melodic':[]},
// 	{'name':'F Minor', 	'type' : 'minor', 'key' : 'F', 			'sound' : '_F',  'keys' : ['F','G','Ab','Bb','C','Db','Eb','F'],	'harmonic' : ['F','G','Ab','Bb','C','Db','E','F'],		'melodic':[]},	
// 	{'name':'F# Minor', 'type' : 'minor', 'key'	: 'F#',		 	'sound' : '_F#', 'keys' : ['F#','G#','A','B','C#','D','E','F#'],	'harmonic' : ['F#','G#','A','B','C#','D','E#','F#'],	'melodic':[]},	
// 	{'name':'G Minor', 	'type' : 'minor', 'key' : 'G', 			'sound' : '_G',  'keys' : ['G','A','Bb','C','D','Eb','F','G'],		'harmonic' : ['G','A','Bb','C','D','Eb','F#','G'],		'melodic':[]},
// 	{'name':'G# Minor', 'type' : 'minor', 'key'	: 'G#', 		'sound' : '_G#', 'keys' : ['G#','A#','B','C#','D#','E','F#','G#'], 	'harmonic' : ['G#','A#','B','C#','D#','E','G','G#'],	'melodic':[]},
// 	{'name':'A Minor', 	'type' : 'minor', 'key' : 'A', 			'sound' : '_A',  'keys' : ['A','B','C','D','E','F','G','A'], 		'harmonic' : ['A','B','C','D','E','F','G#','A'],		'melodic':[]},
// 	{'name':'Bb Minor', 'type' : 'minor', 'key' : 'Bb',			'sound' : '_Bb', 'keys' : ['Bb','C','Db','Eb','F','Gb','Ab','Bb'],	'harmonic' : ['Bb','C','Db','Eb','F','Gb','A','Bb'],	'melodic':[]},
// 	{'name':'B Minor', 	'type' : 'minor', 'key' : 'B', 			'sound' : '_B',  'keys' : ['B','C#','D','E','F#','G','A','B'],		'harmonic' : ['B','C#','D','E','F#','G','A#','B'],		'melodic':[]}

// ];
