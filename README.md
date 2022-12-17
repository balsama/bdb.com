# Big Day Birding Boston
Drupal codebase for https://bigdayboston.com

@see https://twitter.com/bigdayboston
## Quickstart
Prequisites:
1. PHP 8.1

The following will install a development version of the site with no content using sqlite.
1. `git clone git@github.com:balsama/bdb.com.git && cd bdb.com`
2. `composer install`
3. `composer quickstart`
4. `drush run:server`

## Secrets
A script (`./scrips/create-keys-files.php`) is called on `composer install` which will create dummy keys files in the
`./keys` directory for all the secrets required by the site. You will need to add actual values to those files. The Key
module  and the required configuration to use the values contained in those files is automatically included. You may
optionally store the values in environment variables. The names of the environment variables should match the name of the file.

Files in the `./keys` directory are automatically excluded from Git.

![Big Day Boston](web/themes/icons/logo-circle.png)
