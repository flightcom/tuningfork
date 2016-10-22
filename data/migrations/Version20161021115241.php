<?php

namespace TuningforkMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20161021115241 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        // Stations
        //   l'Ivresse, 9 rue de l'Hôtel de Ville, 44000, Nantes
        //   l'Altercafé, Hangar à Bananes, 21 quai des Antilles, 44200, Nantes 
        //   La Fabrique/Trempolino, café culture "La Place", 6 Boulevard Léon Bureau, 44200, Nantes

        $stations = [
            ['name' => "L''Ivresse", 'adresse' => [
                'voie' => "9 rue de l''Hôtel de Ville",
                'cp' => '44000'
            ]],
            ['name' => "L''Altercafé", 'adresse' => [
                'voie' => '21 quai des Antilles',
                'cp' => '44200'
            ]],
            ['name' => 'La Fabrique/Trempolino', 'adresse' => [
                'voie' => '6 Boulevard Léon Bureau',
                'cp' => '44200'
            ]]
        ];

        foreach ($stations as $station) {
            $this->ajouterStation($station);
        }

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql("TRUNCATE station;");
    }

    protected function ajouterStation($station)
    {
        $adresse_id = $this->ajouterAdresse($station['adresse']);
        $this->addSql("INSERT INTO station (name, adresse_id) VALUES ('".$station['name']."', ".$adresse_id.");");
    }

    protected function ajouterAdresse($adresse)
    {
        $q = "INSERT INTO adresse (ville_id, pays_id, voie) VALUES (
            (SELECT id FROM ville WHERE code_postal LIKE '%".$adresse['cp']."%'),
            (SELECT id FROM pays WHERE nom = 'FRANCE'),
            '".$adresse['voie']."'
        );";
        $this->connection->executeQuery($q);
        return $this->connection->lastInsertId();
    }

}
