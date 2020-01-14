const {src, dest, parallel, series} = require('gulp');
const csso = require('gulp-csso');
const uglify = require('gulp-uglify');
const clean = require('gulp-clean');
const zip = require('gulp-zip');
const extensionName = require('path').basename(__dirname);
const extensionPath = '../../extensions/' + extensionName;
// const envProductionPath = '../../env-production/' + extensionName;

function cleanDist() {
	return src('dist', {allowEmpty: true})
		.pipe(clean());
}

function cleanExtension() {
	return src(extensionPath, {allowEmpty: true})
		.pipe(clean({force: true}));
}

function cleanTmp() {
	return src('tmp', {allowEmpty: true})
		.pipe(clean());
}

function copyToTmp() {
	return src('dist/**/*')
		.pipe(dest('tmp/' + extensionName));
}

function copyToDist() {
	return src('src/**/*')
		.pipe(dest('dist'));
}

function createZip() {
	const fileContent = require('fs').readFileSync('dist/extension.xml', {encoding: 'utf8'}).toString();
	const matches = fileContent.match('<version>(\\d.\\d.\\d)</version>');
	const version = matches[1] ? matches[1] : '0.0.0';

	return src('tmp/**/*')
		.pipe(zip(extensionName + '-' + version + '.zip'))
		.pipe(dest('artifacts'));
}

function installToExtensions() {
	return src('dist/**/*')
		.pipe(dest(extensionPath));
}

exports.zip = series(cleanTmp, copyToTmp, createZip, cleanTmp);
exports.build = series(cleanDist, copyToDist);
exports.install = series(cleanExtension, installToExtensions);
exports.default = series(exports.build, exports.install);