Музичний архів — PHP/MySQL сайт для Іванків Вадим, група П-31

Логін до адмін-панелі:
login: admin
password: 123

Запуск через XAMPP:
1. Скопіюйте папку MusicArchive_Ivankiv у C:\xampp\htdocs\musicarchive.local
2. Запустіть Apache та MySQL у XAMPP Control Panel.
3. Відкрийте phpMyAdmin та імпортуйте файл database/music_archive.sql.
4. Відкрийте у браузері: http://localhost/musicarchive.local/
5. Адмін-панель: http://localhost/musicarchive.local/login/

Швидкий запуск без налаштування MySQL:
1. Встановіть PHP або використайте PHP з XAMPP.
2. Запустіть файл run_local_php.bat.
3. Відкриється http://127.0.0.1:8000/

Якщо база даних MySQL ще не імпортована, сайт автоматично використовує резервне JSON-сховище data/storage.json.
