<?= '<?xml version="1.0" ?>' ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<?php $base_url = trim(\Cake\Routing\Router::url('/', true), '/') ?>
    <url>
        <loc><?= $base_url ?>/</loc>
        <lastmod><?= date('Y-m-d') ?></lastmod>
        <changefreq>weekly</changefreq>
        <priority>1.0</priority>
    </url>
    <?php foreach ($categories as $item) { ?><url>
        <loc><?= $base_url . $this->Url->build([
                'controller' => 'Browse',
                'action' => 'view',
                'plugin' => 'Feeder',
                $item->id
            ]) ?></loc>
        <lastmod><?= date('Y-m-d') ?></lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    <?php } ?>
    <?php foreach ($pillarPages as $item) { ?><url>
        <loc><?= $base_url . $this->Url->build($item->url_path) ?></loc>
        <lastmod><?= date('Y-m-d') ?></lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    <?php } ?>
    <url>
        <loc><?= $base_url ?>/feeder/pages/display/datenschutz</loc>
        <lastmod><?= date('Y-m-d') ?></lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.5</priority>
    </url>
    <url>
        <loc><?= $base_url ?>/feeder/pages/display/impressum</loc>
        <lastmod><?= date('Y-m-d') ?></lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.5</priority>
    </url>
</urlset>
