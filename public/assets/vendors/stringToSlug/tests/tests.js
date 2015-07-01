$('body').append('<input id="text" type="hidden" /><input type="hidden" id="permalink" />');
$('#text').stringToSlug();

function fromToTest(preText, resultExpect, fieldInput) {
	$('#' + fieldInput)
		.val(preText)
		.trigger('blur');

	var result = $('#permalink').val();
	equal(result, resultExpect, preText + ': ' + result);
}

module('Languages support');
test( "Brazilian Portuguese", function() {

	var preText 		= 'Acentuação tem que ficar! Bonita e sem acento!';
	var resultExpect 	= 'acentuacao-tem-que-ficar-bonita-e-sem-acento';

	fromToTest(preText, resultExpect, 'text');

});

test( "English", function() {

	var preText 		= 'Accent has to stay! Beautiful and without accent!';
	var resultExpect 	= 'accent-has-to-stay-beautiful-and-without-accent';

	fromToTest(preText, resultExpect, 'text');

});

test( "Slovak", function() {

	var preText 		= 'vyhľadával NIEKOĽKÝMI';
	var resultExpect 	= 'vyhladaval-niekolkymi';

	fromToTest(preText, resultExpect, 'text');

});

test( "Turkish", function() {

	var preText 		= 'İnsan oğulları üzerine ecdadım Bumın hakan, İstemi hakan tahta oturmuş;';
	var resultExpect 	= 'insan-ogullari-uzerine-ecdadim-bumin-hakan-istemi-hakan-tahta-oturmus';

	fromToTest(preText, resultExpect, 'text');

});

module('Commands and functionality');

test( "Replace", function() {
	var fieldInput = 'no-parentheses';
	$('body'). append('<input id="' + fieldInput + '" type="hidden" />');
	$('#' + fieldInput).stringToSlug({
        replace: /\s?\([^\)]*\)/gi
   	});

	var preText 		= "I'll be alone (because Ill be removed)!";
	var resultExpect 	= 'ill-be-alone';

	fromToTest(preText, resultExpect, fieldInput);
});

test( "Space", function() {
	var fieldInput = 'space';
	$('body'). append('<input id="' + fieldInput + '" type="hidden" />');
	$('#' + fieldInput).stringToSlug({
        space: '_'
   	});

	var preText 		= "The space is an undescore";
	var resultExpect 	= 'the_space_is_an_undescore';

	fromToTest(preText, resultExpect, fieldInput);
});

test( "Prefix", function() {
	var fieldInput = 'prefix';
	$('body'). append('<input id="' + fieldInput + '" type="hidden" />');
	$('#' + fieldInput).stringToSlug({
        prefix: 'http://'
   	});

	var preText 		= "I will get a prefix!";
	var resultExpect 	= 'http://i-will-get-a-prefix';

	fromToTest(preText, resultExpect, fieldInput);
});


test( "Suffix", function() {
	var fieldInput = 'sufix';
	$('body'). append('<input id="' + fieldInput + '" type="hidden" />');
	$('#' + fieldInput).stringToSlug({
        suffix: '.jpg'
   	});

	var preText 		= "I will get a suffix!";
	var resultExpect 	= 'i-will-get-a-suffix.jpg';

	fromToTest(preText, resultExpect, fieldInput);
});

test( "& AND", function() {
	var fieldInput = 'and';
	$('body'). append('<input id="' + fieldInput + '" type="hidden" />');
	$('#' + fieldInput).stringToSlug({
        AND: 'e'
   	});

	var preText 		= "Man & Woman";
	var resultExpect 	= 'man-e-woman';

	fromToTest(preText, resultExpect, fieldInput);
});


module('Bugs fixed');

test( "“ and ” (Undefined chars)", function() {

	var preText 		= "A text betweet quotes “ and ” are not going to be a problem!";
	var resultExpect 	= 'a-text-betweet-quotes-and-are-not-going-to-be-a-problem';

	fromToTest(preText, resultExpect, 'text');
});