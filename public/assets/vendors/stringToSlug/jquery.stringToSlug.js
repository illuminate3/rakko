/*
 * jQuery stringToSlug plug-in 1.3.1
 *
 * Plugin HomePage http://leocaseiro.com.br/jquery-plugin-string-to-slug/
 *
 * Copyright (c) 2009 Leo Caseiro
 *
 * Based on Edson Hilios (http://www.edsonhilios.com.br/ Algoritm
 *
 *
 * Dual licensed under the MIT and GPL licenses:
 *   http://www.opensource.org/licenses/mit-license.php
 *   http://www.gnu.org/licenses/gpl.html
 */

var _stringToSlug_API = function(text, options) {
	var defaults = {
		setEvents: 'keyup keydown blur', //set Events
		getPut: '#permalink', //set output field
		space: '-', //Sets the space character
		prefix: '', //It happens after the replacement
		suffix: '', //It happens after the replacement
		replace: '', //RegExp replacement: /\s?\([^\)]*\)/gi
		AND: 'and',
		callback: false,
	};

	var opts = jQuery.extend(defaults, options);

	text = text.replace(defaults.replace, ""); //replace
	text = jQuery.trim(text.toString()); //Remove side spaces and convert to String Object

	var chars = [];
	for (var i = 0; i < 32; i++) {
		chars.push ('');
	}

	/*** Abaixo a lista de caracteres ***/
	chars.push(
		defaults.space, // Unicode 32
		'',   // !
		'',   // "
		'',   // #
		'',   // $
		'',   // %
		defaults.AND,   // &
		"",   // '
		defaults.space,  // (
		defaults.space,  // ,
		'',   // *
		'',   // +
		defaults.space,  // ,
		defaults.space,  // -
		defaults.space,  // .
		defaults.space,  // /
		'0',  // 0
		'1',  // 1
		'2',  // 2
		'3',  // 3
		'4',  // 4
		'5',  // 5
		'6',  // 6
		'7',  // 7
		'8',  // 8
		'9',  // 9
		defaults.space,   // :
		defaults.space,   // ;
		'',   // <
		defaults.space,   // =
		'',   // >
		'',   // ?
		'',   // @
		'A',  // A
		'B',  // B
		'C',  // C
		'D',  // D
		'E',  // E
		'F',  // F
		'G',  // G
		'H',  // H
		'I',  // I
		'J',  // J
		'K',  // K
		'L',  // L
		'M',  // M
		'N',  // N
		'O',  // O
		'P',  // P
		'Q',  // Q
		'R',  // R
		'S',  // S
		'T',  // T
		'U',  // U
		'V',  // V
		'W',  // W
		'X',  // X
		'Y',  // Y
		'Z',  // Z
		defaults.space,  // [
		defaults.space,  // /
		defaults.space,  // ]
		'',   // ^
		defaults.space,  // _
		'',   // `
		'a',  // a
		'b',  // b
		'c',  // c
		'd',  // d
		'e',  // e
		'f',  // f
		'g',  // g
		'h',  // h
		'i',  // i
		'j',  // j
		'k',  // k
		'l',  // l
		'm',  // m
		'n',  // n
		'o',  // o
		'p',  // p
		'q',  // q
		'r',  // r
		's',  // s
		't',  // t
		'u',  // u
		'v',  // v
		'w',  // w
		'x',  // x
		'y',  // y
		'z',  // z
		defaults.space,  // {
		'',   // |
		defaults.space,  // }
		'',   // ~
		'', // ? 007F control char: del

		// start of C1 Controls (Range: 0080–009F)
		// TODO: shouldn't control chars be empty?
		'C', // 0080 control char
		'A',
		'',
		'f',
		'',
		'',
		'T',
		't',
		'',
		'',
		'S',
		'',
		'CE',
		'A',
		'Z',
		'A', // 008F control char
		'A',
		'',
		'',
		'',
		'',
		'',
		defaults.space,
		defaults.space,
		'',
		'TM',
		's',
		'',
		'ae',
		'A',
		'z',
		'Y', // 009F control char: application program command

		// start of Latin-1 Supplement (Range: 00A0-00FF)
		'', // 00A0 control char: no break space
		'',
		'c',
		'L',
		'o',
		'Y',
		'',
		'S',
		'',
		'c',
		'a',
		'',
		'',
		'',
		'r',
		defaults.space,
		'o',
		'',
		'2',
		'3',
		'',
		'u',
		'p',
		'',
		'',
		'1',
		'o',
		'',
		'',
		'',
		'',
		'',
		'A', //00C0 À
		'A',
		'A',
		'A',
		'A',
		'A',
		'AE',
		'C',
		'E',
		'E',
		'E',
		'E',
		'I',
		'I',
		'I',
		'I',
		'D',
		'N',
		'O',
		'O',
		'O',
		'O',
		'O',
		'x',
		'O',
		'U',
		'U',
		'U',
		'U',
		'Y',
		'D',
		'B',
		'a',
		'a',
		'a',
		'a',
		'a',
		'a',
		'ae',
		'c',
		'e',
		'e',
		'e',
		'e',
		'i',
		'i',
		'i',
		'i',
		'o',
		'n',
		'o',
		'o',
		'o',
		'o',
		'o',
		'',
		'o',
		'u',
		'u',
		'u',
		'u',
		'y',
		'',
		'y', // 00FF

		// start of Latin Extended-A (Range: Range: 0100–017F)
		'A', // 0100 Ā
		'a',
		'A',
		'a',
		'A',
		'a',
		'C', // 0106 Ć
		'c',
		'C',
		'c',
		'C',
		'c',
		'C',
		'c',
		'D', // 010E Ď
		'd',
		'D',
		'd',
		'E', // 0112 Ē
		'e',
		'E',
		'e',
		'E',
		'e',
		'E',
		'e',
		'E',
		'e',
		'G', // 011C Ĝ
		'g',
		'G',
		'g',
		'G',
		'g',
		'G',
		'g',
		'H', // 0124 Ĥ
		'h',
		'H',
		'h',
		'I', // 0128 Ĩ
		'i',
		'I',
		'i',
		'I',
		'i',
		'I',
		'i',
		'I',
		'i',
		'IJ', // 0132 Ĳ
		'ij',
		'J',
		'j',
		'K', // 0136 Ķ
		'k',
		'k',
		'L', // 0139 Ĺ
		'l',
		'L',
		'l',
		'L',
		'l',
		'L',
		'l',
		'L',
		'l',
		'N', // 0143 Ń
		'n',
		'N',
		'n',
		'N',
		'n',
		'n', // 0149 deprecated ŉ
		'N',
		'n',
		'O', // 014C Ō
		'o',
		'O',
		'o',
		'O',
		'o',
		'OE',
		'oe',
		'R', // 0154 Ŕ
		'r',
		'R',
		'r',
		'R',
		'r',
		'S', // 015A Ś
		's',
		'S',
		's',
		'S',
		's',
		'S',
		's',
		'T', // 0162 Ţ
		't',
		'T',
		't',
		'T',
		't',
		'U', // 0168 Ũ
		'u',
		'U',
		'u',
		'U',
		'u',
		'U',
		'u',
		'U',
		'u',
		'U',
		'u',
		'W', // 0174 Ŵ
		'w',
		'Y', // 0176 Ŷ
		'y',
		'Y',
		'Z', // 0179 Ź
		'z',
		'Z',
		'z',
		'Z',
		'z',
		's',  // 017F
		'S', //Ş
		's',
		'ş',
		's',
		'C', //Ç
		'c',
		'c', //ç
		'c',
		'I', //İ
			'i',
		'ı',
		'i',
		'g', //ğ
		'g',
		'G', //Ğ
		'g',
		'u', //ü
		'u',
		'U', //Ü
		'u',
		'o', //ö
		'o',
		'O', //Ö
		'o'
	);

	//TODO: Support in Cyrillic, Arabic, CJK

	var stringToSlug = new String(), //Create a stringToSlug String Object
		lenChars     = chars.length, // store length of the array
		lenText      = text.length;

	for (var i = 0; i < lenText; i ++) {
		var cCAt = text.charCodeAt(i);
		if(cCAt < lenChars) stringToSlug += chars[cCAt]; //Insert values converts at slugs (if it exists in the array)
	}

	stringToSlug = stringToSlug.replace (new RegExp ('\\'+defaults.space+'{2,}', 'gmi'), defaults.space); // Remove any space character followed by Breakfast
	stringToSlug = stringToSlug.replace (new RegExp ('(^'+defaults.space+')|('+defaults.space+'$)', 'gmi'), ''); // Remove the space at the beginning or end of string

	stringToSlug = stringToSlug.toLowerCase(); //Convert your slug in lowercase

	stringToSlug = defaults.prefix + stringToSlug + defaults.suffix; //Concatenate with prefix and suffix

	return stringToSlug;
};

jQuery.fn.stringToSlug = function(options) {
	var defaults = {
		setEvents: 'keyup keydown blur', //set Events that your script will work
		getPut: '#permalink', //set output field
		space: '-', //Sets the space character. If the hyphen,
		prefix: '',
		suffix: '',
		replace: '', //Sample: /\s?\([^\)]*\)/gi
		AND: 'and',
		callback: false,
	};

	var opts = jQuery.extend(defaults, options);

	jQuery(this).bind(defaults.setEvents, function () {
		var text = jQuery(this).val();

		var stringToSlug = _stringToSlug_API(text, options);

		jQuery(defaults.getPut).val(stringToSlug); //Write in value to input fields (input text, textarea, input hidden, ...)
		jQuery(defaults.getPut).html(stringToSlug); //Write in HTML tags (span, p, strong, h1, ...)

		if( defaults.callback !== false ) {
			defaults.callback(stringToSlug);
		}

		return this;
	});

  return this;
};