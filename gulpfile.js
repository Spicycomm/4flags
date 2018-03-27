var gulp = require("gulp"),
	sass = require("gulp-sass"),
	watch = require("gulp-watch"),
	imagemin = require("gulp-imagemin"),
	compressor = require('gulp-compressor'),
	tinify = require('gulp-tinyimg'),
    htmlmin = require('gulp-htmlmin');



gulp.task("copy", function(){
	gulp.src("sass/**/*")
		 .pipe(gulp.dest("dist/sass"));

	gulp.src("css/**/*")
		 .pipe(gulp.dest("dist/css"));

    gulp.src("*.php")
        .pipe(gulp.dest("dist"));
});


// task para o sass
gulp.task('sass', function() {
    return gulp.src('sass/**/*.sass')
        .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
        .pipe(gulp.dest('css'));
});

// task para watch
gulp.task('watch', function(){
	gulp.watch('sass/**/*.sass', ['sass']);
});



// html compressor
gulp.task('html', function () {
    gulp.src('teste.html')
        .pipe(compressor({
            'remove-intertag-spaces': true,
            'simple-bool-attr': true,
            'compress-js': true,
            'compress-css': true
        }))
        .pipe(gulp.dest('dist/*.html'));
});

gulp.task('tinify', function() {
    gulp.src('images/**/*')
        .pipe(tinify('ESt4Lp-DU-6NapYC2rfyJGWlGOqfDEQt'))
        .pipe(gulp.dest('dist/images'));
});

gulp.task("build-img", function() {

	gulp.src("images/**/*")
		.pipe(imagemin())
		.pipe(gulp.dest("dist/images"));
}); 


gulp.task('minify', function() {
  gulp.src('pages/**/*.php')
    .pipe(htmlmin({collapseWhitespace: true}))
    .pipe(gulp.dest('dist/pages'));

 gulp.src('index.php')
    .pipe(htmlmin({collapseWhitespace: true}))
    .pipe(gulp.dest('dist'));
});