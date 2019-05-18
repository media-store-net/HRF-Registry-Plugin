=== HRF Registry Plugin ===
Contributors: pcservice-voll
Donate link: http://media-store.net
Tags: "wordpress", "plugin", "plugins", "mvc", "register", "registry", "userregistry"
Requires at least: 4.2
Tested up to: 5.2
Requires PHP: 5.4
Stable tag: 5.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Kundenspezifischer Registrierungsablauf der User und Zugang zum geschützten Bereich einer Homepage.

== Description ==

Funktionaler Ablauf:
Ein Registrierungsformular steht in einem Shortcode zur Verfügung und kann somit auf einer beliebigen Seite von Wordpress eingebunden werden.
- Wenn ein User das Formular ausgefüllt und abgeschickt hat, wird im ersten Schritt eine Bestätigungsmail für den Kunden generiert,
in der er als Inhaber seiner Email-Adresse identifiziert wird.
- Ist die Inhaberschaft des Users bestätigt, wird eine zweite Email generiert die an den Administrator geht, dieser hat als erstes
die Einsicht in die Daten des Kunden und 2 Links um den User freizuschalten oder abzulehnen.
- Wird der User seitens Administrator freigeschaltet, wird der User im System angelegt und bekommt eine Email mit seinen Zugangsdaten.
- Wird der User abgelehnt, werden alle erfassten Daten des Users aus DB gelöscht und der User bekommt eine Email mit den Kontaktdaten zur direkten Kontaktaufnahme.
- Der geschützte Bereich für die User kann sowohl als Zusatzplugin oder Page Template realisiert werden.

== Installation ==

This section describes how to install the plugin and get it working.

e.g.

1. Upload `plugin-name.php` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Place `&amp;lt;?php do_action('plugin_name_hook'); ?&amp;gt;` in your templates

== Frequently Asked Questions ==

= A question that someone might have =

An answer to that question.

= What about foo bar? =

Answer to foo bar dilemma.

== Screenshots ==

1. This screen shot description corresponds to screenshot-1.(png|jpg|jpeg|gif). Note that the screenshot is taken from
the /assets directory or the directory that contains the stable readme.txt (tags or trunk). Screenshots in the /assets
directory take precedence. For example, `/assets/screenshot-1.png` would win over `/tags/4.3/screenshot-1.png`
(or jpg, jpeg, gif).
2. This is the second screen shot

== Changelog ==

= 1.0 =
* A change since the previous version.
* Another change.

= 0.5 =
* List versions from most recent at top to oldest at bottom.

== Upgrade Notice ==

= 1.0 =
Upgrade notices describe the reason a user should upgrade.  No more than 300 characters.

= 0.5 =
This version fixes a security related bug.  Upgrade immediately.

== Arbitrary section ==

You may provide arbitrary sections, in the same format as the ones above.  This may be of use for extremely complicated
plugins where more information needs to be conveyed that doesn't fit into the categories of "description" or
"installation."  Arbitrary sections will be shown below the built-in sections outlined above.

== A brief Markdown Example ==

Ordered list:

1. Some feature
1. Another feature
1. Something else about the plugin

Unordered list:

* something
* something else
* third thing

Here's a link to [WordPress](https://wordpress.org/ "Your favorite software") and one to [Markdown's Syntax Documentation][markdown syntax].
Titles are optional, naturally.

[markdown syntax]: http://daringfireball.net/projects/markdown/syntax
            "Markdown is what the parser uses to process much of the readme file"

Markdown uses email style notation for blockquotes and I've been told:
