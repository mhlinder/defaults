
This website implements a boilerplate academic conference
website. This project is Markdown- and Pandoc-backed, with typical
conference features like registration pages and abstract submission,
as well as LaTeX rendering with [MathJax](https://www.mathjax.org/).

This uses a wireframe [Skeleton](http://getskeleton.com/), which
resets the stylesheet (`normalize.css`); sets up useful classes
implementing a grid and selects reasonable enough defaults
(`skeleton.css`); and specifies the conference webpage style
(`custom.css`). The colors, font-faces, and other parameters should be
updated prior to deployment.

Colors can be chosen using something
like [coolors.co](https://coolors.co/).

For **abstract submission**, you must run these commands from the web server's root
for the conference:

```
$ cp abstractdata/abstracts_base.csv abstractdata/abstracts.csv
$ mkdir abstractdata/save
```

You should also change the `mailto:` links for the webmaster.

For **conference registration**, symmetric moves are necessary:

```
$ cp regdata/reg_base.csv regdata/reg.csv
```

and change the conference title in `reg*0.php`, which is temporarily
filled by the text `CONFERENCE`; change the date, place-held by
`DATE`; and adjust form layout and details according to the
conference's specific needs. In `regsend0.php`, email addresses must
be changed for notification of registration.

