# OmniScript source

OmniScript is both a language, a framework and an environment for dynamically
developing complete web applications. It adapts to scripting language
such as Perl, PHP, Python, Ruby and JavaScript (using Node).

An example to see how the code works :


The ```OmniScript``` code

```OmniScript
<html>
[lang="fr"]
{color:red;}
(
    <head>
    (
        <meta>[charset="UTF-8"]
        <title>(OmniScript source)
    )
    <body>
    (
        <p>[id="main-content"]{color:blue}(Welcome to OmniScript !)
    )
)
```


The equivalent ```HTML5``` code

```html
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8"/>
        <title>OmniScript source</title>
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
        <p>Welcome to OmniScript !</p>
    </body>
</html>
```


The equivalent ```PHP5``` code

```php
<?php use OmniScript\Document;
require 'vendor/autoload.php';
$document = new Document('html', 5);
$document->setAttribute('lang', 'fr');
$document->setProperty('color', 'red');
$document->head->meta->charset = 'UTF-8';
$document->title = 'Welcome to OmniScript !';
$p = $document->createElement('p');
$p->setAttribute('id', 'main-content');
$p->setProperty('color', 'red');
$p->setContent('Welcome to OmniScript !');
$document->prepend($p, $body);
$document->save();
```