=== Ad Rotator ===
Contributors: kpumuk
Tags: ads, advertisements, ad, widget, rotate, sidebar
Requires at least: 2.8.0
Tested up to: 2.8.2
Stable tag: 2.0.0

Ad Rotator is a simple widget to display random HTML code (advertisements)
from a given group of HTML-chunks on sidebar.

== Description ==

Ad Rotator is a simple WordPress widget to display random HTML code
from a given group of HTML-chunks separated with `<!--more-->`
on sidebar. Basically it shows different HTML every time you requesting
page. There are Up to 9 instances of this widget may exist.

= Support =

If you have any suggestions, found a bug, or just wanted to say "thank
you",– feel free to email me <a href="mailto:kpumuk@kpumuk.info">kpumuk@kpumuk.info</a>.
Promise, I will answer every email I received.

If you want to contribute your code, see the *Development* section under
the *Other Notes* tab.

== Installation ==

1. Download and unpack plugin files to the `wp-content/plugins/ad-rotator`
   directory.
2. Enable **Ad Rotator** plugin on your *Plugins* page in
   *Site Admin*.
3. Go to the *Options/Permalinks* page in *Site Admin* and use `%scategory%`
   option in *Custom text* field (you can look <a href="http://codex.wordpress.org/Using_Permalinks">here</a>
   for other options). For example you could use `/%scategory%/%postname%/`.
4. Now on Write Post page near the categories checkboxes radio button will
   appear.

== Frequently Asked Questions ==

= How to enter several ads to a single text box? =

Separate your ad blocks with `<!--more-->` sequence.

= How many ads every instance of widget could handle? =

Number of advertisements in each instance is unlimited.

= Can I use Google AdSense code as one of my ads? =

Of course, you can use any HTML you wish.

== Screenshots ==

1. Ad Rotator widget configuration.
2. Sidebar with Ad Rotator widgets.

== Changelog ==

= 2.0.0 =
* Completely rewritten using new WordPress 2.8 widgets API.
* Readme file and couple of screenshots added.

= 1.0.1 (March 31, 2007) =
* Plugin home page updated.

= 1.0.0 (May 1, 2006) =
* Initial plugin implementation.

== Development ==

Sources of this plugin are available both in SVN and Git:

* <a href="http://svn.wp-plugins.org/ad-rotator/">WordPress SVN repository</a>
* <a href="http://github.com/kpumuk/ad-rotator/">GitHub</a>

Feel free to check them out, make your changes and send me patches.
Promise, I will apply every patch (of course, if they add a value to the
product). Email for patches, suggestions, or bug reports:
<a href="mailto:kpumuk@kpumuk.info">kpumuk@kpumuk.info</a>.
