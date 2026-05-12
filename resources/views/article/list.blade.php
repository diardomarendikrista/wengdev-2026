<x-template title="Articles">
    <div>
        <a href="<?= route('articles.create') ?>">Tambah artikel</a>
    </div>
    @if(!empty($articles))
        <table border="1">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Isi</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($articles as $article)
                    <tr>
                        <td><?= $article['title'] ?></td>
                        <td><?= $article['content'] ?></td>
                        <td><?= $article['date'] ?></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        Belum ada artikel
    @endif
</x-template>