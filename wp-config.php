<?php
/**
 * WordPress の基本設定
 *
 * このファイルは、インストール時に wp-config.php 作成ウィザードが利用します。
 * ウィザードを介さずにこのファイルを "wp-config.php" という名前でコピーして
 * 直接編集して値を入力してもかまいません。
 *
 * このファイルは、以下の設定を含みます。
 *
 * * MySQL 設定
 * * 秘密鍵
 * * データベーステーブル接頭辞
 * * ABSPATH
 *
 * @link https://ja.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// 注意:
// Windows の "メモ帳" でこのファイルを編集しないでください !
// 問題なく使えるテキストエディタ
// (http://wpdocs.osdn.jp/%E7%94%A8%E8%AA%9E%E9%9B%86#.E3.83.86.E3.82.AD.E3.82.B9.E3.83.88.E3.82.A8.E3.83.87.E3.82.A3.E3.82.BF 参照)
// を使用し、必ず UTF-8 の BOM なし (UTF-8N) で保存してください。

// ** MySQL 設定 - この情報はホスティング先から入手してください。 ** //
/** WordPress のためのデータベース名 */
define( 'DB_NAME', 'wp3db' );

/** MySQL データベースのユーザー名 */
define( 'DB_USER', 'wp3user' );

/** MySQL データベースのパスワード */
define( 'DB_PASSWORD', 'wp3pass' );

/** MySQL のホスト名 */
define( 'DB_HOST', 'localhost' );

/** データベースのテーブルを作成する際のデータベースの文字セット */
define( 'DB_CHARSET', 'utf8mb4' );

/** データベースの照合順序 (ほとんどの場合変更する必要はありません) */
define( 'DB_COLLATE', '' );

/**#@+
 * 認証用ユニークキー
 *
 * それぞれを異なるユニーク (一意) な文字列に変更してください。
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org の秘密鍵サービス} で自動生成することもできます。
 * 後でいつでも変更して、既存のすべての cookie を無効にできます。これにより、すべてのユーザーを強制的に再ログインさせることになります。
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '?nytKD5gRLmk.9z%YN)-m*Z7rCVh:#3IP;8st,AI4YNm{4X|BvoYj2*R|!kRZL}h' );
define( 'SECURE_AUTH_KEY',  'K|pDdIp)8+uxIcT>%UBk~pDIn|6AM&<%o^@2P>MUcm@err;0#*Q{tZ7[3W6x}x>n' );
define( 'LOGGED_IN_KEY',    'KCL#<Dv>`Nz$,lqy]{^,!q}x!B1;u,2$6wq!GKEZ1]x&KoqC)cPA5(wWoiKLC!^(' );
define( 'NONCE_KEY',        '5Q|iM5;,:HXjb WBoRz;nY:O-U^iXZw39R^|q4HHzGde}vn|iE0 !E^?:<SfK]$K' );
define( 'AUTH_SALT',        '1c[pC?]-t(I4/,d#k_{3X+s[_Qo0<t }lUk}2*t%j``1- (8O_IB/a6s6zb%v1;<' );
define( 'SECURE_AUTH_SALT', '9rwv- TR!NRQ-MI5[];},*l2o;eKF%RFK<OC_bdsE:vC8iT+bg`By><RDX9q:A&%' );
define( 'LOGGED_IN_SALT',   'wBuh4*jflu9q}WpP4q,nT<1lZpNA{3|M%pn+39jkjV~mSY0Sn6H)tZ+rS=36R6}W' );
define( 'NONCE_SALT',       '*%{Jq~<L0?(Vc3#PQ8o80:C|VZh415D&9TR:|u+S~Z{`y($=`yd*obZgmU5yHi}P' );

/**#@-*/

/**
 * WordPress データベーステーブルの接頭辞
 *
 * それぞれにユニーク (一意) な接頭辞を与えることで一つのデータベースに複数の WordPress を
 * インストールすることができます。半角英数字と下線のみを使用してください。
 */
$table_prefix = 'wp_';

/**
 * 開発者へ: WordPress デバッグモード
 *
 * この値を true にすると、開発中に注意 (notice) を表示します。
 * テーマおよびプラグインの開発者には、その開発環境においてこの WP_DEBUG を使用することを強く推奨します。
 *
 * その他のデバッグに利用できる定数についてはドキュメンテーションをご覧ください。
 *
 * @link https://ja.wordpress.org/support/article/debugging-in-wordpress/
 */

// ログイン画面でエラー表示されてる場合、falseをtrueにしてエラー部分を探す。
define( 'WP_DEBUG', false );

/* 編集が必要なのはここまでです ! WordPress でのパブリッシングをお楽しみください。 */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';