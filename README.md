# A Behat/Mink tests

## Usage 

Clone this repo.
Now install Behat, Mink, MinkExtension and their dependencies with [composer](http://getcomposer.org/):

``` bash
composer install
```

If you want to test `@javascript` part of feature, you'll need to install Selenium.
Selenium gives you ability to run `@javascript` tagged scenarios in real browser.

1. Download latest Selenium2 jar from the [Selenium website](http://seleniumhq.org/download/)
2. Run selenium jar with:

    ``` bash
    java -jar selenium.jar > /dev/null &
    ```

Now to launch Behat, just run:

``` bash
bin/behat
```
