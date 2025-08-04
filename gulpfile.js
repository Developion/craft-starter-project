import gulp from 'gulp'
import postcss from 'gulp-postcss'
import shell from 'gulp-shell'
import sourcemaps from 'gulp-sourcemaps'
import postcssNested from 'postcss-nested'
import autoprefixer from 'autoprefixer'
import postcssImport from 'postcss-import'
import postcssMixins from 'postcss-mixins'
import cleanCSS from 'gulp-clean-css'
const { src, dest, series, task, parallel, watch } = gulp

const config = (file) => ({
	plugins: [
		postcssImport({ root: '.src/front/css *' }),
		postcssMixins(),
		postcssNested(),
		autoprefixer()
	]
});

task('dev:css', () => {
	return src('src/front/css/**/**/*.css')
		.pipe(sourcemaps.init())
		.pipe(postcss(config))
		.pipe(sourcemaps.write('.'))
		.pipe(dest('dist/front/public/css'))
})

task('build:css', () => {
	return src('src/front/css/**/*.css')
		.pipe(postcss(config))
		.pipe(postcss([autoprefixer(), postcssNested()]))
		.pipe(dest('dist/front/public/css'))
})

task('build-prod:css', () => {
	return src('src/front/css/**/*.css')
		.pipe(postcss(config))
		.pipe(postcss([autoprefixer(), postcssNested()]))
		.pipe(cleanCSS({debug: true}))
		.pipe(dest('dist/front/public/css'))
})

task("watch:css", () => {
	return watch('src/front/css/**/**/*.css', series(['dev:css']))
})

task('dev:global', () => {
	return src('src/Global/**/**/*.css')
		.pipe(sourcemaps.init())
		.pipe(postcss(config))
		.pipe(sourcemaps.write('.'))
		.pipe(dest('dist/Global/public'))
})

task('build:global', () => {
	return src('src/Global/**/*.css')
		.pipe(postcss(config))
		.pipe(postcss([autoprefixer(), postcssNested()]))
		.pipe(dest('dist/Global/public'))
})

task('build-prod:global', () => {
	return src('src/Global/**/*.css')
		.pipe(postcss(config))
		.pipe(postcss([autoprefixer(), postcssNested()]))
		.pipe(cleanCSS({debug: true}))
		.pipe(dest('dist/Global/public'))
})

task("watch:global", () => {
	return watch('src/Global/**/**/*.css', series(['dev:global']))
})


// task('dev:serve', async () => {
// 	server.init({
// 		files: ["dist/front/public/**/*"],
// 		watchEvents: ["add", "change", "addDir"],
// 		server: "dist/front/public/",
// 		port: 5000,
// 		notify: false
// 	})
// })

task('ts:compile', shell.task('rollup -c rollup.config.mjs'))
task('ts:watch', shell.task('npx rollup --config rollup.config.mjs --config-dev --watch'))
task('dev', parallel(['ts:watch', 'ts:compile', 'watch:css', 'watch:global']))
task('build', series(['ts:compile', 'build:css', 'build:global']))
task('build-prod', series(['ts:compile', 'build-prod:css', 'build-prod:global', shell.task('npx rollup -c rollup.config.mjs')]))