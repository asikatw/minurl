# Formosa Framework Starter

This is Formosa starter package.

Formosa is a starter package of [Windwalker Framework](https://github.com/ventoviro/windwalker).

## Installation Via Composer

``` bash
$ php composer.phar create-project asika/formosa formosa 1.0.*
```

## Getting Started

Copy `etc/config.dist.yml`  to `etc/config.yml` and fill database information.

Open `http://{Your project root}/www`, you will see sample page.

![img](https://cloud.githubusercontent.com/assets/1639206/3625389/aaae9026-0e6a-11e4-8ebb-f8ba2708072d.png)

Click `Cover` menu item, then you will see another page.

![acme_cover](https://cloud.githubusercontent.com/assets/1639206/3625447/c687c91a-0e6b-11e4-8f32-523658ea3d4f.png)

The DB data not import yet. Please run this command:

``` bash
$ php bin/phinx status
```

This is our migration schema.

![img](https://cloud.githubusercontent.com/assets/1639206/3625411/0616062e-0e6b-11e4-87c6-500532b70525.png)

Just run:

``` bash
$ php bin/phinx migrate
```

The DB will auto import.

![img](https://cloud.githubusercontent.com/assets/1639206/3625419/395a4d92-0e6b-11e4-8536-49642b651c48.png)

This is the result page:

![img](https://cloud.githubusercontent.com/assets/1639206/3625396/d35b85ec-0e6a-11e4-80e0-3a75cc3daee1.png)
