axipi
======

####with bower

```
composer install
bin/console doctrine:fixtures:load --append --fixtures="src/Axipi/CoreBundle/DataFixtures"
bower install
```

####with npm

```
composer install
bin/console doctrine:fixtures:load --append --fixtures="src/Axipi/CoreBundle/DataFixtures"
npm install
cd web/ && ln -s ../node_modules/ vendor
```


http://example.com/backend
- Email: example@example.com
- Password: example
