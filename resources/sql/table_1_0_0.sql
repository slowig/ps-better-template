CREATE TABLE IF NOT EXISTS {prefix}inspire_group (
    id_inspire_group INT AUTO_INCREMENT NOT NULL,
    working_name VARCHAR(255) NOT NULL
    PRIMARY KEY(`id_inspire_group`)
) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS {prefix}inspire_group_lang (
    id_inspire_group INT NOT NULL,
    id_lang INT NOT NULL,
    name TEXT DEFAULT(""),
    slug TEXT DEFAULT(""),
    description TEXT DEFAULT(""),
    PRIMARY KEY(`id_inspire_group`, `id_lang`)
) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS {prefix}inspire_group_product (
    id_inspire_group INT NOT NULL,
    id_product INT NOT NULL,cd
    own_image BOOLEAN DEFAULT(0),
    photo_link TEXT DEFAULT(""),
    PRIMARY KEY(`id_inspire_group`, `id_inspire_group`)
) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
