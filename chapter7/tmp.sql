-- カスタマーテーブル
CREATE TABLE Customer (
    customer_id INT(8) NOT NULL AUTO_INCREMENT,
    name_family_kana VARCHAR(50) NOT NULL,
    name_personal_kana VARCHAR(50) NOT NULL,
    name_family VARCHAR(50) NOT NULL,
    name_personal VARCHAR(50) NOT NULL,
    post_code INT(12) NOT NULL,
    prefectures VARCHAR(50) NOT NULL,
    city_address VARCHAR(50) NOT NULL,
    street_address VARCHAR(50) NOT NULL,
    building VARCHAR(50) NOT NULL,
    tel INT(20) NOT NULL,
    mail_address VARCHAR(50) NOT NULL,
    password VARCHAR(20) NOT NULL,
    PRIMARY KEY (customer_id)
);
-- customer_insert
INSERT INTO Customer (name_family_kana, name_personal_kana, name_family, name_personal, post_code, prefectures, city_address, street_address, building, tel, mail_address, password)
VALUES ('カナ姓', 'カナ名', '姓', '名', 1234567, '都道府県', '市区町村', '番地', '建物名', 1234567890, 'example@example.com', 'password123');


-- 商品テーブル
CREATE TABLE Product (
    product_id INT(8) NOT NULL AUTO_INCREMENT,
    product_name VARCHAR(50) NOT NULL,
    category VARCHAR(50) NOT NULL,
    brand VARCHAR(50) NOT NULL,
    product_exp VARCHAR(200) NOT NULL,
    price INT(8) NOT NULL,
    product_path VARCHAR(200) NOT NULL,
    registration DATE NOT NULL,
    renewal DATE NOT NULL,
    PRIMARY KEY (product_id)
);

--購入テーブル
CREATE TABLE Purchase (
    purchase_id INT(8) NOT NULL AUTO_INCREMENT,
    customer_id INT(8) ,
    PRIMARY KEY (purchase_id),
    FOREIGN key (customer_id) REFERENCES Customer(customer_id)
);

--購入詳細テーブル
CREATE TABLE Purchase_detail(
    purchase_id INT(8) ,
    product_id INT(8) ,
    count int NOT NULL,
    PRIMARY KEY (purchase_id,product_id),
    FOREIGN key (purchase_id) REFERENCES Purchase(purchase_id),
    FOREIGN key (product_id) REFERENCES Product(product_id)
);

--お気に入りテーブル
CREATE TABLE Favorite(
    customer_id INT(8) ,
    product_id INT(8) ,
    PRIMARY KEY (customer_id,product_id),
    FOREIGN key (customer_id) REFERENCES Customer(customer_id),
    FOREIGN key (product_id) REFERENCES Product(product_id)
);


-- レビューテーブル別枠
CREATE TABLE Review (
    review_id INT(8) PRIMARY KEY AUTO_INCREMENT,
    customer_id INT(8),
    shohin_id INT(8),
    review_rank INT(1) NOT NULL,
    review_title VARCHAR(20) NOT NULL,
    review_exp VARCHAR(200),
    registration DATE NOT NULL,
    renewal DATE NOT NULL,
    FOREIGN KEY (customer_id) REFERENCES Customer(customer_id),
    FOREIGN KEY (shohin_id) REFERENCES Shohin(shohin_id)
);

-- 購入履歴テーブル

-- ポイントテーブル

-- 予約テーブル