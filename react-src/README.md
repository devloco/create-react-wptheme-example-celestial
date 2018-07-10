This project was bootstrapped with [Create React WP Theme](https://github.com/devloco/create-react-wptheme).

To use:

First off, the tutorial author has you make some changes to your WordPress settings.
Quoting the tutorial:

```cmd
Permalinks

For the theme to work correctly, we have to set the following permalinks within:
    -   Dashboard → Settings → Permalinks:

Then
    -   Under Common Settings → Custom Structure: /posts/%postname%/

And if you want to do the wooCommerce part of the tutorial:
    -   Under Product permalinks → Custom base: /products/

If you don’t set the permalinks as above, the theme may not function as desired.
```

Then to get the Celestial theme installed from Github:

```sh
cd /your/wordpress/themes/folder
git clone https://github.com/devloco/create-react-wptheme-example-celestial.git
rename create-react-wptheme-example-celestial celestial
cd celestial
cd react-src

Open package.json in your favorite text editor.
Check the value for "homepage" -- should be relative **URL PATH** (i.e. starting from server root) to your "celestial" theme folder
Check value for "browserLaunchTo" -- should be the full URL to your WordPress server root... the WP site running your celestial theme.

Go to your WordPress Admin area and set "Celestial" as your active theme.

Back at your command prompt, type:

npm start
```

I went through this tutorial:

[How To Build A Skin For Your Web App With React And WordPress](https://www.smashingmagazine.com/2018/03/react-wordpress-web-app/)

...only up to the "posts" part. I haven't yet gotten to the wooCommerce part of the tutorial.

The original Github repo for the Celestial theme is located here: [Celestial WordPress theme](https://github.com/m-muhsin/celestial)
