var gulp = require('gulp');
var pkg = require('./package.json');

// include plug-ins
var replace = require('gulp-replace-task');
var shell = require('gulp-shell');


// run codesniffer
gulp.task('sniffs', sniffs);

function sniffs(done) {

    return gulp.src('.', {read:false})
        .pipe(shell(['./.sniff']));

}


// Update plugin version
gulp.task('version', version);

function version(done) {

	gulp.src('./uri-gtm-injector.php')
		.pipe(replace({
			patterns: [{
				match: /Version:\s([^\n\r]*)/,
				replace: 'Version: ' + pkg.version
			}]
		}))
		.pipe(gulp.dest('./'));

}


// watch
gulp.task('watcher', watcher);

function watcher(done) {

	// watch for PHP change
    gulp.watch('./**/*.php', sniffs);

	done();
}

gulp.task( 'default',
	gulp.parallel('sniffs', 'version', 'watcher', function(done){
		done();
	})
);


function done() {
	console.log('done');
}
