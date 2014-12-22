var notes = [
	{'key':'C',		'type': 'none',		'character':'a', 	'key_code':65,		'offset': 0},
	{'key':'C#',	'type': 'sharp',	'character':'w', 	'key_code':87,		'offset': 1},
	{'key':'Db',	'type': 'flat',		'character':'w', 	'key_code':87,		'offset': 1},
	{'key':'D',		'type': 'none',		'character':'s', 	'key_code':83,  	'offset': 2},
	{'key':'D#',	'type': 'sharp',	'character':'e', 	'key_code':69, 		'offset': 3},
	{'key':'Eb',	'type': 'flat',		'character':'e', 	'key_code':69, 		'offset': 3},
	{'key':'E', 	'type': 'none',		'character':'d', 	'key_code':68, 		'offset': 4},
	{'key':'Fb',	'type': 'flat',		'character':'d', 	'key_code':68, 		'offset': 4},
	{'key':'F',		'type': 'none',		'character':'f', 	'key_code':70,  	'offset': 5},
	{'key':'E#',	'type': 'sharp',	'character':'f', 	'key_code':70, 		'offset': 5},
	{'key':'F#',	'type': 'sharp',	'character':'t', 	'key_code':84, 		'offset': 6},
	{'key':'Gb',	'type': 'flat',		'character':'t', 	'key_code':84, 		'offset': 6},
	{'key':'G',		'type': 'none',		'character':'g', 	'key_code':71,  	'offset': 7},
	{'key':'G#',	'type': 'sharp',	'character':'g', 	'key_code':71, 		'offset': 8},
	{'key':'Ab',	'type': 'flat',		'character':'y', 	'key_code':89, 		'offset': 8},
	{'key':'A', 	'type': 'none',		'character':'h', 	'key_code':72, 		'offset': 9},
	{'key':'A#',	'type': 'sharp',	'character':'u', 	'key_code':85,		'offset': 10},
	{'key':'Bb',	'type': 'flat',		'character':'u', 	'key_code':85,		'offset': 10},
	{'key':'B', 	'type': 'none',		'character':'j', 	'key_code':74, 		'offset': 11},
	{'key':'Cb',	'type': 'flat',		'character':'j', 	'key_code':74, 		'offset': 11},
	{'key':'C',		'type': 'none',		'character':'k', 	'key_code':75, 		'offset': 12},
	{'key':'B#',	'type': 'sharp',	'character':'k', 	'key_code':75, 		'offset': 12},
	{'key':'C#',	'type': 'sharp',	'character':'o', 	'key_code':79,  	'offset': 13},
	{'key':'Db',	'type': 'flat',		'character':'o', 	'key_code':79,  	'offset': 13},
	{'key':'D',		'type': 'none',		'character':'l', 	'key_code':76,   	'offset': 14},
	{'key':'D#',	'type': 'sharp',	'character':'p', 	'key_code':80,   	'offset': 15},
	{'key':'Eb',	'type': 'flat',		'character':'p', 	'key_code':80,   	'offset': 15},
	{'key':'E',		'type': 'none',		'character':';', 	'key_code':186,   	'offset': 16},
	{'key':'Fb',	'type': 'flat',		'character':';', 	'key_code':186,   	'offset': 16},
	{'key':'F',		'type': 'none',		'character':'\'',	'key_code':222,  	'offset': 17},
	{'key':'E#',	'type': 'sharp',	'character':'\'',	'key_code':222,  	'offset': 17},
	{'key':'F#',	'type': 'sharp',	'character':'', 	'key_code':null, 	'offset': 18},
	{'key':'Gb',	'type': 'flat',		'character':'', 	'key_code':null, 	'offset': 18},
	{'key':'G',		'type': 'none',		'character':'', 	'key_code':null,  	'offset': 19},
	{'key':'G#',	'type': 'sharp',	'character':'', 	'key_code':null, 	'offset': 20},
	{'key':'Ab',	'type': 'flat',		'character':'', 	'key_code':null, 	'offset': 20},
	{'key':'A', 	'type': 'none',		'character':'', 	'key_code':null, 	'offset': 21},
	{'key':'A#',	'type': 'sharp',	'character':'', 	'key_code':null,	'offset': 22},
	{'key':'Bb',	'type': 'flat',		'character':'', 	'key_code':null,	'offset': 22},
	{'key':'B', 	'type': 'none',		'character':'', 	'key_code':null, 	'offset': 23},
	{'key':'Cb',	'type': 'flat',		'character':'', 	'key_code':null, 	'offset': 23}
];

var scales = [
	{'name':'Major', 			'type':'major', 		'scale_offset':[0,2,4,5,7,9,11]},
	{'name':'Minor', 			'type':'minor', 		'scale_offset':[0,2,3,5,7,8,10]},
	{'name':'Harmonic Minor', 	'type':'harmonic', 		'scale_offset':[0,2,3,5,7,8,11]},
	{'name':'Melodic Minor', 	'type':'melodic', 		'scale_offset':[0,2,3,5,7,9,11]},
	{'name':'Lydian', 			'type':'lydian', 		'scale_offset':[0,2,4,6,7,9,11]}
	//{'name':'Mixolydian', 	'type':'mixo', 			'scale_offset':[0,2,4,5,7,9,10]}
];

var chords = [
	{'name':'Major', 			'type':'major', 	'chord': [0,4,7]},
	{'name':'Minor', 			'type':'minor', 	'chord': [0,3,7]},
	{'name':'Diminished', 		'type':'dim', 		'chord': [0,3,6]},
	{'name':'Augmented', 		'type':'aug', 		'chord': [0,4,8]},
	{'name':'Major 7th', 		'type':'major7', 	'chord': [0,4,7,11]},
	{'name':'Minor 7th', 		'type':'minor7', 	'chord': [0,3,7,10]},
	{'name':'Dominant 7th', 	'type':'dom7', 		'chord': [0,4,7,10]},
	{'name':'Diminished 7th', 	'type':'dim7', 		'chord': [0,3,6,9]}
];

var numerals = [
	{'type':'major',	'numerals':['I','ii','iii','IV','V','vi','vii°']},
	{'type':'minor',	'numerals':['i','ii°','III','iv','v','VI','VII']},
	{'type':'harmonic',	'numerals':['i','ii°','III+','iv','V','VI','vii°']},
	{'type':'lydian',	'numerals':['I','II','iii','iv°','V','vi','vii']}
	//{'type':'mixo',		'numerals':['I','ii','iii°','IV','v','vi','VII']}
];

var fifths = [
	{'name': 'Major / Ionian', 		'type':'major'		,'circle':['major','minor','minor','major','major','minor','dim']},
	{'name': 'N. Minor / Aeolian', 	'type':'minor'		,'circle':['minor','dim','major','minor','minor','major','major']},
	{'name': 'Harmonic Minor',	 	'type':'harmonic'	,'circle':['minor','dim','aug','minor','major','major','dim']},
	{'name': 'Lydian', 				'type':'lydian'		,'circle':['major','major','minor','dim','major','minor','minor']}
	//{'name': 'Mixolydian',			'type':'mixo'	,'circle':['major','minor','dim','major','minor','minor','major7']}
];
