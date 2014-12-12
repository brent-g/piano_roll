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
	{'type':'major','numerals':{1:'I', 2:'II', 3:'III', 4:'IV', 5:'V', 6:'VI', 7:'VII'}},
	{'type':'minor','numerals':{1:'i', 2:'ii', 3:'iii', 4:'iv', 5:'v', 6:'vi', 7:'vii'}}
];

var fifths = [
	{'name': 'Major / Ionian', 		'type':'major','circle':[{1:'major', 2:'minor', 3:'major', 4:'major', 5:'major', 6:'minor', 7:'dim'}]},
	{'name': 'N. Minor / Aeolian', 	'type':'minor','circle':[{1:'minor', 2:'dim', 3:'major', 4:'minor', 5:'minor', 6:'major', 7:'major'}]}
];