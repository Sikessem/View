# Omni

Omni is both a language, a framework and an environment for dynamically
developing complete web applications. It adapts to scripting language
such as Perl, PHP, Python, Ruby and JavaScript (using Node).

```Omni
<html>
[lang="fr"]
{color:red;}
(
    <head>
    (
        <meta>[charset="UTF-8"]
        <title>(DyHy source)
    )
    <body>
    (
        <p>[id="main-content"]{color:blue}(Welcome to DyHy !)
    )
)
```

```html
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8"/>
        <title>Omni source</title>
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
        <p>Welcome to DyHy !</p>
    </body>
</html>
```

```php
<?php use Omni\Document;
require 'vendor/autoload.php';
$document = new Document('html', 5);
$document->setAttribute('lang', 'fr');
$document->setProperty('color', 'red');
$document->head->meta->charset = 'UTF-8';
$document->title = 'Welcome to DyHy !';
$p = $document->createElement('p');
$p->setAttribute('id', 'main-content');
$p->setProperty('color', 'red');
$p->setContent('Welcome to Omni !');
$document->prepend($p, $body);
$document->save();
```
