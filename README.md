# Plugins for wildflowerchurch.org by Sarah Riehl adapted from code by Terry Matula
# copyright 2017

## EVENTS PLUGIN TODOS

### Completed work
10/12/17 - Sarah has fleshed out the html for for event entry, but the form element names are not all current and the logic in this file is outdated.  The migrations have been worked on some, but the events table definition needs to be brought current when the event entry logic is correct.
https://github.com/slsriehl/wfc-plugins/riehl-matula-events/php/events-create.php


### OneBody
	* determine extent of tools that would integrate well with this project and provide tools to users and Lin
	* should the DB of events, etc be hosted by OneBody with API calls to populate shortcodes on our site?

### Events entry html, display and post logic
	* finish adding todos
		* make sure post field names are correct
		* separate parts of form into separate html php files  
	* separate logic files
		* add db calls to populate and loops to iterate, one for each html file
		* move form post logic into own php file
		* finalize post fields
		* update variables created based on post fields
		* update arrays to save to separate db tables

### Events update html, display and post logic

### JS, CSS
	* stylesheets
		* default WP or bootstrap
		* gulp sass
	* js
		* jquery, built into WP or add?
		* self authored, gulp concat

### Migrations
	* get more info for accessibility table
	* make some default contacts
	* double check foreign keys
	* double check column names against post arrays in events entry and update
	* add migration for room requests or sync to OneBody (check with Terry)

### Shortcodes
	events display on events page
	events display (non RE) for front page
	events display (RE) for front page
	events display for RE page
	events display confirmation for team enterers
	events display for room requests (Lin, may be obviated by **OneBody?**)
	
### init.php

### Notifications
	**OneBody?**
	* email Lin for room requests
	* email Lin for calendar requests
	* email creators with successful room requests and any todos to finish their listing for web display
	* email creators with successful calendar requests
	* email creators with calendar conflicts

### Documentation
	* for team members and lin

### Deployment
	* test on local, bug fixes
	* migrate to production db
	* install and troubleshoot plugin in the middle of the week
