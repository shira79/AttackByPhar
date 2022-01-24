# 概要

Pharを使った安全でないでシリアライゼーションのデモ

# 環境設定

php8未満ではPharを使用した安全でないデシリアライゼーションは成立しない。
https://wiki.php.net/rfc/phar_stop_autoloading_metadata

dockerfileにて、phpiniに`phar.readonly=off`を追記している。
この設定をすることで、pharファイルを生成できるようになる。

```
# build
docker build --tag php-phar .

# run
docker run --rm -p 8000:80 -v `pwd`/src:/var/www/html php-phar

# exec
docker exec -it コンテナ名 bash
```

# 攻撃手順
## Pharを生成
コンテナの中で`php phar/generate.php` を実行すると`exploit.phar`というファイルが生成される。

## Pharをアップロードする
`http://localhost:8000/`からファイルをuploadする

## アップロードしたPharを参照する

`http://localhost:8000/file_get_contents.php?filepath=phar://uploads/exploit.phar/hoge.txt`にアクセス

すると、`Logs/sample.log`に`hacked!!!!!!`という文字列が書き込まれている。
