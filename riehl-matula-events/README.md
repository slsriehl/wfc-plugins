# Liam's Development Branch Focusing on Front-End Assets

## Initial Language Installation and Setup

1. We're going to use several package managers to install software in this process.  The first is Homebrew, billed as the "missing package manager" for Mac.  It's a collection of languages and tools that don't come in xcode.  You don't install the whole thing, only the parts that you need. Go to (https://brew.sh/)[https://brew.sh/], read up, and run the script they give you there in Terminal.

1. Once Homebrew is installed, we need node and php5.6.  For node, run:

        ```bash
				brew install node
				```

1. For php5.6, we need to tell brew to access a list of php formulae.  So, one at a time, run:

        ```bash
				brew tap homebrew/php
				brew install php56
				brew services start homebrew/php/php56
				```

1. Learn more about maintaining your Homebrew installation: read up on the commands ```brew list, brew update, brew upgrade, brew doctor```.

## Project setup

1. I've setup a separate "branch" in git for you to work on without worrying about affecting the rest of the files in the project.  First, copy any files with changes that you've already made and want to keep somewhere else (desktop is fine).  ```cd``` into ```riehl-matula-events``` and run ```git reset --hard```, then ```git pull```.  Since I've already created the branch and added some things that you need, this will put them on your local copy of the repo.  Once that's done, switch to your branch by running ```git checkout liam```.  Run ```git status``` to make sure you're on the branch liam.  Don't reintroduce the files on the desktop yet.

1. Now we're going to use node to setup gulp, a "task runner" that will combine your separate js files into one, run a php development server to serve the html, and automatically rerun the js task & reload the page each time you change a file.  Node uses its own package manager, called npm.  It's automatically installed when you install node.  Read more about npm at (https://npmjs.com/)[https://npmjs.com/].  There's another package manager for node called yarn, but we're not using it on this project.  I've already created an npm project in ```riehl-matula-events```.  The blueprint that tells node what to download to install the packages we need is in the ```package.json``` file.  Take a look.  To install the packages, run ```npm install```.  You'll get some warnings, but the installations should work.  Let me know if they don't.  To check out exactly what gulp is doing for us, take a look at ```gulpfile.js```.  This file is javascript using the libraries required at the top of the file.

1.  You should develop by changing/creating files in ```src/js``` and ```src/scss```.  You can make any number of files and they'll all be combined and appear in ```assets```, where they're linked to from ```index.php```.  The php file that's being served is ```index.php``` in the root of ```riehl-matula-events```.  I moved it from ```php/presentation/create.php``` to make things easier on the development server.  Feel free to change this file as well (you'll need to, to work on it.)

1.  Moment of truth!  To start the server and run the other gulp.watch tasks, run ```npm run dev``` (this command is configured in the "scripts" section of ```package.json```).  Check to see if the browser pops up with the contents of index.php; and the files styles.css and index.js are created in their respective assets subdirectories.  Check the Chrome developer tools on the page that opened (cmd + alt + i) and make sure the "sources" tab includes the assets folder.  If it's all good, re-add the work you already did from the desktop to the src folder.  If you have problems, work them out with google or slack me.

## Git

1.  Git keeps a complete version history and you can revert back to a previous commit at any time.  Don't be afraid to break anything or take chances in your code -- if you're going to go out on a limb, make sure you commit before you start reaching, and everything will be fine.

1.  When you want to commit, here's the flow again:
        ```bash
				git status
				git add src/ready.js (or git add -A to add everything that showed up in git status)
				git commit -m "message"
				git status (make sure the stage is clear)
				git pull (resolve conflicts)
				git push origin liam (origin is the name of the github copy of the code, called a remote.  liam is the name of your branch)
				```
## Reading topics

More reading topics if you have spare screen time:

1. git stash, git reset, git branch, git log, git checkout (a commit vs a branch).  Custom git commands.  These are great basics for managing code repositories in any language.  

1. For this project: More about WordPress, more about JavaScript (ES5 vs ES6+), more about HTML & CSS.  And if you're interested in tackling some back-end facets of this project, read up on php.  You could also do some reading on SQL architecture and SQL language.  We are using MySQL on this project.  Personally I think data stores are really interesting.  

1. General web development interest: Learn about Sass/scss and LESS.  There are some exciting and complex new front-end frameworks, like React and Angular 2.  Another front-end topic is current trends in task runners and bundlers (the new hotness is Webpack).  

One way to get around the screen time constraints is to see if your parents will buy you paper books on the things that really catch your interest :).
