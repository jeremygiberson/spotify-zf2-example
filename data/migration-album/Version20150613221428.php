<?php

namespace Album\Migrations;

use Zend\Db\Adapter\AdapterAwareInterface;
use Zend\Db\Adapter\AdapterAwareTrait;
use Zend\Db\Sql\Ddl\Column\Boolean;
use Zend\Db\Sql\Ddl\Column\Integer;
use Zend\Db\Sql\Ddl\Column\Varchar;
use Zend\Db\Sql\Ddl\Constraint\PrimaryKey;
use Zend\Db\Sql\Ddl\Constraint\UniqueKey;
use Zend\Db\Sql\Ddl\CreateTable;
use Zend\Db\Sql\Ddl\DropTable;
use ZfSimpleMigrations\Library\AbstractMigration;
use Zend\Db\Metadata\MetadataInterface;

class Version20150613221428 extends AbstractMigration implements AdapterAwareInterface
{
    use AdapterAwareTrait;

    public static $description = "Migration description";

    public function up(MetadataInterface $schema)
    {
        $album = new CreateTable('album');
        $album->addColumn(new Varchar('album_id', 24));
        $album->addConstraint($pk = new Primarykey('album_id'));
        $album->addColumn(new Varchar('spotify_url', 255));
        $album->addColumn(new Varchar('photo_preview', 255));
        $album->addColumn(new Varchar('name', 255));
        $album->addColumn(new Varchar('album_type', 24));
        $album->addColumn(new Varchar('href', 255));
        $album->addColumn(new Varchar('type', 24));
        $album->addColumn(new Varchar('uri', 255));
        $album->addColumn(new Boolean('fetched_detail', false, false));

        $this->addSql($album->getSqlString($this->adapter->getPlatform()));

        $image = new CreateTable('album_image');
        $image->addColumn(new Varchar('album_id', 24));
        $image->addColumn(new Varchar('url', 255));
        $image->addConstraint(new UniqueKey(['album_id', 'url']));
        $image->addColumn(new Integer('width'));
        $image->addColumn(new Integer('height'));

        $this->addSql($image->getSqlString($this->adapter->getPlatform()));

        $track = new CreateTable('album_track');
        $track->addColumn(new Varchar('album_id', 24));
        $track->addColumn(new Varchar('track_id', 24));
        $track->addColumn(new Varchar('name', 255));
        $track->addConstraint(new PrimaryKey('track_id'));
        $track->addColumn(new Varchar('preview_url', 255));
        $track->addColumn(new Varchar('uri', 255));
        $track->addColumn(new Boolean('explicit', null, false));
        $track->addColumn(new Integer('track_number'));
        $track->addColumn(new Integer('disc_number'));
        $track->addColumn(new Varchar('type', 24));

        $this->addSql($track->getSqlString($this->adapter->getPlatform()));

    }

    public function down(MetadataInterface $schema)
    {
        $album = new DropTable('album');
        $this->addSql($album->getSqlString($this->adapter->getPlatform()));

        $image = new DropTable('album_image');
        $this->addSql($image->getSqlString($this->adapter->getPlatform()));

        $track = new DropTable('album_track');
        $this->addSql($track->getSqlString($this->adapter->getPlatform()));
    }
}
