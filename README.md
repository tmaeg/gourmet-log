## セットアップ
### Windows + VSCode + Dev Containerの場合
任意のフォルダで
```
https://github.com/tmaeg/gourmet-log.git
```
```
cd gourmet-log
```
```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
```
```
cp .env.example .env
```
```
code .
```
VSCodeが開いたら「Reopen in Container」<br>
詰まったらコンテナとボリュームを消して開きなおす<br>
<br>
以下、VSCode上のコンソールで<br>
```
php artisan key:generate
```
```
npm install
```
```
php artisan migrate
```
```
php artisan db:seed
```
```
npm run dev
```
migrateは1回でうまくいかないことがある<br>
最後にlocalhostにアクセス
