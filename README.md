<p>Bu laravel projesinde bir e-ticaret sitesi hazırlandı. Ancak müşteri isteği üzerine online ödeme alt yapısı yerine, 
elden taksit oluşturulacak şekilde sistem alt yapısı kuruldu.</p>

<p>
    Proje kurulumu sonrası veritabanı bağlantı ayarları için .env dosyasını aşağıdaki gibi düzenleyin:

    DB_CONNECTION=mysql 
    DB_HOST=127.0.0.1 
    DB_PORT=3306 
    DB_DATABASE=db_name 
    DB_USERNAME=root 
    DB_PASSWORD=

    
    Kurulum Talimatları Proje dosyasını indirip çalışma ortamınıza alın. Gerekli bağımlılıkları yüklemek için aşağıdaki komutu çalıştırın: composer install env dosyası oluşturun ve php artisan key:generate
</p>
