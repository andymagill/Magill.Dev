	var gulp = require("gulp");
	var sass = require("gulp-sass");
	var sourcemaps = require('gulp-sourcemaps');
	var rename = require('gulp-rename');
	var concat = require('gulp-concat');
	var uglify = require('gulp-uglify');

	function styles() {
		return (
			gulp
				.src('./scss/styles.scss')
				.pipe(sourcemaps.init())
				.pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
				.pipe(sourcemaps.write('./'))
				.pipe(gulp.dest('./css'))
		);
	}

	function scripts(){
		return (
			gulp
				.src('./js/**/_*.js')
				.pipe(concat('scripts.js'))
				.pipe(gulp.dest('./js/'))
				.pipe(rename('scripts.min.js'))
				.pipe(uglify({compress: { unused: false }}))
				.pipe(gulp.dest('./js/'))
		);
	}

	function watch(){
		gulp.watch(['scss/**/_*.scss', 'scss/styles.scss'], styles);
		gulp.watch('js/**/_*.js',gulp.series(scripts));
	}

	exports.styles = styles;
	exports.scripts = scripts;
	exports.watch = watch;
	exports.default = watch;
