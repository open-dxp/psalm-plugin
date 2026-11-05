# OpenDXP Psalm Plugin

Psalm follows untrusted input, such as a request parameter, through the code and reports where it
reaches a sink: a place where it is run as SQL, unserialized or written into HTML. Psalm knows the
sinks of PHP, and plugins add those of a framework. This plugin adds the sinks of OpenDXP.

```bash
composer require --dev open-dxp/psalm-plugin
vendor/bin/psalm-plugin enable open-dxp/psalm-plugin
```

A Symfony application needs [psalm/plugin-symfony](https://github.com/psalm/psalm-plugin-symfony) as
well. Without it, Psalm does not know that a request carries untrusted input.

## Sinks

| Method                                                 | Takes          |
|--------------------------------------------------------|----------------|
| `setCondition()` and `addConditionParam()` of listings | SQL            |
| `OpenDxp\Tool\Serialize::unserialize()`                | serialized PHP |
| The query methods of `Db::get()`                       | SQL            |
| `where()` and `having()` of the DBAL query builder     | SQL            |

[weirdan/doctrine-psalm-plugin](https://github.com/psalm/psalm-plugin-doctrine) declares
`executeStatement()` and a few other methods of DBAL. This plugin declares the rest, such as
`fetchAllAssociative()` and `executeQuery()`.

A value bound as a parameter never reaches the SQL, so Psalm reports nothing for it:

```php
$listing->setCondition('id = ?', [$request->query->get('id')]);
```

## Run the taint analysis in CI

The [OpenDXP workflows](https://github.com/open-dxp/workflows-collection-public) run the analysis
with this plugin for a bundle or a project.
