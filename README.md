# Yii2 Daraja - **HIGHLY EXPERIMENTAL! - DONT USE YET**

==============

Yii2 extension for integrating with Safaricom's Daraja API

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```bash
php composer.phar require --prefer-dist danvick/yii2-daraja "*"
```

or add

```json
"danvick/yii2-daraja": "*"
```

to the `require` section of your `composer.json` file.

To always use the latest version from Github, in your `composer.json`, add this repository to the `repositories` section.

```json
{
  ...
  "repositories": [
    {
      "type": "vcs",
      "url": "https://github.com/danvick/yii2-daraja"
    }
  ],
}
```

## Setup

The extension is used as an application component and configured in the application configuration as such:

```php
'components' => [
    ...
    'daraja' => [
        'class' => Daraja::class,
      
    ],
]
```

You also should configure the extension's commands to use them.

```php
'controllerMap' => [
    
],
```

## Usage
