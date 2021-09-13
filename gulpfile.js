const gulp = require('gulp');
const dist_name = 'low-key-toolbar';

// 配布用ファイル書き出し
gulp.task('root', function () {
	return gulp
		.src([
			'*.php',
			'*.txt',
		])
		.pipe(gulp.dest(dist_name));
});

gulp.task('build-folder', function () {
	return gulp
		.src(['build/**'])
		.pipe(gulp.dest(dist_name + '/build'));
});

gulp.task('admin', function () {
	return gulp
		.src(['admin/**'], { base: 'admin' })
		.pipe(gulp.dest(dist_name + '/admin'));
});

gulp.task('includes', function () {
	return gulp
		.src(['includes/**'], { base: 'includes' })
		.pipe(gulp.dest(dist_name + '/includes'));
});

gulp.task('languages', function () {
	return gulp
		.src(['languages/**'], { base: 'languages' })
		.pipe(gulp.dest(dist_name + '/languages'));
});

gulp.task('src', function () {
	return gulp
		.src(['src/**'], { base: 'src' })
		.pipe(gulp.dest(dist_name + '/src'));
});

// 出力
gulp.task('dist', gulp.series('root', 'build-folder', 'admin', 'includes', 'languages', 'src'));
