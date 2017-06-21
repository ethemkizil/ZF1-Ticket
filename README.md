
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



**Neler Yaptım ?**

Öncelikle ZF1 için gerekli minimal dosyaları indirdim. Windows için zend/bin için path tanımlama yaptım, zf tools u kullanabilmek için. Zf tools kullanmak istedim yii ve laravel içinde benzer tool yapıları vardı.

**&quot;Zf create project&quot;** ile proje iskeletini oluşturdum. Library dosyalarını kopyalamadı elle ben kopyaladım proje klasörüne.

Başlangıçta yapılabilecek manipülasyonlar için bootstrap dosyası oluşturdum ve konfigirasyonlarını yaptım.

**&quot;zf enable layout&quot;** ile layout oluşturdum, genelde hep layout lu çalıştığım için dökmanlarda vardı yapmak istedim.

**Ara Not:** Php unit test&#39;le ilgili bir hata veriyordu onu engellemek için &quot;D:\Project Files\Php\zend\library\Zend\Test\PHPUnit\ControllerTestCase.php on line 48&quot; da require komutu ekledim, mutlaka başka bir nedeni vardır ama normalde library de değişiklik yapmak huyum değildir hatayı geçmek yapmak zorunda kaldım.

**Veri tabanı işlemleri:**
Hızlı ilerlemek adına Sqlite kullandım, zaten dökümanlar da da sqlite kullanılmış, sonradan mysql e çevirecem.
&quot;Zf configure db-adapter&quot; ile db bilgilerimi set ettim. Application.ini ye yazıyor.

Proje ana dizinine yeniden yazılabilir &quot;data&quot; klasörü oluşturdum, scripts klasörüne veritabanı tablo ve data sql dosylarını oluşturdum. Load için bi örnek php dosyası vardı onu olduğu gibi copy paste yaparak kullandım db oluştursun diye.

**&quot;php scripts/load.sqlite.php –withdata&quot;** komutu ile db create işlemini halletmiş oldum.

**&quot;zf create db-table Ticket ticket&quot;** komutu ile ticket tablom için bir db model oluşturdum.

Sonrasında referans dökümanları baz alarak bir Models altına **Ticket.php** ve **TicketMapper.php** ---dosyalarını oluşturdum.

_Buradaki mantık biraz javaya benzemiş biz laravelde veya yii frameworkte bu kadar kastırmıyorduk (get,set mevzuları) modeli extend edip fw nin kendinden yararlanıyorduk. Lazım olursa inherit fonksiyon kullanıyorduk._

**&quot;zf create controller Ticket&quot;** komutuyla controller oluşturdum.

Action index için ticketları çekip view e gönderilmek üzere tickets diye bir değişkene gönderdim. View kodunda kayıtlı ticketlerı listeledim_. Burada iyi görüntsün diye layout dosyama bootstrap css cdn lerini ekledim._

&quot;zf create form Ticket&quot; ile ticket eklemek üzere bir form oluşturdum. Bu formda validation ve form nesnelerini ayarladım. Gene belirtlemeden edemeyeceğim, burdaki validationları biz modelde yapıyorduk.

&quot;zf create action add Ticket&quot; ile ekleme action u oluşturdum, elle yazsam daha kolay aslında ama zf-tools u kullanmak istediğimden buna devam ettim.

Kayıtları silmek için delete fonksiyonu ekledim, işlem sonucunda bilgi amaçlı flashmessage ekledim, satır numarası kayıt bulunamadı mesaj vs..

Tüm bunları yaparken &quot;https://framework.zend.com/manual/1.12/en/learning.quickstart.html&quot; bağlantısındaki adımları izledim.



**Neler eksik, Neler yapılabilir?**

Tabiki login ekranı ve Authentication olmalı, kullanıcı yetkileri vs.

Ticket düzenleme eklenebilir,

Ticketın gönderildiği ve ticket ı giren kullanıcı bilgisinin tutulması ve gösterilmesi

Ticket listesinde sayfalama ve arama yapılabilme

Ticket açıkmı kapalımı bu tarz bir durum bilgisi olabilir.

Restful için basic auth ekleneilir.

_Zaman buldukça bunları ekleyemeye çalışacam._

