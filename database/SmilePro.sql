DROP DATABASE IF exists jamin_a;
create database jamin_a;
use jamin_a;

-- Tabel voor producten
CREATE TABLE Product (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    Naam VARCHAR(255) NOT NULL,
    Barcode VARCHAR(20) NOT NULL UNIQUE,
    IsActief BIT DEFAULT 1, 
    Opmerking VARCHAR(250), 
    DatumAangemaakt DATETIME(6) DEFAULT CURRENT_TIMESTAMP,
    DatumGewijzigd DATETIME(6) DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Tabel voor allergenen
CREATE TABLE Allergeen (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    Naam VARCHAR(255) NOT NULL,
    Omschrijving TEXT,
    IsActief BIT DEFAULT 1, 
    Opmerking VARCHAR(250), 
    DatumAangemaakt DATETIME(6) DEFAULT CURRENT_TIMESTAMP,
    DatumGewijzigd DATETIME(6) DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Tabel voor producten per allergeen
CREATE TABLE ProductPerAllergeen (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    ProductId INT NOT NULL,
    AllergeenId INT NOT NULL,
    FOREIGN KEY (ProductId) REFERENCES Product(Id),
    FOREIGN KEY (AllergeenId) REFERENCES Allergeen(Id),
    IsActief BIT DEFAULT 1, 
    Opmerking VARCHAR(250), 
    DatumAangemaakt DATETIME(6) DEFAULT CURRENT_TIMESTAMP,
    DatumGewijzigd DATETIME(6) DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Tabel voor leveranciers
CREATE TABLE Leverancier (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    Naam VARCHAR(255) NOT NULL,
    ContactPersoon VARCHAR(255) NOT NULL,
    LeverancierNummer VARCHAR(20) NOT NULL UNIQUE,
    Mobiel VARCHAR(20),
    IsActief BIT DEFAULT 1, 
    Opmerking VARCHAR(250), 
    DatumAangemaakt DATETIME(6) DEFAULT CURRENT_TIMESTAMP,
    DatumGewijzigd DATETIME(6) DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Tabel voor producten per leverancier
CREATE TABLE ProductPerLeverancier (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    LeverancierId INT NOT NULL,
    ProductId INT NOT NULL,
    DatumLevering DATETIME NOT NULL,
    Aantal INT NOT NULL,
    DatumEerstVolgendeLevering DATETIME NOT NULL,
    FOREIGN KEY (LeverancierId) REFERENCES Leverancier(Id),
    FOREIGN KEY (ProductId) REFERENCES Product(Id),
    IsActief BIT DEFAULT 1, 
    Opmerking VARCHAR(250), 
    DatumAangemaakt DATETIME(6) DEFAULT CURRENT_TIMESTAMP,
    DatumGewijzigd DATETIME(6) DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Tabel voor magazijn
CREATE TABLE Magazijn (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    ProductId INT NOT NULL,
    VerpakkingsEenheid DECIMAL(5,2) NOT NULL,
    AantalAanwezig INT,
    FOREIGN KEY (ProductId) REFERENCES Product(Id),
    IsActief BIT DEFAULT 1, 
    Opmerking VARCHAR(250), 
    DatumAangemaakt DATETIME(6) DEFAULT CURRENT_TIMESTAMP,
    DatumGewijzigd DATETIME(6) DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;
