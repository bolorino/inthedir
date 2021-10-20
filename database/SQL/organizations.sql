create table organizations
(
    id          bigint unsigned auto_increment
        primary key,
    province_id bigint unsigned not null,
    name        varchar(140)    not null,
    slug        varchar(155)    not null,
    address     varchar(200)    not null,
    address_2   varchar(200)    null,
    city        varchar(90)     not null,
    postal_code varchar(5)      not null,
    created_at  timestamp       null,
    updated_at  timestamp       null,
    constraint organizations_name_unique
        unique (name),
    constraint organizations_slug_unique
        unique (slug),
    constraint organizations_province_id_foreign
        foreign key (province_id) references provinces (id)
)
    collate = utf8mb4_unicode_ci;

INSERT INTO inthedir.organizations (id, province_id, name, slug, address, address_2, city, postal_code, phone, website, image, logo, created_at, updated_at) VALUES (11, 41, 'Sala Cero Teatro', 'sala-cero-teatro', 'Sol, 5', null, 'Sevilla', '41003', '954225165', 'https://www.salacero.com', 'images/sala-cero-teatro.jpg', 'images/logos/sala-cero-teatro-logo.png', '2021-10-11 17:39:19', '2021-10-13 13:38:40');
INSERT INTO inthedir.organizations (id, province_id, name, slug, address, address_2, city, postal_code, phone, website, image, logo, created_at, updated_at) VALUES (12, 14, 'Teatro Avanti', 'teatro-avanti', 'María Auxiliadora s/n', null, 'Córdoba', '14002', '957491166', 'https://www.teatroavanti.com', 'images/nBZcIYQX9SDLUh4VIvqkVFEDBkgyphS43HyKt46x.jpg', 'images/logos/yxToMnYCLj5rxjsh3V5qiT1d6yTbixGilcQY512m.png', '2021-10-12 15:23:53', '2021-10-12 15:23:53');
INSERT INTO inthedir.organizations (id, province_id, name, slug, address, address_2, city, postal_code, phone, website, image, logo, created_at, updated_at) VALUES (16, 41, 'La Fundición', 'la-fundicion', 'Casa de la Moneda', 'Habana, 18', 'Sevilla', '41001', '954225844', 'https://www.fundiciondesevilla.es', 'images/la-fundicion.jpg', 'images/logos/la-fundicion-logo.png', '2021-10-13 13:41:54', '2021-10-13 13:41:54');