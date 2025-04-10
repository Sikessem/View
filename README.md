# [<img src="https://github.com/sikessem/art/blob/HEAD/images/logo.svg" alt="Sikessem" height="24" />][sikessem-link]'s' Template Engine

Handle HTML5 and CSS3 easily

[![php-icon]][php-link]
[![packagist-version-icon]][packagist-version-link]
[![packagist-download-icon]][packagist-download-link]
[![license-icon]][license-link]
[![actions-icon]][actions-link]
[![twitter-icon]][twitter-link]

[Read the documentation to learn more][docs-link].

An example to see how the code works :

- The ```View``` code

```view
<html>
[lang="fr"]
{color:red;}
(
    <head>
    (
        <meta>[charset="UTF-8"]
        <title>(View source)
    )
    <body>
    (
        <p>[id="main-content"]{color:blue}(Welcome to View !)
    )
)
```

- The equivalent ```HTML5``` code

```html
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8"/>
        <title>View source</title>
        <style>
        html
        {
            color: red;
        }
        p#main-content
        {
            color: blue;
        }
        </style>
    </head>
    <body>
        <p>Welcome to View !</p>
    </body>
</html>
```

The equivalent ```PHP5``` code

```php
<?php

use Sikessem\View\Document;

$document = new Document('html', 5);
$document->setAttribute('lang', 'fr');
$document->setProperty('color', 'red');
$document->head->meta->charset = 'UTF-8';
$document->title = 'Welcome to View !';
$p = $document->createElement('p');
$p->setAttribute('id', 'main-content');
$p->setProperty('color', 'red');
$p->setContent('Welcome to View !');
$document->prepend($p, $body);
$document->save();
```

***

## 📖 Documentation

The full documentation for the Sikessem View can be found [here][docs-link].

## 👏 Contribution

The main purpose of this repository is to continue evolving Sikessem.
We want to make contributing to this project as easy and transparent as possible,
and we are grateful to the community for contributing bug fixes and improvements.
Read below to learn how you can take part in improving Sikessem.

### [👷 Code of Conduct][conduct-link]

[Sikessem][sikessem-link] has adopted a Code of Conduct that we expect project participants to adhere to.
Please read the [full text][conduct-link] so that you can understand what actions will and will not be tolerated.

### 👥 [Contributing Guide][pr-link]

Read our [**Contributing Guide**][pr-link] to learn about our development process,
how to propose bugfixes and improvements,
and how to build and test your changes to Sikessem.

### 🔒️ Good First Issues

We have a list of [good first issues][gfi] that contain bugs which have a relatively limited scope.
This is a great place to get started, gain experience, and get familiar with our contribution process.

[gfi]: https://github.com/sikessem/view/labels/good%20first%20issue

### 💬 Discussions

Larger discussions and proposals are discussed in [**Sikessem's GitHub discussions**][discuss-link].

## 🔐 Security Reports

If you discover a security vulnerability within [any of Sikessem's projects][sikessem-link],
please email [SIGUI Kessé Emmanuel](https://sigui.ci) at [contact@sigui.ci](mailto:contact@sigui.ci).
All security vulnerabilities will be promptly addressed.

## 📄 License

View is licensed under the  [MIT License](https://opensource.org/licenses/MIT) -
see the [LICENSE][license-link] file for details.

***

<div align="center"><sub>Made with ❤︎ by <a href="https://twitter.com/intent/follow?screen_name=siguici" style="content:url(https://img.shields.io/twitter/follow/siguici.svg?label=@siguici);margin-bottom:-6px">@siguici</a>.</sub></div>

[sikessem-link]: https://github.com/sikessem "Sikessem"

[php-icon]: https://img.shields.io/badge/PHP-8.2-ccc.svg?style=flat&logo=php
[php-link]: https://github.com/sikessem/view/search?l=php "PHP code"

[packagist-version-icon]: https://img.shields.io/packagist/v/sikessem/view
[packagist-version-link]: https://packagist.org/packages/sikessem/view "View Releases"

[packagist-download-icon]: https://img.shields.io/packagist/dt/sikessem/view
[packagist-download-link]: https://packagist.org/packages/sikessem/view "View Downloads"

[actions-icon]: https://github.com/sikessem/view/workflows/CI/badge.svg
[actions-link]: https://github.com/sikessem/view/actions "View status"

[twitter-icon]: https://img.shields.io/twitter/follow/sikessem.svg?label=@SikessemHQ
[twitter-link]: https://twitter.com/intent/follow?screen_name=SikessemHQ "Ping Sikessem"

[license-icon]: https://img.shields.io/badge/license-MIT-blue.svg
[license-link]: https://github.com/sikessem/view/blob/HEAD/LICENSE "View License"

[pr-link]: https://sikessem.github.io/contributions "PRs welcome!"
[conduct-link]: https://sikessem.github.io/code-of-conduct "Sikessem's Code of Conduct"
[discuss-link]: https://github.com/orgs/sikessem/discussions "Sikessem's GitHub discussions"
[docs-link]: https://sikessem.github.io/packages/view "View Documentation"
