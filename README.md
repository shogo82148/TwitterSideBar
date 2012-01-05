Twitter Side Bar
======================
## Description ##
MediaWiki extension to add Twitter Widget in the sidebar.

## Installation##
Download this extension.

    cd /path/to/mediawiki/extensions
    git clone https://github.com/shogo82148/TwitterSideBar.git

Add the following line to your LocalSettings.php:

    require_once("$IP/extensions/TwitterSideBar/TwitterSideBar.php");

Add some settings:

    $wgTwitterSideBarOptions['type'] = 'profile';
    $wgTwitterSideBarOptions['user'] = 'Your User Name';

See Wedget Types and Common Settings to get more details about the settings.

## Wedget Types ##

### Profile ###
Display your most recent Twitter updates in the sidebar.

+ type: 'profile'
+ user: Your User Name

### Search ###
Displays search results in real time! Ideal for live events, broadcastings, conferences, TV Shows, or even just keeping up with the news.

+ type: 'search'
+ search: Search Query
+ title: Title
+ subject: Caption

### Faves ###
Show off your favorite tweets!

+ type: 'faves'
+ user: Your User Name
+ title: Title
+ subject: Caption

### List ###
Put your favorite tweeps into a list! 

+ type: 'list'
+ user: Your User Name
+ list: List Name
+ title: Title
+ subject: Caption

## Common Settings ##

+ shellbackground: The background color of the shell.
+ shellcolor: The text color of the shell.
+ tweetbackground: The background color of tweets.
+ tweetcolor: The color of tweets.
+ tweetlinks: The color of the links in tweets.
+ width: The width of the widget.
+ height: The height of the widget.
+ tweets: The number of tweets.
+ scrollbar: true(show the scroll bar) or false.
+ loop: true or false.
+ live: true or false.
+ interval: The interval time in ms.
+ behavior: 'default' or 'all'

## License ##
----------
Copyright &copy; 2012 Shogo Ichinose
Distributed under the [MIT License][mit].
 
[MIT]: http://www.opensource.org/licenses/mit-license.php
