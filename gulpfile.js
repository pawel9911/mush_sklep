const {task, src, dest, watch, parallel} = require("gulp");
const babel = require("gulp-babel");
const sass = require("gulp-sass")(require("sass"));
const cssnano = require("gulp-cssnano");
const autoprefixer = require("gulp-autoprefixer");
const sourcemaps = require("gulp-sourcemaps");
const concat = require("gulp-concat");
const minify = require("gulp-minify");
const rename = require("gulp-rename");

task("scss:build", () => {
  return src("./assets/src/scss/style.scss")
    .pipe(sourcemaps.init())
    .pipe(sass({outputStyle: "expanded"}).on("error", sass.logError))
    .pipe(autoprefixer())
    .pipe(cssnano())
    .pipe(sourcemaps.write())
    .pipe(rename("main.min.css"))
    .pipe(dest("./assets/build"));
});

task("scss:watch", () => {
  watch("./assets/src/scss/**/*.scss", parallel("scss:build"));
});

task("js:build", () => {
  return src(["./assets/src/js/app.js"])
    .pipe(babel({presets: ["@babel/env"]}))
    .pipe(concat("main.js"))
    .pipe(minify({ext: {src: "", min: ".min.js"}, noSource: true}))
    .pipe(dest("./assets/build"));
});

task("js:watch", () => {
  watch("./assets/src/js/**/*.js", parallel("js:build"));
});

task("watch", parallel("js:watch", "scss:watch"));

task("default", parallel("js:build", "scss:build"));
