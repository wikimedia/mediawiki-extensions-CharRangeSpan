<?php
/* See COPYING file for copyright and license details. */

if( !defined( 'MEDIAWIKI' ) ) {
	die( "This is an extension to the MediaWiki package and cannot be run standalone." );
}

$wgExtensionCredits['parserhook'][] = array(
	'path' => __FILE__,
	'name' => 'Character range span',
	'version' => '0.10.0',
	'author' => 'Nick White',
	'url' => 'https://www.mediawiki.org/wiki/Extension:CharRangeSpan',
	'descriptionmsg' => 'charrangespan-desc',
);

/* Default settings: any Greek characters are enclosed in <span lang="grc"> tags */
$wgCharRangeSpanSettings = array(
	'grc' => array(
		'ranges' => array(
			array( '0300', '036F' ), /* combining diacritics */
			array( '0370', '03FF' ), /* greek */
			array( '1F00', '1FFF' ), /* greek extended */
		),
		'attrs' => 'lang="grc"', /* sets the attribute for the span */
		'maybeChars' => '\\s\\,\\.\\-', /* characters which may (or may not) be included in span */
		                                /* these must be escaped for a PHP regular expression */
	),
);

$wgAutoloadClasses['CharRangeSpan'] = dirname( __FILE__ ) . '/CharRangeSpan.body.php';
$wgMessagesDirs['CharRangeSpan'] = __DIR__ . '/i18n';
$wgExtensionMessagesFiles['CharRangeSpan'] = dirname( __FILE__ ) . '/CharRangeSpan.i18n.php';
$wgParserTestFiles[] = dirname( __FILE__ ) . '/tests/parserTests.txt';

$wgHooks['ParserBeforeTidy'][] = 'CharRangeSpan::doCharRangeSpan';
