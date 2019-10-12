<h1 align="center"> 省市区搜索扩展包 </h1>

<p align="center"> 基于laravel的省市区搜索扩展包，最新的省市区数据库，可以方便快速的进行省市区相关查询。</p>

## 框架要求
Laravel >= 5.1


## 安装

```shell
composer require dreamxzr/province-search -vvv
```
## 配置

1.在 config/app.php 注册 ServiceProvider 和 Facade (Laravel 5.5 + 无需手动注册)

```shell
'providers' => [
    // ...
    Dreamxzr\ProvinceSearch\ServiceProvider::class,
],
'aliases' => [
    // ...
    'ProvinceSearch' => Dreamxzr\ProvinceSearch\Facade::class,
],
```
发布数据库文件

```shell
php artisan vendor:publish --provider="Dreamxzr\ProvinceSearch\ServiceProvider"

php artisan migrate
```
## 使用

TODO



## License

MIT