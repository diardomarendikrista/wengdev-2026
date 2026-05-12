<!DOCTYPE html>
<html>

<head>
    <title>Artikel</title>
</head>

<body>
    <div>
        <a href="<?= route('articles.create') ?>">Tambah artikel</a>
    </div>
    <table border="1">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Isi</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($articles as $article): ?>
            <tr>
                <td><?= $article['title'] ?></td>
                <td><?= $article['content'] ?></td>
                <td><?= $article['date'] ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
</body>

</html>