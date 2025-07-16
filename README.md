# URI GTM Injector

A super lightweight plugin to inject a GTM tag across a WordPress multisite network.

## Setup

> **Note:** This plugin requires the active theme to support `wp_head` and `wp_body_open`.

1) **Ensure that GTM is not being injected in any other way prior to using this plugin.** GTM might already be injected by the active theme, another plugin, or directly via a script tag on a page, post, or widget, etc.
2) Network-activate the URI GTM Injector plugin.
3) In the plugin's network settings, enter your GTM property ID and save.
4) Check Google Analytics to make sure the property is connected and data is flowing.

## Plugin Details

**Contributors:** Brandon Fuller  
**Tags:** plugins  
**Requires at least:** 5.2  
**Tested up to:** 6.7.2  
**Stable tag:** 0.1.0  
**License:** GPL-3.0  
**Licence URI:** https://www.gnu.org/licenses/gpl-3.0.html  