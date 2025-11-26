# coachtechフリマアプリ

## 環境構築

### Dockerビルド
1. git clone git@github.com:aika-nag/coachtechflema.git
2. docker-compose up -d --build

※MySQLは、OSによって起動しない場合があるのでそれぞれのPCに合わせてdocker-compose.ymlファイルを編集してください。

### Laravel環境構築
1. docker-compose exec php bash
2. composer install
3. .env.exampleファイルから.envを作成し、環境変数を変更  
   (DB項目の他に、MAIL_FROM_ADDRESSにもメールアドレスを設定してください）  
   例）MAIL_FROM_ADDRESS = "hello@example.com"  
5. php artisan key:generate
6. php artisan migrate
7. php artisan db:seed
8. php artisan storage:link<br>
   ダミーの商品画像は　public/images　の中にdammy1~10まで入れています。<br>
   商品画像が表示されなくなった時は上記画像をstorage/app/public/images　に入れ直してください。

## 使用技術（実行環境）
- PHP8.4.1
- JavaScript
- Laravel8.83.8
- MySQL8.0.26
- nginx1.21.1
- mailhog1.0.1

## ER図
![ER図](flema.drawio.png)

## URL
- 開発環境： http://localhost/
- ユーザー登録： http://localhost/register
- phpMyAdmin: http://localhost:8080/
- mailhog: http://localhost:8025/

