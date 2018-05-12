<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180512111815 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE dependant (id INT AUTO_INCREMENT NOT NULL, employee_id INT NOT NULL, name VARCHAR(100) NOT NULL, phone_number VARCHAR(50) NOT NULL, gender VARCHAR(255) NOT NULL, date_of_birth DATE NOT NULL, UNIQUE INDEX UNIQ_BC99DF785E237E06 (name), INDEX IDX_BC99DF788C03F15C (employee_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, address LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_4FBF094F5E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employee (id INT AUTO_INCREMENT NOT NULL, company_id INT NOT NULL, salary DOUBLE PRECISION NOT NULL, name VARCHAR(100) NOT NULL, phone_number VARCHAR(50) NOT NULL, gender VARCHAR(255) NOT NULL, date_of_birth DATE NOT NULL, UNIQUE INDEX UNIQ_5D9F75A15E237E06 (name), INDEX IDX_5D9F75A1979B1AD6 (company_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE dependant ADD CONSTRAINT FK_BC99DF788C03F15C FOREIGN KEY (employee_id) REFERENCES employee (id)');
        $this->addSql('ALTER TABLE employee ADD CONSTRAINT FK_5D9F75A1979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE employee DROP FOREIGN KEY FK_5D9F75A1979B1AD6');
        $this->addSql('ALTER TABLE dependant DROP FOREIGN KEY FK_BC99DF788C03F15C');
        $this->addSql('DROP TABLE dependant');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE employee');
    }
}
