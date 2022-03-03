# Pharを使った安全でないでシリアライゼーションのデモ

## 概要

Phar Deserializationは、Pharメタデータが展開される際に、デシリアライゼーションが行われることを悪用した脆弱性。

Zennに投稿した説明記事 : [PHPerが知っておきたいPhar Deserializationという脆弱性の話](https://zenn.dev/shlia/articles/9932e906cc58ab)

## 環境設定

PHP8未満ではPharを使用した安全でないデシリアライゼーションは成立しない。
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

## 攻撃手順
### Pharを生成
コンテナの中で`php phar/generate.php` を実行すると`exploit.phar`というファイルが生成される。

### Pharをアップロードする
`http://localhost:8000/`からファイルをuploadする

### アップロードしたPharを参照する

`http://localhost:8000/file_get_contents.php?filepath=phar://uploads/exploit.phar/hoge.txt`にアクセス

すると、`Logs/sample.log`に`hacked!!!!!!`という文字列が書き込まれている。
