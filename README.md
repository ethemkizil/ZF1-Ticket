
**Kurulum**

Zendticket isimli klasörü web server dizininize kopyalayın veya github **https://github.com/kipnos/ZF1-Ticket.git** adresinden checkout alabilirsiniz. Yerel dizinden veya herhangi bir domainden siteyi çağırabilirsiniz.

**Veritabanı Ayarları:**
Mysql ve Sqlite ayarları mevcut. Application/configs/application.ini dosyası içerisinden hangi veritabanını kullanmak istersek o veritabanına ait config kısımlarını açıp diğer veritabanınkileri kapatıyoruz veya siliyoruz.

Sqlite veritabanı kullanacaksak kendisi Data/db klasörünün içerisine direkt aşağıdaki kod ile oluşturacaktır.
**&gt; php scripts/load.sqlite.php --withdata**

Mysql kullanacaksak veritabnı açıp bilgilerini application.ini içerisine yazdıktan sonra aşağıdaki kodu çalıştırarak db yi hazırlayacaz.

**&gt; php scripts/load.mysql.php --withdata**

**Dosya İzinleri:**

Data dizinine ve Public/upload/ dizinine chmod 777 veya window için yazma izni veriyoruz.

Bootstrap ve fontawsome için cdn kullandım, internet erişimi olmazsa stiller düzgün çalışmayabilir.

http://localhost/zendticket

