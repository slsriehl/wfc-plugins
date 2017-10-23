# Plugins for wildflowerchurch.org by Sarah Riehl adapted from code by Terry Matula
# copyright 2017

## EVENTS PLUGIN TODOS

### OneBody
* determine extent of tools that would integrate well with

### HTML
* view all room requests
* view one room request - summary
* view one room request - editable
* view all events
* view one event - summary
* edit or delete an event - editable

### Logic  
* finish create event
* ancillary queries and saves
* incorporate google calendar api for space use and all events (save calendar entry id to events db)
* GET view all room requests
* GET view one room request - summary
* GET view one room request - editable
* POST schedule room request
* GET view all events
* GET view one event - summary
* GET edit or delete an event - editable
* POST edit or delete an event (change or add google cal reservations for space use and all events)

### JS, CSS
#### stylesheets
* default WP or bootstrap
* gulp sass
#### js
* self authored jquery, gulp concat

### Migrations
* update based on current save arrays
* get more info for accessibility table
* double check foreign keys
* double check column names against post arrays in events entry and update
* add migration for room requests or sync to OneBody (check with Terry)

### Shortcodes
* events display on events page
* events display (non RE) for front page
* events display (RE) for front page
* events display for RE page
* events HTML generation for weekly email

### init.php

### Notifications
	**OneBody?**
* email Lin for room requests with link to login and view
* email creators with successful room requests and any todos to finish their listing for web display with link to login and view

### Documentation
* for team members and lin

### Deployment
* test on local, bug fixes
* migrate to production db
* install and troubleshoot plugin in the middle of the week
