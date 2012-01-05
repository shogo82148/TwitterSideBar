<?php
  /**
   * MediaWiki extension to add Twitter Widget in the sidebar.
   */
 
  /**
   * Exit if called outside of MediaWiki
   */
if( !defined( 'MEDIAWIKI' ) ) {
  echo( "This file is an extension to the MediaWiki software and cannot be used standalone.\n" );
  die( 1 );
 }
 
/**
 * SETTINGS
 * --------
 * The description of the portlet can be changed in [[MediaWiki:Twittersidebar]].
 *.
 * Variables should be set in the LocalSettings.php
 */
 
$wgExtensionCredits['other'][] = array(
				       'name'           => 'Twitter Side Bar',
				       'version'        => '0.0',
				       'author'         => 'Shogo Ichinose',
				       'description'    => 'Adds [http://www.twitter.com Twitter] Wedget to the sidebar',
				       'url'            => '[http://kslab.nagaokaut.ac.jp/]',
				       );
 
$wgTwitterSideBarOptions = array();
$wgTwitterSideBarOptions['type'] = 'profile';

//Settings for Profile, Faves, and List
$wgTwitterSideBarOptions['user'] = '';

//Settings for Search, Faves, and List
$wgTwitterSideBarOptions['title'] = '';
$wgTwitterSideBarOptions['subject'] = '';

//Settings for Search
$wgTwitterSideBarOptions['search'] = '';

//Settings for List
$wgTwitterSideBarOptions['list'] = '';

//Color Settings
$wgTwitterSideBarOptions['shellbackground'] = '#333333';
$wgTwitterSideBarOptions['shellcolor'] = '#ffffff';
$wgTwitterSideBarOptions['tweetbackground'] = '#000000';
$wgTwitterSideBarOptions['tweetcolor'] = '#ffffff';
$wgTwitterSideBarOptions['tweetlinks'] = '#4aed05';

//Dimensions
$wgTwitterSideBarOptions['width'] = 'auto';
$wgTwitterSideBarOptions['height'] = 300;

//Other
$wgTwitterSideBarOptions['tweets'] = 4;
$wgTwitterSideBarOptions['scrollbar'] = true;
$wgTwitterSideBarOptions['loop'] = false;
$wgTwitterSideBarOptions['live'] = false;
$wgTwitterSideBarOptions['interval'] = 30000;
$wgTwitterSideBarOptions['behavior'] = 'all';

// Hook to modify the sidebar
$wgHooks['SkinBuildSidebar'][] = 'TwitterSideBar::Wedget';
 
// Class & functions
class TwitterSideBar {
  function Wedget( $skin, &$bar ) {
    global $wgTwitterSideBarOptions;
    if($wgTwitterSideBarOptions['width']=='auto') {
      $wgTwitterSideBarOptions['width'] = '"auto"';
    }

    $bar['TwitterSideBar']  = '<script src="http://widgets.twimg.com/j/2/widget.js"></script>'.
      '<script>'.
      'new TWTR.Widget({'.
      'version: 2,'.
      'type: "'.$wgTwitterSideBarOptions['type'].'",'.
      'rpp: '.$wgTwitterSideBarOptions['tweets'].','.
      'interval: 30000,'.
      'width: '.$wgTwitterSideBarOptions['width'].','.
      'height: '.$wgTwitterSideBarOptions['height'].','.
      'theme: {'.
      'shell: {'.
      'background: "'.$wgTwitterSideBarOptions['shellbackground'].'",'.
      'color: "'.$wgTwitterSideBarOptions['shellcolor'].'"'.
      '},'.
      'tweets: {'.
      'background: "'.$wgTwitterSideBarOptions['tweetbackground'].'",'.
      'color: "'.$wgTwitterSideBarOptions['tweetcolor'].'",'.
      'links: "'.$wgTwitterSideBarOptions['tweetlinks'].'"'.
      '} },'.
      'features: {'.
      'scrollbar: true,'.
      'loop: false,'.
      'live: false,'.
      'behavior: "'.$wgTwitterSideBarOptions['hehavior'].'"'.
      '}';
    if($wgTwitterSideBarOptions['type']=='profile') {
      $bar['TwitterSideBar'] .= '}).render().setUser("'.$wgTwitterSideBarOptions['user'].'").start();</script>';
    } else if($wgTwitterSideBarOptions['type']=='search') {
      $bar['TwitterSideBar'] .= ','.
	'search: "'.TwitterSideBar::escape($wgTwitterSideBarOptions['search']).'",'.
	'title: "'.TwitterSideBar::escape($wgTwitterSideBarOptions['title']).'",'.
	'subject: "'.TwitterSideBar::escape($wgTwitterSideBarOptions['subject']).'"'.
	'}).render().start();</script>';
    } else if($wgTwitterSideBarOptions['type']=='faves') {
      $bar['TwitterSideBar'] .= ','.
	'title: "'.TwitterSideBar::escape($wgTwitterSideBarOptions['title']).'",'.
	'subject: "'.TwitterSideBar::escape($wgTwitterSideBarOptions['subject']).'"'.
	'}).render().setUser("'.$wgTwitterSideBarOptions['user'].'").start();</script>';
    } else if($wgTwitterSideBarOptions['type']=='list') {
      $bar['TwitterSideBar'] .= ','.
	'title: "'.TwitterSideBar::escape($wgTwitterSideBarOptions['title']).'",'.
	'subject: "'.TwitterSideBar::escape($wgTwitterSideBarOptions['subject']).'"'.
	'}).render().setList("'.$wgTwitterSideBarOptions['user'].'", "'.
	$wgTwitterSideBarOptions['list'].'").start();</script>';
    }
    return true;
  }

  function escape($str) {
    return str_replace('"', '\\"', $str);
  }
}
