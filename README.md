# HTML Builder

Write/read HTML documents easily in PHP

An example to see how the code works :


The ```Styper``` code

```Styper
<html>
[lang="fr"]
{color:red;}
(
    <head>
    (
        <meta>[charset="UTF-8"]
        <title>(Styper source)
    )
    <body>
    (
        <p>[id="main-content"]{color:blue}(Welcome to Styper !)
    )
)
```


The equivalent ```HTML5``` code

```html
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8"/>
        <title>Styper source</title>
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
        <p>Welcome to Styper !</p>
    </body>
</html>
```


The equivalent ```PHP5``` code

```php
<?php use Styper\Document;
require 'vendor/autoload.php';
$document = new Document('html', 5);
$document->setAttribute('lang', 'fr');
$document->setProperty('color', 'red');
$document->head->meta->charset = 'UTF-8';
$document->title = 'Welcome to Styper !';
$p = $document->createElement('p');
$p->setAttribute('id', 'main-content');
$p->setProperty('color', 'red');
$p->setContent('Welcome to Styper !');
$document->prepend($p, $body);
$document->save();
```
