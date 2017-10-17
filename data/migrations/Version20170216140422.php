<?php

namespace TuningforkMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Populates pret_status table
 */
class Version20170216140422 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql("INSERT INTO pret_status (id, name, label) VALUES (1, 'AWAITING', 'En attente');");
        $this->addSql("INSERT INTO pret_status (id, name, label) VALUES (2, 'RUNNING', 'En cours');");
        $this->addSql("INSERT INTO pret_status (id, name, label) VALUES (3, 'MISSING', 'En retard');");
        $this->addSql("INSERT INTO pret_status (id, name, label) VALUES (4, 'CLOSED', 'Clos');");
        $this->addSql("INSERT INTO pret_status (id, name, label) VALUES (5, 'CANCELED', 'Annulé');");
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql("DELETE FROM pret_status;");
    }
}
