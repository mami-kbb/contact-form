# お問い合わせフォーム

## 環境構築
Dockerビルド
　1.git clone git@github.com:mami-kbb/contact-form.git
  2.docker-compose uo -d --build
  *MySQLはOSによって起動しない場合があるので、どれぞれのPCに合わせて docker-compose.yml ファイルを編集してください。

## Laravel環境構築
 1.docker-compose exec php bash
 2.composer install
 3..env.exampleファイルから.envファイルを作成し、環境変数を変更
 4.php artisan key:generate
 5.php artisan migrate
 6.php artisan db:seed

 ## 使用技術(実行環境)
 ・nginx:1.21.1
 ・PHP:8.1-fpm
 ・Laravel
 ・MySQL:8.0.26
 ・phpmyadmin/phpmyadmin
 
## ER図
 
## URL
・開発環境：http://localhost/
・phpMyAdminhttp:/localhost:8080/
 
