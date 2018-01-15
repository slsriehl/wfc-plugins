var gulp = require('gulp');
var sass = require('gulp-sass');
var php = require('gulp-connect-php');
var browserSync = require('browser-sync').create();
var header = require('gulp-header');
var cleanCSS = require('gulp-clean-css');
var rename = require('gulp-rename');
var concat = require('gulp-concat');
// var uglify = require('gulp-uglify');

// Set the banner content
var banner = ['/*!\n',
		' * Wildflower Church Events Plugin - 1.0 - wildflowerchurch.org\n\n',
		' * MIT License\n',
		' * Copyright 2017-' + (new Date()).getFullYear(), ' Sarah Schieffer Riehl and Liam Langert \n',
		' * Permission is hereby granted, free of charge, to any person obtaining a copy\n',
		' * of this software and associated documentation files (the "Software"), to deal\n',
		' * in the Software without restriction, including without limitation the rights\n',
		' * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell\n',
		' * copies of the Software, and to permit persons to whom the Software is\n',
		' * furnished to do so, subject to the following conditions:\n\n',
		' * The above copyright notice and this permission notice shall be included in all\n',
		' * copies or substantial portions of the Software.\n\n',
		' * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR\n',
		' * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,\n',
		' * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE\n',
		' * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER\n',
		' * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,\n',
		' * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE\n',
		' * SOFTWARE.\n',
		' */\n'
].join('');


//create a php development server
gulp.task('php', function() {
	php.server({
		base: './',
		port: 8010,
		keepalive: true
	});
});

//connect the php development server to browser-sync which allows automatic page reloading
gulp.task('browser-sync',['php'], function() {
	browserSync.init({
		proxy: '127.0.0.1:8010',
		port: 8080,
		open: true,
		notify: false
	});
});


var reload  = browserSync.reload;

// Compile & concatenate scss files from /scss into /css
gulp.task('compile-concat-scss', function() {
	return gulp.src('./src/scss/*.scss')
		.pipe(sass())
		.pipe(header(banner))
		.pipe(concat('styles.css'))
		.pipe(gulp.dest('./assets/css'))
});

// gulp.task('minify-css', function() {
// 	return gulp.src('./src/css/*.css')
// 	.pipe(cleanCSS({ compatibility: 'ie8'}))
// 	.pipe(rename({ suffix: '.min'}))
// 	.pipe(gulp.dest('./public/css'))
// });

// concat js files
gulp.task('concat-js', function() {
	return gulp.src('./src/js/*.js')
		.pipe(concat('index.js'))
		.pipe(header(banner))
		.pipe(gulp.dest('./assets/js'))
});

//minify js
// gulp.task('minify-js', function() {
// 	return gulp.src('./src/js/*.js')
// 		.pipe(uglify())
// 		.pipe(rename({ suffix: '.min' }))
// 		.pipe(gulp.dest('./public/js'))
// });

// dev task to compile and reload in development
gulp.task('dev', ['browser-sync', 'compile-concat-scss', 'concat-js'], function() {
		gulp.watch('./src/scss/*.scss', ['compile-concat-scss', reload]);
		gulp.watch('./src/js/*.js', ['concat-js', reload]);
		// Reloads the browser whenever PHP, CSS, or JS files change
		gulp.watch('./*.php', [reload]);
		gulp.watch('./php/*.php', [reload]);
		gulp.watch('./php/*/*.php', [reload]);
		gulp.watch('./assets/css/*.css', [reload]);
		gulp.watch('./assets/js/*.js', [reload]);
});
