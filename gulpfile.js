var gulp = require('gulp');
var phpspec = require('gulp-phpspec');
var notify = require('gulp-notify');

gulp.task('test', function()
{
    gulp.src('spec/**/*.php')
        .pipe(phpspec('', { clear: true, notify: true }))
        .on('error', notify.onError({
            title: 'Failure',
            message: 'Your tests failed'
        }))
        .pipe(notify({
            title: 'Success',
            message: 'All tests have returned green.'
        }));
});

gulp.task('watch', function() {
    gulp.watch(['**/*.php'], ['test']);
});

gulp.task('default', ['test']);