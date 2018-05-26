# WP Starter

My starter theme based on [underscores](https://github.com/automattic/_s).

## 1. Set up the local WordPress site folder

1.  Create local WordPress site.
2.  Delete `wp-content/plugins/hello.php`
3.  Delete `wp-content/themes/twentyfifteen`
4.  Delete `wp-content/themes/twentysixteen`

## 2. Set up the local WordPress theme folder

1.  Download or fork this repo and place it in `example.dev/wp-content/themes/`
2.  In the `wp-content/themes/ll_start/` folder, delete the `.git` folder
3.  In the `wp-content/themes/ll_start/` folder, delete the `.gitignore`

## 3. Rename the local WordPress theme

### How to search and replace

1.  In your finder, rename the `starter` folder to `example`
2.  Open the whole `example` folder in your text editor (I use Sublime Text)
3.  Search for `'ll_start'` and include the single quotations to capture the theme's text domain.
    * Replace with `'example'`.
4.  Search for `ll_start_` to capture all the function names.
    * Replace with `example_`.
5.  Search for `Text Domain: ll_start` in style.css
    * Replace with `'Text Domain: example`.
    * the text domain must match the theme's folder name. This is why we already renamed the folder to `example`.
    * the text domain is used across all functions on the website.
6.  Search for <code>&nbsp;ll_start</code> (with a space before it) to capture DocBlocks.
    * Replace with <code>&nbsp;example</code>.
7.  Search for `ll_start-` to capture prefixed handles.
    * Replace with `example-`.
8.  Search for `Theme URI: http://lucaslemonnier.com` to capture the theme's URL
    * Replace with `Theme URI: http://example.com` (the client or project's URL)
9.  Search for `Description: Custom WordPress theme developed for ll_start` to capture the theme description
    * Replace with `Description: Custom WordPress theme developed for Example by Your Name`

## 4. Set up Gulp for the WordPress theme

1.  In the `wp-content/themes/example/gulpfile.js` file:
    * Search for `ll_start.dev.cc`
    * Replace with `example.dev.cc` (or whatever your local site URL will be)
2.  Type `npm install` or `sudo npm install` to install the Gulp dependencies for our theme
3.  Once the dependancies download, type `gulp default` to test it out

## 5. Set up Git for the WordPress theme

1.  Move `.gitignore-place-in-wp-content` file to `/wp-content/` folder
2.  Rename `.gitignore-place-in-wp-content` to `.gitignore`
3.  Run `git init` from command line
