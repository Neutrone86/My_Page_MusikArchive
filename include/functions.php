<?php
require_once __DIR__ . '/config.php';

define('STORAGE_FILE', __DIR__ . '/../data/storage.json');

function e($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

function demo_categories() {
    return [
        ['id' => 1, 'name' => 'Альбоми', 'description' => 'Знакові українські та світові музичні альбоми.'],
        ['id' => 2, 'name' => 'Виконавці', 'description' => 'Біографії музикантів, гуртів і композиторів.'],
        ['id' => 3, 'name' => 'Жанри', 'description' => 'Опис популярних музичних напрямів та стилів.'],
        ['id' => 4, 'name' => 'Історія музики', 'description' => 'Події та факти, що вплинули на розвиток музики.'],
    ];
}

function demo_posts() {
    return [
        [
            'id' => 1,
            'header' => 'Легендарний альбом Queen - A Night at the Opera',
            'content' => 'A Night at the Opera вважають одним із найважливіших рок-альбомів 1970-х років. Платівка поєднала арт-рок, хард-рок, поп-музику та елементи опери. Саме тут була представлена композиція Bohemian Rhapsody, яка стала прикладом сміливого студійного експерименту та змінила уявлення про формат рок-синглу.',
            'image' => 'img/queen_night_opera.svg',
            'datatime' => '2026-04-20',
            'category_id' => 1,
            'artist' => 'Queen',
            'release_year' => 1975
        ],
        [
            'id' => 2,
            'header' => 'Скрябін як явище української музичної сцени',
            'content' => 'Гурт Скрябін пройшов шлях від електронної альтернативи до зрозумілого широкій аудиторії поп-року. Пісні Андрія Кузьменка поєднують іронію, просту мову, соціальні теми та щирі особисті історії. У музичному архіві такі записи допомагають простежити розвиток української популярної музики.',
            'image' => 'img/skriabin_kuzma.svg',
            'datatime' => '2026-04-21',
            'category_id' => 2,
            'artist' => 'Скрябін',
            'release_year' => 1989
        ],
        [
            'id' => 3,
            'header' => 'Джаз: імпровізація як основа жанру',
            'content' => 'Джаз виник на межі XIX-XX століть і став одним із найвпливовіших музичних напрямів. Його головними ознаками є імпровізація, синкопований ритм, складна гармонія та індивідуальна манера виконання. Архівування джазових записів важливе для збереження унікальних концертних версій творів.',
            'image' => 'img/jazz_improvisation.svg',
            'datatime' => '2026-04-22',
            'category_id' => 3,
            'artist' => 'Різні виконавці',
            'release_year' => 1900
        ],
        [
            'id' => 4,
            'header' => 'Вінілові платівки та культура слухання музики',
            'content' => 'Вінілові платівки були основним носієм музики у другій половині XX століття. Вони сформували особливу культуру прослуховування: від уважного вибору платівки до оформлення обкладинки та колекціонування. Сьогодні вініл знову популярний серед меломанів завдяки фізичному формату і характерному звучанню.',
            'image' => 'img/vinyl_records.svg',
            'datatime' => '2026-04-23',
            'category_id' => 4,
            'artist' => 'Архівний матеріал',
            'release_year' => 1948
        ],
        [
            'id' => 5,
            'header' => 'Pink Floyd - The Dark Side of the Moon',
            'content' => 'The Dark Side of the Moon є концептуальним альбомом, у якому розкриваються теми часу, страху, грошей і людського життя. Платівка стала класичним прикладом прогресивного року та студійної роботи зі звуком. Її часто включають до переліків найвпливовіших альбомів в історії музики.',
            'image' => 'img/pink_floyd_1971.svg',
            'datatime' => '2026-04-24',
            'category_id' => 1,
            'artist' => 'Pink Floyd',
            'release_year' => 1973
        ],
        [
            'id' => 6,
            'header' => 'Електронна музика: від синтезаторів до цифрових студій',
            'content' => 'Електронна музика розвивалася разом із технологіями звукозапису. Синтезатори, драм-машини та цифрові робочі станції змінили процес створення композицій. У музичному архіві цей жанр важливо описувати через інструменти, програмне забезпечення та культурний контекст.',
            'image' => 'img/electronic_studio.svg',
            'datatime' => '2026-04-25',
            'category_id' => 3,
            'artist' => 'Різні виконавці',
            'release_year' => 1970
        ]
    ];
}

function initialize_storage() {
    if (!file_exists(STORAGE_FILE)) {
        $data = ['categories' => demo_categories(), 'news' => demo_posts()];
        file_put_contents(STORAGE_FILE, json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    }
}

function read_storage() {
    initialize_storage();
    $json = file_get_contents(STORAGE_FILE);
    $data = json_decode($json, true);
    if (!is_array($data)) {
        $data = ['categories' => demo_categories(), 'news' => demo_posts()];
    }
    return $data;
}

function write_storage($data) {
    file_put_contents(STORAGE_FILE, json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
}

function get_menu() {
    global $pdo, $dbAvailable;
    if ($dbAvailable) {
        $stmt = $pdo->query('SELECT id, name, description FROM categories ORDER BY id');
        return $stmt->fetchAll();
    }
    return read_storage()['categories'];
}

function get_news() {
    global $pdo, $dbAvailable;
    if ($dbAvailable) {
        $stmt = $pdo->query('SELECT * FROM news ORDER BY datatime DESC, id DESC');
        return $stmt->fetchAll();
    }
    $posts = read_storage()['news'];
    usort($posts, function($a, $b) { return strcmp($b['datatime'], $a['datatime']); });
    return $posts;
}

function get_post() {
    return get_news();
}

function get_post_by_id($post_id) {
    global $pdo, $dbAvailable;
    $post_id = (int)$post_id;
    if ($dbAvailable) {
        $stmt = $pdo->prepare('SELECT * FROM news WHERE id = ?');
        $stmt->execute([$post_id]);
        return $stmt->fetch();
    }
    foreach (read_storage()['news'] as $post) {
        if ((int)$post['id'] === $post_id) {
            return $post;
        }
    }
    return null;
}

function get_post_by_category($category_id) {
    global $pdo, $dbAvailable;
    $category_id = (int)$category_id;
    if ($dbAvailable) {
        $stmt = $pdo->prepare('SELECT * FROM news WHERE category_id = ? ORDER BY datatime DESC');
        $stmt->execute([$category_id]);
        return $stmt->fetchAll();
    }
    return array_values(array_filter(read_storage()['news'], function($post) use ($category_id) {
        return (int)$post['category_id'] === $category_id;
    }));
}

function get_category_title($category_id) {
    global $pdo, $dbAvailable;
    $category_id = (int)$category_id;
    if ($dbAvailable) {
        $stmt = $pdo->prepare('SELECT * FROM categories WHERE id = ?');
        $stmt->execute([$category_id]);
        return $stmt->fetch();
    }
    foreach (read_storage()['categories'] as $category) {
        if ((int)$category['id'] === $category_id) {
            return $category;
        }
    }
    return null;
}

function category_post_count($category_id) {
    global $pdo, $dbAvailable;
    $category_id = (int)$category_id;
    if ($dbAvailable) {
        $stmt = $pdo->prepare('SELECT COUNT(*) FROM news WHERE category_id = ?');
        $stmt->execute([$category_id]);
        return (int)$stmt->fetchColumn();
    }
    return count(array_filter(read_storage()['news'], function($post) use ($category_id) {
        return (int)$post['category_id'] === $category_id;
    }));
}

function text_length($text) {
    return function_exists('mb_strlen') ? mb_strlen($text, 'UTF-8') : strlen($text);
}

function text_substr($text, $start, $length = null) {
    if (function_exists('mb_substr')) {
        return mb_substr($text, $start, $length, 'UTF-8');
    }
    return $length === null ? substr($text, $start) : substr($text, $start, $length);
}

function text_lower($text) {
    return function_exists('mb_strtolower') ? mb_strtolower($text, 'UTF-8') : strtolower($text);
}

function text_pos($haystack, $needle) {
    return function_exists('mb_strpos') ? mb_strpos($haystack, $needle, 0, 'UTF-8') : strpos($haystack, $needle);
}

function excerpt($text, $length = 160) {
    $text = trim(strip_tags((string)$text));
    if (text_length($text) <= $length) return $text;
    return text_substr($text, 0, $length) . '...';
}

function search_posts($query) {
    global $pdo, $dbAvailable;
    $query = trim((string)$query);
    if ($query === '') return [];
    if ($dbAvailable) {
        $stmt = $pdo->prepare('SELECT * FROM news WHERE header LIKE ? OR content LIKE ? OR artist LIKE ? ORDER BY datatime DESC');
        $like = '%' . $query . '%';
        $stmt->execute([$like, $like, $like]);
        return $stmt->fetchAll();
    }
    $lower = text_lower($query);
    return array_values(array_filter(read_storage()['news'], function($post) use ($lower) {
        $haystack = text_lower($post['header'] . ' ' . $post['content'] . ' ' . $post['artist']);
        return text_pos($haystack, $lower) !== false;
    }));
}

function save_uploaded_image($fieldName) {
    if (isset($_FILES[$fieldName]) && is_uploaded_file($_FILES[$fieldName]['tmp_name'])) {
        $safeName = preg_replace('/[^a-zA-Z0-9_.-]/', '_', basename($_FILES[$fieldName]['name']));
        $target = __DIR__ . '/../img/' . $safeName;
        move_uploaded_file($_FILES[$fieldName]['tmp_name'], $target);
        return 'img/' . $safeName;
    }
    return 'img/album.svg';
}

function add_new_post($data, $imagePath = null) {
    global $pdo, $dbAvailable;
    $imagePath = $imagePath ?: 'img/album.svg';
    if ($dbAvailable) {
        $stmt = $pdo->prepare('INSERT INTO news (header, content, image, datatime, category_id, artist, release_year) VALUES (?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute([
            $data['header'], $data['content'], $imagePath, $data['datatime'], (int)$data['category_id'],
            $data['artist'], (int)$data['release_year']
        ]);
        return;
    }
    $storage = read_storage();
    $ids = array_column($storage['news'], 'id');
    $nextId = empty($ids) ? 1 : max($ids) + 1;
    $storage['news'][] = [
        'id' => $nextId,
        'header' => $data['header'],
        'content' => $data['content'],
        'image' => $imagePath,
        'datatime' => $data['datatime'],
        'category_id' => (int)$data['category_id'],
        'artist' => $data['artist'],
        'release_year' => (int)$data['release_year']
    ];
    write_storage($storage);
}

function update_post($data, $imagePath = null) {
    global $pdo, $dbAvailable;
    $id = (int)$data['id'];
    if ($dbAvailable) {
        if ($imagePath) {
            $stmt = $pdo->prepare('UPDATE news SET header=?, content=?, image=?, datatime=?, category_id=?, artist=?, release_year=? WHERE id=?');
            $stmt->execute([$data['header'], $data['content'], $imagePath, $data['datatime'], (int)$data['category_id'], $data['artist'], (int)$data['release_year'], $id]);
        } else {
            $stmt = $pdo->prepare('UPDATE news SET header=?, content=?, datatime=?, category_id=?, artist=?, release_year=? WHERE id=?');
            $stmt->execute([$data['header'], $data['content'], $data['datatime'], (int)$data['category_id'], $data['artist'], (int)$data['release_year'], $id]);
        }
        return;
    }
    $storage = read_storage();
    foreach ($storage['news'] as &$post) {
        if ((int)$post['id'] === $id) {
            $post['header'] = $data['header'];
            $post['content'] = $data['content'];
            if ($imagePath) $post['image'] = $imagePath;
            $post['datatime'] = $data['datatime'];
            $post['category_id'] = (int)$data['category_id'];
            $post['artist'] = $data['artist'];
            $post['release_year'] = (int)$data['release_year'];
            break;
        }
    }
    write_storage($storage);
}

function delete_new($post_id) {
    global $pdo, $dbAvailable;
    $post_id = (int)$post_id;
    if ($dbAvailable) {
        $stmt = $pdo->prepare('DELETE FROM news WHERE id = ?');
        $stmt->execute([$post_id]);
        return;
    }
    $storage = read_storage();
    $storage['news'] = array_values(array_filter($storage['news'], function($post) use ($post_id) {
        return (int)$post['id'] !== $post_id;
    }));
    write_storage($storage);
}
